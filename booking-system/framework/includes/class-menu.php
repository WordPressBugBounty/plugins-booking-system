<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-menu.php
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Menu PHP class.
 */

if (!class_exists('DOTMenu')){
    class DOTMenu{
        /*
         * Constructor
         *
         * @usage
         *      The constructor is called when a class instance is created.
         *
         * @params
         *      -
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      -
         *
         * @globals
         *      -
         *
         * @functions
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      -
         *
         * @return_details
         *      -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        function __construct(){
        }

        /*
         * Initialize admin menu.
         *
         * @usage
         *      In FILE search for function call: $this->init
         *      In FILE search for function call in hooks: array(&$this, 'init')
         *      In PROJECT search for function call: $DOT->classes->menu->init
         *
         * @params
         *      -
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      -
         *
         * @globals
         *      DOT (object): DOT framework main class variable
         *
         * @functions
         *      WP : wp_get_current_user() // Get current logged in user data.
         *
         *      this : get() // Get admin menu.
         *      this : set() // Set admin menu.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      -
         *
         * @return_details
         *      -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        function init(){
            /*
             * Set role action for current user.
             */
            $user_roles = array_values(wp_get_current_user()->roles);

            $user_role = match ($user_roles[0]) {
                'administrator' => 'manage_options',
                'author' => 'publish_posts',
                'contributor' => 'edit_posts',
                'editor' => 'edit_pages',
                'subscriber' => 'read',
                default => $user_roles[0]
            };

            /*
             * Set admin menu.
             */
            $this->set($this->get($user_role));
        }

        /*
         * Get admin menu.
         *
         * @usage
         *      In FILE search for function call: $this->get
         *      In FILE search for function call in hooks: array(&$this, 'get')
         *      In PROJECT search for function call: $DOT->classes->menu->get
         *
         * @params
         *      user_role (string): user role
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      DOT_ID (string): unique application ID
         *
         * @globals
         *      DOT (object): DOT framework main class variable
         *
         * @functions
         *      application/controllers/{controller}.php : menu() // Set menu item specific to a page.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Menu items list.
         *
         * @return_details
         *      menu (array): menu list
         *          [menu item] (object): menu item
         *          [menu item]->capability (string): the capability required for this menu to be displayed to the user
         *          [menu item]->controller (string): page controller
         *          [menu item]->position (integer): menu position
         *          [menu item]->slug (string): page slug
         *          [menu item]->submenu (array): submenu items
         *          [menu item]->title (string): plugin title
         *          [menu item]->title_menu (string): menu title
         *          [menu item]->title_page (string): page title
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @param string $user_role
         *
         * @return array
         */
        function get($user_role){
            global $DOT;

            $menu = array();

            /*
             * Get menu items.
             */
            foreach ($DOT->controllers as $key => $controller){
                if (method_exists($controller,
                                  'menu')){
                    $menu_item = $controller->menu();

                    if ($menu_item->type == 'menu'){
                        /*
                         * Get menu item.
                         */
                        $priority = $menu_item->priority;

                        if (!isset($menu[$priority])){
                            $menu[$priority] = new stdClass;
                            $menu[$priority]->submenu = array();
                        }

                        $menu[$priority]->capability = $menu_item->user_role == ''
                                ? $user_role
                                : $menu_item->user_role;
                        $menu[$priority]->controller = $key;
                        $menu[$priority]->position = $menu_item->position;
                        $menu[$priority]->slug = DOT_ID.'-'.str_replace('_',
                                                                        '-',
                                                                        $key);
                        $menu[$priority]->title = $menu_item->title ?? '';
                        $menu[$priority]->title_menu = $menu_item->title_menu;
                        $menu[$priority]->title_page = $menu_item->title_page;
                    }
                    else{
                        /*
                         * Get submenu item.
                         */
                        $position = $menu_item->position;
                        $priority = $menu_item->priority;

                        if (!isset($menu[$position])){
                            $menu[$position] = new stdClass;
                            $menu[$position]->submenu = array();
                        }

                        $menu[$position]->submenu[$priority] = new stdClass;

                        $menu[$position]->submenu[$priority]->capability = $menu_item->user_role == ''
                                ? $user_role
                                : $menu_item->user_role;
                        $menu[$position]->submenu[$priority]->controller = $key;
                        $menu[$position]->submenu[$priority]->position = $menu_item->position;
                        $menu[$position]->submenu[$priority]->slug = DOT_ID.'-'.str_replace('_',
                                                                                            '-',
                                                                                            $key);
                        $menu[$position]->submenu[$priority]->title = $menu_item->title ?? '';
                        $menu[$position]->submenu[$priority]->title_menu = $menu_item->title_menu;
                        $menu[$position]->submenu[$priority]->title_page = $menu_item->title_page;
                    }
                }
            }

            /*
             * Sort menu.
             */
            ksort($menu);

            return $menu;
        }

        /*
         * Set admin menu.
         *
         * @usage
         *      In FILE search for function call: $this->set
         *      In FILE search for function call in hooks: array(&$this, 'set')
         *      In PROJECT search for function call: $DOT->classes->menu->set
         *
         * @params
         *      menu (array): menu items list
         *                    [menu item]->capability (string): the capability required for this menu to be displayed to the user
         *                    [menu item]->controller (string): page controller
         *                    [menu item]->position (integer): menu position
         *                    [menu item]->slug (string): page slug
         *                    [menu item]->submenu (array): submenu items
         *                    [menu item]->title (string): plugin title
         *                    [menu item]->title_menu (string): menu title
         *                    [menu item]->title_page (string): page title
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      -
         *
         * @globals
         *      DOT (object): DOT framework main class variable
         *
         * @functions
         *      WP : add_menu_page() // Add admin menu item.
         *      WP : add_submenu_page() // Add admin submenu item.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      -
         *
         * @return_details
         *      -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @param array $menu
         */
        function set($menu){
            global $DOT;

            /*
             * Generate admin menu.
             */
            foreach ($menu as $menu_item){
                add_menu_page($menu_item->title,
                              $menu_item->title,
                              $menu_item->capability,
                              $menu_item->slug,
                              array(&$DOT->controllers->{$menu_item->controller},
                                    'index'),
                              'none',
                              $menu_item->position);

                /*
                 * Sort submenu.
                 */
                ksort($menu_item->submenu);

                /*
                 * Generate admin submenu.
                 */
                if (count($menu_item->submenu)>0){
                    add_submenu_page($menu_item->slug,
                                     $menu_item->title_page,
                                     $menu_item->title_menu,
                                     $menu_item->capability,
                                     $menu_item->slug,
                                     array(&$DOT->controllers->{$menu_item->controller},
                                           'index'));

                    foreach ($menu_item->submenu as $submenu_item){
                        add_submenu_page($submenu_item->title_menu == ''
                                                 ? ''
                                                 : $menu_item->slug,
                                         $submenu_item->title_page,
                                         $submenu_item->title_menu,
                                         $submenu_item->capability,
                                         $submenu_item->slug,
                                         array(&$DOT->controllers->{$submenu_item->controller},
                                               'index'));
                    }
                }
            }
        }
    }
}