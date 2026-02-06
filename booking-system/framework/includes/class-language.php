<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-language.php
 * Author                  : Dot on Paper
 * Copyright               : © 2025 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Language PHP class.
 */

if (!class_exists('DOTLanguage')){
    class DOTLanguage{
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
         * Get AJAX language.
         *
         * @usage
         *      In FILE search for function call: $this->ajax
         *      In FILE search for function call in hooks: array(&$this, 'ajax')
         *      In PROJECT search for function call: $DOT->classes->language->ajax
         *
         * @params
         *      -
         *
         * @post
         *      {DOT_ID}_language (string): AJAX request language
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
         *      framework : post() // Get a $_POST variable.
         *
         *      this : verify() // Verify if language is enabled.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      AJAX language ISO 639-1 code.
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
         * @return boolean|string
         */
        public function ajax(){
            global $DOT;

            /*
             * Get AJAX language.
             */
            $language = $DOT->post(DOT_ID.'_language');

            /*
             * Verify AJAX language.
             */
            return $language !== false && $this->verify($language)
                    ? substr($language,
                             0,
                             2)
                    : false;
        }

        /*
         * Get language.
         *
         * @usage
         *      In FILE search for function call: $this->get
         *      In FILE search for function call in hooks: array(&$this, 'get')
         *      In PROJECT search for function call: $DOT->classes->language->get
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
         *      this : ajax() // Get AJAX language.
         *      this : polylang() // Get Polylang language.
         *      this : user() // Get user language.
         *      this : wpml() // Get WPML language.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Language ISO 639-1 code.
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
         * @return string
         */
        public function get(){
            /*
             * Overwrite with  AJAX language.
             */
            $language_ajax = $this->ajax();

            if ($language_ajax !== false){
                return $language_ajax;
            }

            /*
             * Overwrite with WPML language.
             */
            $language_wpml = $this->wpml();

            if ($language_wpml !== false){
                return $language_wpml;
            }

            /*
             * Overwrite with Polylang language.
             */
            $language_polylang = $this->polylang();

            if ($language_polylang !== false){
                return $language_polylang;
            }

            /*
             * Get user language.
             */
            return $this->user();
        }

        /*
         * Get Polylang language.
         *
         * @usage
         *      In FILE search for function call: $this->polylang
         *      In FILE search for function call in hooks: array(&$this, 'polylang')
         *      In PROJECT search for function call: $DOT->classes->language->polylang
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
         *      pll_current_language() // Polylang current selected language.
         *
         *      this : verify() // Verify if language is enabled.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Polylang language ISO 639-1 code.
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
         * @return boolean|string
         */
        public function polylang(){
            global $DOT;

            /*
             * Get Polylang language.
             */
            $language = function_exists('pll_current_language')
                    ? substr(pll_current_language(),
                             0,
                             2)
                    : false;

            /*
             * Verify if language is enabled.
             */
            !$this->verify($language)
                    ? $language = false
                    : null;

            /*
             * Overwrite language.
             */
            $language !== false
                    ? $DOT->language_overwrite = true
                    : null;

            return $language;
        }

        /*
         * Get user language.
         *
         * @usage
         *      In FILE search for function call: $this->user
         *      In FILE search for function call in hooks: array(&$this, 'user')
         *      In PROJECT search for function call: $DOT->classes->permalink->user
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
         *      DOT (object): DOT framework main class variable
         *
         * @functions
         *      WP : add_user_meta() // Add WordPress user meta.
         *      WP : get_user_meta() // Get WordPress user meta.
         *      WP : is_network_admin() // Determines whether the current request is for the network administrative interface.
         *      WP : wp_get_current_user() // Get current logged in user data.
         *
         *      this : verify() // Verify if language is enabled.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      User language ISO 639-1 code.
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
         * @return string
         */
        public function user(){
            global $DOT;

            /*
             * Get user ID.
             */
            $user_id = wp_get_current_user()->ID;

            /*
             * Get language.
             */
            if (!is_network_admin()
                    && $user_id != 0){
                $language = get_user_meta($user_id,
                                          DOT_ID.'_language',
                                          true);

                /*
                 * Verify if language is enabled.
                 */
                if ($language == ''
                        || !$this->verify($language)){
                    add_user_meta($user_id,
                                  DOT_ID.'_language',
                                  $DOT->language_default,
                                  true);
                    $language = $DOT->language_default;
                }
            }
            else{
                $language = $DOT->language_default;
            }

            return substr($language,
                          0,
                          2);
        }

        /*
         * Verify if language is enabled.
         *
         * @usage
         *      In FILE search for function call: $this->verify
         *      In FILE search for function call in hooks: array(&$this, 'verify')
         *      In PROJECT search for function call: $DOT->classes->language->verify
         *
         * @params
         *      language (string) : language ISO 639-1 code
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
         *      WP : add_option() // Add WordPress option.
         *      WP : get_option() // Get WordPress option.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      "true" if language is enabled, "false" otherwise.
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
         * @param string $language
         *
         * @return boolean
         */
        public function verify($language){
            global $DOT;

            /*
             * Get languages
             */
            $languages = get_option(DOT_ID.'_languages');

            /*
             * Add languages.
             */
            $languages == ''
                    ? add_option(DOT_ID.'_languages',
                                 $DOT->language_default)
                    : null;

            return $languages != '' && str_contains($languages,
                                                    $language);
        }

        /*
         * Get WPML language.
         *
         * @usage
         *      In FILE search for function call: $this->wpml
         *      In FILE search for function call in hooks: array(&$this, 'wpml')
         *      In PROJECT search for function call: $DOT->classes->language->wpml
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
         *      framework/includes/class-hooks.php : set() // Set a hook.
         *
         * @hooks
         *      wpml_current_language (filter-wp): WPML current language
         *
         *      this : verify() // Verify if language is enabled.
         *
         * @layouts
         *      -
         *
         * @return
         *      WPML language ISO 639-1 code.
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
         * @return boolean|string
         */
        public function wpml(){
            global $DOT;

            /*
             * Get WPML language.
             */
            $language = $DOT->hooks->set('wpml_current_language',
                                         'filter-wp',
                                         null);

            $language = isset($language) && $this->verify($language)
                    ? substr($language,
                             0,
                             2)
                    : false;

            /*
             * Overwrite language.
             */
            $language !== false
                    ? $DOT->language_overwrite = true
                    : null;

            return $language;
        }
    }
}