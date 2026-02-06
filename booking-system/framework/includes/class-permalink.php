<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-permalink.php
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Permalink PHP class.
 */

if (!class_exists('DOTPermalink')){
    class DOTPermalink{
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
         * Generate a link for a page or an asset in the application.
         *
         * @usage
         *      In FILE search for function call: $this->get
         *      In FILE search for function call in hooks: array(&$this, 'get')
         *      In PROJECT search for function call: $DOT->classes->permalink->get
         *
         * @params
         *      path (string): URL path
         *      permalink (boolean): generate a permalink depending on selected language
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
         *      WP : get_admin_url() // Retrieves the URL to the admin area for a given site.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      The URL.
         *
         * @return_details
         *      If parameter [permalink] is set to:
         *          false : The URL returned is just a link without links configuration or page verification. Is preferably to be used to access application assets.
         *          true : The URL is returned depending on the application current language, links configuration or page.
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @param string $path
         * @param boolean $permalink
         *
         * @return string
         */
        public function get($path,
                            $permalink = true){
            global $DOT;

            /*
             * Initialize the link.
             */
            $link = '';

            /*
             * Create the link.
             */
            if ($permalink){
                /*
                 * Verify links configuration.
                 */
                if (isset($DOT->config->links)){
                    $link_found = false;

                    foreach ($DOT->config->links as $links){
                        foreach ($links as $link_config => $permalinks){
                            if ($link_config == $path){
                                /*
                                 * Set outside link.
                                 */
                                $link = (DOT_STATUS == 'beta'
                                                ? 'https://dopstudios.com/'
                                                : 'https://pinpoint.world/')
                                        .(isset($permalinks->{$DOT->language})
                                                ? $DOT->language.'/'.$permalinks->{$DOT->language}
                                                : $path);
                                $link_found = true;
                                break;
                            }
                        }

                        if ($link_found){
                            break;
                        }
                    }
                }

                /*
                 * Verify links configuration.
                 */
                if (!$link_found){
                    $link = get_admin_url()
                            .'admin.php?page='.DOT_ID.'-'
                            .str_replace('/',
                                         '-',
                                         $path);
                }
            }
            else{
                $link = $DOT->paths->url.'/'.$path;
            }

            return $link;
        }

        /*
         * Set permalink data to know what controller to access.
         *
         * @usage
         *      In FILE search for function call: $this->set
         *      In FILE search for function call in hooks: array(&$this, 'set')
         *      In PROJECT search for function call: $DOT->classes->permalink->set
         *
         * @params
         *      -
         *
         * @post
         *      -
         *
         * @get
         *      page (string): current page
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      DOT_LANGUAGE_DEFAULT (string): default language
         *      DOT_ID (string): unique application ID
         *
         * @globals
         *      DOT (object): DOT framework main class variable
         *
         * @functions
         *      framework/includes/class-language.php : get() // Get language.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Permalink data and language.
         *
         * @return_details
         *      The framework variables that are set:
         *      [DOT->language] : string
         *          Current language ISO 639-1 code.
         *
         *      [DOT->language_default] : string
         *          The first value of global variable, the array [dot_languages], is the default language. (ISO 639-1 code)
         *
         *      [DOT->permalink] : object
         *          All permalink data is stored here.
         *
         *          [DOT->permalink->page_name] (string): current page name, words are separated with the "-" character
         *          [DOT->permalink->page] (string): current page, words are separated with the "_" character
         *          [DOT->permalink->page_class] (string): page class, words are separated with the "-" character
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        public function set(){
            global $DOT;

            /*
             * Get default language.
             */
            $DOT->language_default = DOT_LANGUAGE_DEFAULT;

            /*
             * Get current language.
             */
            $DOT->language = $DOT->classes->language->get();

            /*
             * Get page.
             */
            $page_data = $DOT->get('page');

            if ($page_data !== false
                    && str_contains($page_data,
                                    DOT_ID.'-')){
                $data = explode(DOT_ID.'-',
                                $page_data);

                $page = str_replace('-',
                                    '_',
                                    $data[1]);
                $page_name = str_replace('_',
                                         '-',
                                         $page);
            }
            else{
                $page = 'not_found';
                $page_name = 'not-found';
            }

            $DOT->permalink->page_name = $page_name;
            $DOT->permalink->page = $page;
            $DOT->permalink->page_class = $page_name;
        }
    }
}