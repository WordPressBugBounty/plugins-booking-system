<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-sanitize.php
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Sanitize PHP class.
 */

if (!class_exists('DOTSanitize')){
    class DOTSanitize{
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
         * Sanitize float values.
         *
         * @usage
         *      In FILE search for function call: $this->float
         *      In FILE search for function call in hooks: array(&$this, 'float')
         *      In PROJECT search for function call: $DOT->classes->sanitize->float
         *
         * @params
         *      value (mixed): the value to be sanitized
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
         *      Sanitized float value.
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
         * @param mixed $value
         *
         * @return float
         */
        public function float($value){
            return floatval($value);
        }

        /*
         * Sanitize values but allow HTML tags.
         *
         * @usage
         *      In FILE search for function call: $this->html
         *      In FILE search for function call in hooks: array(&$this, 'html')
         *      In PROJECT search for function call: $DOT->classes->sanitize->html
         *
         * @params
         *      value (mixed): the value to be sanitized
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
         *      Sanitized value with HTML tags intact.
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
         * @param mixed $value
         *
         * @return string
         */
        public function html($value){
            return stripslashes(wp_filter_post_kses($value));
        }

        /*
         * Sanitize integer values.
         *
         * @usage
         *      In FILE search for function call: $this->int
         *      In FILE search for function call in hooks: array(&$this, 'int')
         *      In PROJECT search for function call: $DOT->classes->sanitize->int
         *
         * @params
         *      value (mixed): the value to be sanitized
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
         *      Sanitized integer value.
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
         * @param mixed $value
         *
         * @return integer
         */
        public function int($value){
            return intval($value);
        }

        /*
         * Sanitize HTML tags from a value.
         *
         * @usage
         *      In FILE search for function call: $this->tags
         *      In FILE search for function call in hooks: array(&$this, 'tags')
         *      In PROJECT search for function call: $DOT->classes->sanitize->tags
         *
         * @params
         *      value (mixed): the value to be sanitized
         *      remove_all (boolean): "false" to remove only <script> & <style> tags, "true" for all
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
         *      Sanitized value with all HTML, <script> and <style> tags removed.
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
         * @param mixed $value
         * @param boolean $remove_all
         *
         * @return string
         */
        public function tags($value,
                             $remove_all = true){
            /*
             * Remove <script> and <style> tags.
             */
            $value = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si',
                                  '',
                                  $value);

            /*
             * Remove HTML tags.
             */
            return $remove_all
                    ? strip_tags($value)
                    : $value;
        }

        /*
         * Sanitize text values.
         *
         * @usage
         *      In FILE search for function call: $this->text
         *      In FILE search for function call in hooks: array(&$this, 'text')
         *      In PROJECT search for function call: $DOT->classes->sanitize->text
         *
         * @params
         *      value (mixed): the value to be sanitized
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
         *      Sanitized text value.
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
         * @param mixed $value
         *
         * @return string
         */
        public function text($value){
            /*
             * Clean quotes.
             */
            $value = str_replace('"',
                                 '&quot;',
                                 $value);

            return sanitize_text_field($value);
        }

        /*
         * Sanitize textarea values.
         *
         * @usage
         *      In FILE search for function call: $this->textarea
         *      In FILE search for function call in hooks: array(&$this, 'textarea')
         *      In PROJECT search for function call: $DOT->classes->sanitize->textarea
         *
         * @params
         *      value (mixed): the value to be sanitized
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
         *      Sanitized textarea value.
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
         * @param mixed $value
         *
         * @return string
         */
        public function textarea($value){
            /*
             * Clean quotes.
             */
            $value = str_replace('"',
                                 '&quot;',
                                 $value);

            return sanitize_textarea_field($value);
        }

        /*
         * Sanitize URL values.
         *
         * @usage
         *      In FILE search for function call: $this->url
         *      In FILE search for function call in hooks: array(&$this, 'url')
         *      In PROJECT search for function call: $DOT->classes->sanitize->url
         *
         * @params
         *      value (mixed): the value to be sanitized
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
         *      this : tags() // Sanitize HTML tags from a value.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Sanitized URL value.
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
         * @param mixed $value
         *
         * @return string
         */
        public function url($value){
            $value = (string)($value);

            /*
             * Return empty string if size is 0.
             */
            if (strlen($value) == 0){
                return '';
            }

            /*
             * Set HTML entities.
             */
            if (str_contains($value,
                             '<')){
                /*
                 * Convert lone "<" signs.
                 */
                $value = preg_replace_callback('%<[^>]*?((?=<)|>|$)%',
                        function($matches){
                            return !str_contains($matches[0],
                                                 '>')
                                    ? htmlspecialchars($matches[0])
                                    : $matches[0];
                        },
                                               $value);

                /*
                 * Remove HTML tags.
                 */
                $value = $this->tags($value);

                /*
                 * Convert special characters to HTML entities.
                 */
                $value = htmlspecialchars($value,
                                          ENT_COMPAT|ENT_HTML401,
                                          ini_get("default_charset"),
                                          false);

                /*
                 * Verify "<" before new lines to make sure new tags are not created when they are stripped.
                 */
                $value = str_replace('<\n',
                                     '&lt;\n',
                                     $value);
                $value = str_replace('<\r',
                                     '&lt;\r',
                                     $value);
                $value = str_replace('<\t',
                                     '&lt;\t',
                                     $value);
            }

            /*
             * Clean quotes.
             */
            $value = str_replace('"',
                                 '&quot;',
                                 $value);

            /*
             * Remove new lines.
             */
            return preg_replace('/[\r\n\t ]+/',
                                ' ',
                                $value);
        }
    }
}