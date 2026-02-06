<?php

/*
 * Title                   : Pinpoint Booking System
 * File                    : application/models/schedule/model-allowed-html.php
 * Author                  : Dot on Paper
 * Copyright               : © 2025 Dot on Paper
 * Website                 : https://www.dotonpaper.net
 * Description             : Allowed HTML model PHP class.
 */

if (!class_exists('DOTModelAllowedHtml')){
    class DOTModelAllowedHtml{
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
         * Input allowed HTML.
         *
         * @usage
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
         *      Text input allowed HTML array.
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
        function input(){
            return ['a'     => ['class'   => [],
                                'href'    => [],
                                'onclick' => [],
                                'target'  => []],
                    'br'    => [],
                    'div'   => ['class' => [],
                                'id'    => []],
                    'input' => ['checked'  => [],
                                'class'    => [],
                                'disabled' => [],
                                'id'       => [],
                                'name'     => [],
                                'onblur'   => [],
                                'onchange' => [],
                                'onclick'  => [],
                                'onkeyup'  => [],
                                'onpaste'  => [],
                                'type'     => [],
                                'value'    => []],
                    'label' => ['class' => [],
                                'for'   => [],
                                'id'    => []],
                    'span'  => ['class' => []],
                    'style' => []];
        }

        /*
         * Items allowed HTML.
         *
         * @usage
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
         *      Items allowed HTML array.
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
        function items(){
            return ['br'   => ['class' => []],
                    'div'  => ['class' => []],
                    'img'  => ['alt'      => [],
                               'class'    => [],
                               'decoding' => [],
                               'height'   => [],
                               'loading'  => [],
                               'srcset'   => [],
                               'width'    => []],
                    'li'   => ['class'   => [],
                               'id'      => [],
                               'onclick' => []],
                    'ul'   => ['class' => []],
                    'span' => ['class' => []]];
        }

        /*
         * Select input allowed HTML.
         *
         * @usage
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
         *      Select input allowed HTML array.
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
        function select(){
            return ['a'      => ['class'  => [],
                                 'href'   => [],
                                 'target' => []],
                    'br'     => [],
                    'div'    => ['class' => []],
                    'label'  => ['class' => [],
                                 'for'   => [],
                                 'id'    => []],
                    'option' => ['selected' => [],
                                 'value'    => []],
                    'script' => [],
                    'select' => ['class'    => [],
                                 'id'       => [],
                                 'name'     => [],
                                 'onchange' => []],
                    'span'   => ['class' => []]];
        }

        /*
         * Textarea allowed HTML.
         *
         * @usage
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
         *      Textarea allowed HTML array.
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
        function textarea(){
            return ['a'        => ['class'   => [],
                                   'href'    => [],
                                   'onclick' => [],
                                   'target'  => []],
                    'br'       => [],
                    'div'      => ['class' => []],
                    'label'    => ['class' => [],
                                   'for'   => [],
                                   'id'    => []],
                    'span'     => ['class' => []],
                    'textarea' => ['class'    => [],
                                   'cols'     => [],
                                   'id'       => [],
                                   'name'     => [],
                                   'rows'     => [],
                                   'onchange' => [],
                                   'onblur'   => [],
                                   'onkeyup'  => [],
                                   'onpaste'  => []]];
        }
    }
}