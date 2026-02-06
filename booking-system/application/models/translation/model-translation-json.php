<?php

/*
 * Title                   : Pinpoint Booking System
 * File                    : application/models/translation/model-translation-json.php
 * Author                  : Dot on Paper
 * Copyright               : © 2017 Dot on Paper
 * Website                 : https://www.dotonpaper.net
 * Description             : Translation JSON model PHP class.
 */

if (!class_exists('DOTModelTranslationJson')){
    class DOTModelTranslationJson{
        /*
         * Constructor
     *
     * @usage
     *	    The constructor is called when a class instance is created.
     *
         * @params
     *	    -
     *
     * @post
     *	    -
     *
     * @get
     *	    -
     *
     * @sessions
     *	    -
     *
     * @cookies
     *	    -
     *
     * @constants
     *	    -
     *
     * @globals
     *	    -
     *
     * @functions
     *	    -
     *
     * @hooks
     *	    -
     *
     * @layouts
     *	    -
     *
     * @return
     *	    -
     *
     * @return_details
     *	    -
     *
     * @dv
     *	    -
     *
     * @tests
     *	    -
         */
        function __construct(){
        }

        /*
         * Get all days between 2 dates.
     *
     * @usage
     *	    -
     *
         * @params
     *	    day_start (string): start day in "YYYY-MM-DD" format
         *	    day_end (string): end day in "YYYY-MM-DD" format
     *
     * @post
     *	    -
     *
     * @get
     *	    -
     *
     * @sessions
     *	    -
     *
     * @cookies
     *	    -
     *
     * @constants
     *	    -
     *
     * @globals
     *	    -
     *
     * @functions
     *	    -
     *
     * @hooks
     *	    -
     *
     * @layouts
     *	    -
     *
     * @return
     *	    A list with all the days.
     *
     * @return_details
     *	    -
     *
     * @dv
     *	    -
     *
     * @tests
     *	    -
         */
        function encode($key,
                        $text = '',
                        $pref_text = '',
                        $suff_text = ''){
            global $wpdb;
            global $DOPBSP;

            $json = array();

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $languages = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE enabled="true"',
                                                           $DOPBSP->tables->languages));

            foreach ($languages as $language){
                if ($key != ''){
                    //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                    $translation = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE key_data=%s',
                                                                 $DOPBSP->tables->translation.'_'.$language->code,
                                                                 $key));
                    $json[] = '"'
                            .$language->code
                            .'": "'
                            .$pref_text
                            .mb_convert_encoding($translation->text_data,
                                                 'UTF-8',
                                                 'ISO-8859-1')
                            .$suff_text
                            .'"';
                }
                else{
                    $json[] = '"'
                            .$language->code
                            .'": "'
                            .$pref_text
                            .mb_convert_encoding($text,
                                                 'UTF-8',
                                                 'ISO-8859-1')
                            .$suff_text.
                            '"';
                }
            }

            return '{'.implode(',',
                               $json).'}';
        }
    }
}