<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-controller.php
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Controller PHP class.
 */

if (!class_exists('DOTController')){
    class DOTController{
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
         * Initialize controller page.
         *
         * @usage
         *      In FILE search for function call: $this->init
         *      In FILE search for function call in hooks: array(&$this, 'init')
         *      In PROJECT search for function call: $DOT->classes->controller->init
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
         *      WP : wp_enqueue_style() // Enqueue CSS files in WordPress.
         *      WP : wp_enqueue_script() // Enqueue JavaScript files in WordPress.
         *
         *      framework/includes/class-hooks.php : set() // Set a hook.
         *
         *      application/controllers/{controller}.php : css() // Add CSS files specific to this page.
         *      application/controllers/{controller}.php : js() // Add JS files specific to this page.
         *
         * @hooks
	     *	    config_js (filter): JavaScript configuration data.
         *
         * @layouts
         *      -
         *
         * @return
         *      Load admin page styles.
         *
         * @return_details
         *      If a controller exists CSS, Javascript & JavaScript configuration assets are loaded.
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        public function init(){
            global $DOT;

            $page = $DOT->permalink->page;

            /*
             * Add page CSS & JS files if controller exists.
             */
            if (isset($DOT->controllers->{$page})
                    && method_exists($DOT->controllers->{$page},
                                     'index')){
                /*
                 * Initialize JavaScript configuration.
                 */
                $DOT->config_js = $DOT->hooks->set('config_js',
                                                   'filter',
                                                   $DOT->config_js);

                foreach ($DOT->views->{$page}->css['keys'] as $key){
                    wp_enqueue_style($key);
                }

                foreach ($DOT->views->{$page}->js['keys'] as $key){
                    wp_enqueue_script($key);
                }
            }
        }
    }
}