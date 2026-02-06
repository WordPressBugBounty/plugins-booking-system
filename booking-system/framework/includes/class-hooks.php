<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-hooks.php
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Hooks PHP class.
 */

if (!class_exists('DOTHooks')){
    class DOTHooks{
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
         * Add a hook, where a function/method will be called.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *      The function needs to be called before the hook is set.
         *
         *      In FILE search for function call: $this->add
         *      In FILE search for function call in hooks: array(&$this, 'add')
         *      In PROJECT search for function call: $DOT->hooks->add
         *
         * @params
         *      hooks (string): action/filter hook
         *      type (string): hook type
         *                     "action" : the hook is an action
         *                     "action-wp" : the hook is an WordPress action
         *                     "filter" : the hook is a filter
         *                     "filter-wp" : the hook is an WordPress filter
         *      function (array/string): function to be called on hook
         *                               {array} : class method
         *                                         function[0] (object): class object
         *                                         function[1] (string): class method name
         *                               {string} : a function name that is outside a class
         *      priority (integer): the priority when a function will be called
         *      no_args (integer): the number of function arguments
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
         *      WP : add_action() // Hooks a function on to a specific action.
         *      WP : add_filter() // Hook a function or method to a specific filter action.
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
         * @noinspection PhpUnused
         *
         * @param string $hook
         * @param string $type
         * @param array|string $function
         * @param integer $priority
         * @param integer $no_args
         */
        function add($hook,
                     $type,
                     $function = null,
                     $priority = 10,
                     $no_args = 1){
            /*
             * Hook key.
             */
            $key = $type == 'action-wp' || $type == 'filter-wp'
                    ? $hook
                    : DOT_ID.'_'.$type.'_'.$hook;

            /*
             * Add hook.
             */
            $type == 'action' || $type == 'action-wp'
                    ? add_action($key,
                                 $function,
                                 $priority,
                                 $no_args)
                    : add_filter($key,
                                 $function,
                                 $priority,
                                 $no_args);
        }

        /*
         * Set a hook.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *      The function needs to be called after the hooks are added.
         *
         *      In FILE search for function call: $this->set
         *      In FILE search for function call in hooks: array(&$this, 'set')
         *      In PROJECT search for function call: $DOT->hooks->set
         *
         * @params
         *      hooks (string): action/filter hook
         *      type (string): hook type
         *                     "action" : the hook is an action
         *                     "action-wp" : the hook is an WordPress action
         *                     "filter" : the hook is a filter
         *                     "filter-wp" : the hook is an WordPress filter
         *      args (array/mixed): function to be called arguments
         *                          {array} : a list of arguments; the first array value for a filter is the value that needs to be modified
         *                          {mixed} : one argument value
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
         *      WP : apply_filters() // Call the functions added to a filter hook.
         *      WP : do_action() // Execute functions hooked on a specific action hook.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Return true when hook type is "action", or an updated value when hook type is "filter".
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
         * @noinspection PhpUnused
         *
         * @param string $hook
         * @param string $type
         * @param array $args
         *
         * @return mixed
         */
        function set($hook,
                     $type = 'action',
                     $args = array()){
            /*
             * Make sure the [args] variable is an array.
             */
            $args = is_array($args)
                    ? $args
                    : array($args);

            /*
             * Hook key.
             */
            $key = $type == 'action-wp' || $type == 'filter-wp'
                    ? $hook
                    : DOT_ID.'_'.$type.'_'.$hook;

            /*
             * Add the hook at the beginning of the arguments list.
             */
            array_unshift($args,
                          $key);

            /*
             * Execute hook.
             */
            return call_user_func_array($type == 'action' || $type == 'action-wp'
                                                ? 'do_action'
                                                : 'apply_filters',
                                        $args);
        }
    }
}