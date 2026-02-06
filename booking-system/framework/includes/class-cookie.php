<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-cookie.php
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Cookie PHP class.
 */

if (!class_exists('DOTCookie')){
    class DOTCookie{
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
         * Delete a cookie.
         *
         * @usage
         *      In FILE search for function call: $this->delete
         *      In FILE search for function call in hooks: array(&$this, 'delete')
         *      In PROJECT search for function call: $DOT->classes->cookie->delete
         *
         * @params
         *      name (string): cookie name
         *      value (string): cookie value
         *      expire (integer): cookie lifetime in seconds
         *      path (string): the path where the cookie is available
         *      domain (string): the (sub)domain where the cookie is available
         *      secure (boolean): the cookie should be available over a https connection or not
         *      http (boolean): the cookie should be made accessible only through the HTTP protocol
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
         *      DOT_COOKIE_EXPIRE (integer): default cookie expiration time in seconds
         *      DOT_COOKIE_PATH (string): default cookie path
         *      DOT_COOKIE_DOMAIN (string): default cookie (sub)domain
         *      DOT_COOKIE_SECURE (boolean): default cookie security
         *      DOT_COOKIE_HTTP (boolean): default cookie HTTP access
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
         *      Return "true" after the cookie is deleted or "false" if it is not.
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
         * @param string $name
         * @param string $value
         * @param integer $expire
         * @param string $path
         * @param string $domain
         * @param boolean $secure
         * @param boolean $http
         *
         * @return boolean
         */
        public function delete($name,
                               $value,
                               $expire = DOT_COOKIE_EXPIRE,
                               $path = DOT_COOKIE_PATH,
                               $domain = DOT_COOKIE_DOMAIN,
                               $secure = DOT_COOKIE_SECURE,
                               $http = DOT_COOKIE_HTTP){
            if (isset($_COOKIE[$name])){
                unset($_COOKIE[$name]);

                return setcookie($name,
                                 $value,
                                 $expire,
                                 $path,
                                 $domain,
                                 $secure,
                                 $http);
            }
            else{
                return true;
            }
        }

        /*
         * Get a cookie variable.
         *
         * @usage
         *      In FILE search for function call: $this->get
         *      In FILE search for function call in hooks: array(&$this, 'get')
         *      In PROJECT search for function call: $DOT->classes->cookie->get
         *
         * @params
         *      name (string): cookie name
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
         *      Cookie value or "false" if the cookie does not exist.
         *
         * @return_details
         * -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @param string $name
         *
         * @return mixed|false
         */
        public function get($name){
            return $_COOKIE[$name] ?? false;
        }

        /*
         * Set a cookie.
         *
         * @usage
         *      In FILE search for function call: $this->set
         *      In FILE search for function call in hooks: array(&$this, 'set')
         *      In PROJECT search for function call: $DOT->classes->cookie->set
         *
         * @params
         *      name (string): cookie name
         *      value (string): cookie value
         *      expire (integer): cookie lifetime in seconds
         *      path (string): the path where the cookie is available
         *      domain (string): the (sub)domain where the cookie is available
         *      secure (boolean): the cookie should be available over a https connection or not
         *      http (boolean): the cookie should be made accessible only through the HTTP protocol
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
         *      DOT_COOKIE_EXPIRE (integer): default cookie expiration time in seconds
         *      DOT_COOKIE_PATH (string): default cookie path
         *      DOT_COOKIE_DOMAIN (string): default cookie (sub)domain
         *      DOT_COOKIE_SECURE (boolean): default cookie security
         *      DOT_COOKIE_HTTP (boolean): default cookie HTTP access
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
         *      Return "true" after the cookie is set or "false" if it is not.
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
         * @param string $name
         * @param string $value
         * @param integer $expire
         * @param string $path
         * @param string $domain
         * @param boolean $secure
         * @param boolean $http
         *
         * @return boolean
         */
        public function set($name,
                            $value,
                            $expire = DOT_COOKIE_EXPIRE,
                            $path = DOT_COOKIE_PATH,
                            $domain = DOT_COOKIE_DOMAIN,
                            $secure = DOT_COOKIE_SECURE,
                            $http = DOT_COOKIE_HTTP){
            return setcookie($name,
                             $value,
                             time()+$expire,
                             $path,
                             $domain,
                             $secure,
                             $http);
        }
    }
}