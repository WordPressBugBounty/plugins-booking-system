/*
 * Title                   : DOT Framework
 * File                    : framework/assets/js/sanitize.js
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : JavaScript sanitize functions.
 */

/*
 * @TODO
 *      Add more sanitize functions like in PHP.
 */

DOT.sanitize = new function(){
    'use strict';

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
    this.__construct = function(){
    };

    /*
     * Sanitize value against malicious content or just return the correct value format.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.sanitize.get
     *
     * @params
     *      value (Mixed): the value to be sanitized
     *      type (String): sanitization type
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
     *      this : float() // Sanitize float values.
     *      this : int() // Sanitize integer values.
     *      this : text() // Sanitize text values.
     *
     * @hooks
     *      -
     *
     * @layouts
     *      -
     *
     * @return
     *      Sanitized value.
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
     * @param {*} value
     * @param {String} type
     *
     * @returns {*}
     */
    this.get = function(value,
                        type){
        /*
         * Verify parameters values.
         */
        type = type === undefined
                ? 'text'
                : type;

        /*
         * Sanitize
         */
        switch (type){
            case 'float':
                return DOT.sanitize.float(value);
            case 'int':
                return DOT.sanitize.int(value);
            case 'text':
            case 'textarea':
                return DOT.sanitize.text(value);
        }
    };

    /*
     * Sanitize float values.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.sanitize.float
     *
     * @params
     *      value (Mixed): the value to be sanitized
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
     *
     * @param {*} value
     *
     * @returns {Number}
     */
    this.float = function(value){
        return parseFloat(value);
    };

    /*
     * Sanitize integer values.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.sanitize.int
     *
     * @params
     *      value (Mixed): the value to be sanitized
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
     * @param {*} value
     *
     * @returns {Number}
     */
    this.int = function(value){
        return parseInt(value);
    };

    /*
     * Sanitize text values.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.sanitize.text
     *
     * @params
     *      value (Mixed): the value to be sanitized
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
     * @param {*} value
     *
     * @returns {*}
     */
    this.text = function(value){
        return value;
    };

    return this.__construct();
};