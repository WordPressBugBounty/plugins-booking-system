<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-shortcode.php
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Shortcode PHP class.
 */

if (!class_exists('DOTShortcode')){
    class DOTShortcode{
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
         * Initialize shortcode.
         *
         * @usage
         *      In FILE search for function call: $this->init
         *      In FILE search for function call in hooks: array(&$this, 'init')
         *      In PROJECT search for function call: $DOT->classes->shortcode->init
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
         *      DOT_ID (string): unique application ID
         *
         * @globals
         *      -
         *
         * @functions
         *      WP : add_shortcode() // Adds a hook for a shortcode tag.
         *
         *      this : set() // Set shortcode content.
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
            add_shortcode(DOT_ID,
                          array(&$this,
                                'set'));
        }

        /*
         * Set shortcode language.
         *
         * @usage
         *      In FILE search for function call: $this->lang
         *      In FILE search for function call in hooks: array(&$this, 'lang')
         *      In PROJECT search for function call: $DOT->classes->shortcode->lang
         *
         * @params
         *      -
         *
         * @post
         *      atts (array): shortcode attributes
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
         *      DOT_LANGUAGE_DEFAULT (string): default language
         *
         * @globals
         *      DOT (object): DOT framework main class variable
         *
         * @functions
         *      framework/includes/class-language.php : polylang() // Get Polylang language.
         *      framework/includes/class-language.php : wpml() // Get WPML language.
         *      framework/includes/class-translation.php : set() // Set translation.
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
         * @param array $atts
         */
        public function lang($atts){
            global $DOT;

            /*
             * Get current language.
             */
            $lang = substr($atts['lang'] ?? DOT_LANGUAGE_DEFAULT,
                           0,
                           2);

            /*
             * Overwrite with WPML language.
             */
            $lang_wpml = $DOT->classes->language->wpml();

            $lang_wpml !== false
                    ? $lang = $lang_wpml
                    : null;

            /*
             * Overwrite with Polylang language.
             */
            $lang_polylang = $DOT->classes->language->polylang();

            $lang_polylang !== false
                    ? $lang = $lang_polylang
                    : null;

            /*
             * Set language.
             */
            if ($DOT->language != $lang){ // Do not remove the difference condition. It will delete the translation.
                $DOT->language = $lang;
                $DOT->classes->translation->set($DOT->language);
            }
        }

        /*
         * Set shortcode content.
         *
         * @usage
         *      In FILE search for function call: $this->set
         *      In FILE search for function call in hooks: array(&$this, 'set')
         *      In PROJECT search for function call: $DOT->classes->shortcode->set
         *
         * @params
         *      -
         *
         * @post
         *      atts (array): shortcode attributes
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
         *      framework/dot.php : sanitize() // Sanitize value against malicious content or just return the correct value format.
         *      framework/includes/class-controller.php : init() // Initialize controller page.
         *      framework/includes/class-view.php : cssCode() // Include CSS code in HTML page.
         *
         *      application/controllers/{all} : index() // Display page.
         *
         *      this : lang() // Set shortcode language.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      1. Current text is loaded, if it is different.
         *      2. Load CSS & JS files.
         *      3. Display a page or item.
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
         * @param array $atts
         *
         * @return boolean
         */
        public function set($atts){
            global $DOT;

            /*
             * Sanitize attributes.
             */
            $DOT->sanitize($atts);

            /*
             * Set current language.
             */
            $this->lang($atts);

            /*
             * Get page (item).
             */
            $page_name = '';

            isset($atts['item'])
                    ? $page_name = $atts['item']
                    : null;
            isset($atts['page'])
                    ? $page_name = $atts['page']
                    : null;
            $page = str_replace('-',
                                '_',
                                $page_name);

            $DOT->permalink->page_name = $page_name;
            $DOT->permalink->page = $page;
            $DOT->permalink->page_class = $page_name;

            /*
             * Display the page if controller exists.
             */
            if (isset($DOT->controllers->{$page})
                    && method_exists($DOT->controllers->{$page},
                                     'index')){
                $DOT->classes->controller->init();

                ob_start();

                /*
                 * Add CSS code.
                 */
                $DOT->classes->view->cssCode();

                isset($atts['item'])
                        ? $DOT->controllers->{$page}->index($atts)
                        : $DOT->controllers->{$page}->index();
                return ob_get_clean();
            }

            return false;
        }
    }
}