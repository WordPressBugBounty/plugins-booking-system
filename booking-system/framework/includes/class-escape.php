<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-escape.php
 * Author                  : Dot on Paper
 * Copyright               : © 2025 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Escape PHP class.
 */

if (!class_exists('DOTEscape')){
    class DOTEscape{
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
         * Escape HTML attribute values.
         *
         * @usage
         *      In FILE search for function call: $this->attr
         *      In FILE search for function call in hooks: array(&$this, 'attr')
         *      In PROJECT search for function call: $DOT->classes->escape->attr
         *
         * @params
         *      value (mixed): the value to be escaped
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
         *      Escaped HTML attribute value.
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
        public function attr($value){
            return esc_attr($value);
        }

        /*
         * Escape content values.
         *
         * @usage
         *      In FILE search for function call: $this->content
         *      In FILE search for function call in hooks: array(&$this, 'content')
         *      In PROJECT search for function call: $DOT->classes->escape->content
         *
         * @params
         *      value (mixed): the value to be escaped
         *      html (array): allowed HTML
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
         *      Escaped content value.
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
         * @param array $html
         *
         * @return string
         */
        public function content($value,
                                $html = array()){
            return wp_kses($value,
                           $html);
        }

        /*
         * Escape float values.
         *
         * @usage
         *      In FILE search for function call: $this->float
         *      In FILE search for function call in hooks: array(&$this, 'float')
         *      In PROJECT search for function call: $DOT->classes->escape->float
         *
         * @params
         *      value (mixed): the value to be escaped
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
         *      Escaped float value.
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
            return (float)$value;
        }

        /*
         * Escape HTML in values.
         *
         * @usage
         *      In FILE search for function call: $this->html
         *      In FILE search for function call in hooks: array(&$this, 'html')
         *      In PROJECT search for function call: $DOT->classes->escape->html
         *
         * @params
         *      value (mixed): the value to be escaped
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
         *      Value with escaped HTML.
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
            return esc_html($value);
        }

        /*
         * Escape integer values.
         *
         * @usage
         *      In FILE search for function call: $this->int
         *      In FILE search for function call in hooks: array(&$this, 'int')
         *      In PROJECT search for function call: $DOT->classes->escape->int
         *
         * @params
         *      value (mixed): the value to be escaped
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
         *      Escaped integer value.
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
            return (int)$value;
        }

        /*
         * Escape JS values.
         *
         * @usage
         *      In FILE search for function call: $this->js
         *      In FILE search for function call in hooks: array(&$this, 'js')
         *      In PROJECT search for function call: $DOT->classes->escape->js
         *
         * @params
         *      value (mixed): the value to be escaped
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
         *      Escaped JS value.
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
        public function js($value){
            return esc_js($value);
        }

        /*
         * Escape JSON values.
         *
         * @usage
         *      In FILE search for function call: $this->json
         *      In FILE search for function call in hooks: array(&$this, 'json')
         *      In PROJECT search for function call: $DOT->classes->escape->json
         *
         * @params
         *      value (mixed): the value to be escaped
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
         *      Escaped JSON value.
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
        public function json($value){
            return wp_json_encode($value);
        }

        /*
         * Escape textarea values.
         *
         * @usage
         *      In FILE search for function call: $this->textarea
         *      In FILE search for function call in hooks: array(&$this, 'textarea')
         *      In PROJECT search for function call: $DOT->classes->escape->textarea
         *
         * @params
         *      value (mixed): the value to be escaped
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
         *      Escaped textarea value.
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
            return esc_textarea($value);
        }

        /*
         * Escape URL values.
         *
         * @usage
         *      In FILE search for function call: $this->url
         *      In FILE search for function call in hooks: array(&$this, 'url')
         *      In PROJECT search for function call: $DOT->classes->escape->url
         *
         * @params
         *      value (mixed): the value to be escaped
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
         *      Escaped URL value.
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
            return esc_url($value);
        }
    }
}