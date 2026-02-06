<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : includes/api/class-backend-api-key.php
* File Version            : 1.0
* Created / Last Modified : 04 September 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end API key PHP class.
*/

if (!class_exists('DOPBSPBackEndAPIKey')){
    class DOPBSPBackEndAPIKey{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Get current user API key or create one.
         *
         * @return API key
         */
        function get(){
            global $wpdb;
            global $DOPBSP;

            $user_id = wp_get_current_user()->ID;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $data = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d ORDER BY id DESC',
                                                  $DOPBSP->tables->api_keys,
                                                  $user_id));

            if ($wpdb->num_rows>0){
                return $data->api_key.'-'.$user_id;
            }
            else{
                /*
                 * Add API key.
                 */
                $new_api_key = $DOPBSP->classes->prototypes->getRandomString(32);

                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->insert($DOPBSP->tables->api_keys,
                              array('user_id' => $user_id,
                                    'api_key' => $new_api_key));

                return $new_api_key.'-'.$user_id;
            }
        }

        /*
         * Verify the API key.
         *
         * @param key (string): key to be verified
         *
         * @return boolean value
         */
        function verify($key){
            global $wpdb;
            global $DOPBSP;

            $tokens = explode('-',
                              $key);
            $api_key = $tokens[0];
            $user_id = $tokens[1];

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE api_key=%s AND user_id=%d ORDER BY id DESC',
                                          $DOPBSP->tables->api_keys,
                                          $api_key,
                                          $user_id));

            return $wpdb->num_rows>0;
        }

        /*
         * Reset the API key.
         *
         * @post user_id (integer): user ID
         *
         * @return new key
         */
        function reset(){
            global $DOT;
            global $wpdb;
            global $DOPBSP;

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

            $user_id = $DOT->post('user_id',
                                  'int');

            $new_api_key = $DOPBSP->classes->prototypes->getRandomString(32);

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->update($DOPBSP->tables->api_keys,
                          array('api_key' => $new_api_key),
                          array('user_id' => $user_id));
            $DOT->echo($new_api_key.'-'.$user_id);

            die();
        }
    }
}