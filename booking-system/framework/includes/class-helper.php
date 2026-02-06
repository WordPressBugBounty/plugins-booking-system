<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-helper.php
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Helper PHP class.
 */

if (!class_exists('DOTHelper')){
    class DOTHelper{
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
         * Calculates the duration for PHP operations between start and end time.
         *
         * @usage:
         *      In FILE search for function call: $this->duration
         *      In FILE search for function call in hooks: array(&$this, 'duration')
         *      In PROJECT search for function call: $DOT->classes->helper->duration
         *
         *      $time_start = microtime(true);
         *
         *      // code goes here
         *
         *      $time_end = microtime(true);
         *
         *      $DOT->classes->helper->duration(array('info' => 'Total time',
         *                                            'time_start' => $time_start,
         *                                            'time_end' => microtime(true)));
         *
         * @param
         *      args (array): function arguments
         *                    info (string): info text
         *                    time_start (string): execution start time
         *                    time_end (string): execution end time
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
         *      The execution duration of the PHP code.
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
         * @param array $args
         */
        public function duration($args = array()){
            global $DOT;

            $info = $args['info'] ?? 'Total duration';
            $time_start = $args['time_start'];
            $time_end = $args['time_end'];

            $DOT->echo('<br />',
                       'content',
                       ['br' => []]);

            $DOT->echo($info.': ');
            $DOT->echo(sprintf('%0.21fs',
                               $time_end-$time_start));
            $DOT->echo('<br />',
                       'content',
                       ['br' => []]);
        }

        /*
         * Calculates the memory usage.
         *
         * @usage:
         *      In FILE search for function call: $this->memory
         *      In FILE search for function call in hooks: array(&$this, 'memory')
         *      In PROJECT search for function call: $DOT->classes->helper->memory
         *
         * @param
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
         *      How much memory is used.
         *
         * @return_details
         *      The function will display:
         *          - PHP memory usage and percent from total memory;
         *          - PHP memory peak usage and percent from total memory;
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         */
        public function memory(){
            $memory_php_usage = memory_get_usage();
            $memory_php_peak_usage = memory_get_peak_usage();

            $DOT->echo('<br />',
                       'content',
                       ['br' => []]);

            $DOT->echo('PHP memory usage: ');
            $DOT->echo($memory_php_usage<1024
                               ? $memory_php_usage.' bytes'
                               : ($memory_php_usage<1048576
                            ? round($memory_php_usage/1024,
                                    2).' KB'
                            : round($memory_php_usage/1048576,
                                    2).' MB'));
            $DOT->echo('<br />',
                       'content',
                       ['br' => []]);

            $DOT->echo('PHP memory peak usage: ');
            $DOT->echo($memory_php_peak_usage<1024
                               ? $memory_php_peak_usage.' bytes'
                               : ($memory_php_peak_usage<1048576
                            ? round($memory_php_peak_usage/1024,
                                    2).' KB'
                            : round($memory_php_peak_usage/1048576,
                                    2).' MB'));
            $DOT->echo('<br />',
                       'content',
                       ['br' => []]);
        }
    }
}