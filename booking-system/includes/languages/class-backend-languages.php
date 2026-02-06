<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : includes/languages/class-backend-languages.php
* File Version            : 1.0.1
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end languages PHP class.
*/

if (!class_exists('DOPBSPBackEndLanguages')){
    class DOPBSPBackEndLanguages{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Add languages to database if it does not exist.
         */
        function database(){
            global $wpdb;
            global $DOPBSP;

            $languages = $DOPBSP->classes->languages->languages;
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $languages_db = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id ASC',
                                                              $DOPBSP->tables->languages));

            for ($l = 0; $l<count($languages); $l++){
                $found = false;

                for ($l_db = 0; $l_db<count($languages_db); $l_db++){
                    if ($languages[$l]['code'] == $languages_db[$l_db]->code){
                        $found = true;
                        break;
                    }
                }

                if (!$found){
                    //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                    $wpdb->insert($DOPBSP->tables->languages,
                                  array('code'    => $languages[$l]['code'],
                                        'enabled' => 'false',
                                        'name'    => $languages[$l]['name']));
                }
            }

            for ($l_db = 0; $l_db<count($languages_db); $l_db++){
                $found = false;

                for ($l = 0; $l<count($languages); $l++){
                    if ($languages[$l]['code'] == $languages_db[$l_db]->code){
                        $found = true;
                        break;
                    }
                }

                if (!$found){
                    //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                    $wpdb->delete($DOPBSP->tables->languages,
                                  array('code' => $languages_db[$l_db]->code));
                }
            }
        }

        /*
         * Display languages to enable/disable them.
         *
         * @return HTML languages list
         */
        function display(){
            global $wpdb;
            global $DOPBSP;
            global $DOT;

            /*
             * Verify nonce.
             */
            $nonce = $DOT->post('nonce');

            if (!wp_verify_nonce($nonce,
                                 'dopbsp_user_nonce')){
                return false;
            }
            /*
             * End verify nonce.
             */

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $languages = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id ASC',
                                                           $DOPBSP->tables->languages));

            if (count($languages) != count($DOPBSP->classes->languages->languages)){
                $this->database();
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $languages = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id ASC',
                                                               $DOPBSP->tables->languages));
            }

            $DOPBSP->views->backend_languages->template(array('languages' => $languages));

            die();
        }
    }
}