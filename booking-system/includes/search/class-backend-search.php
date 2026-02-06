<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : includes/search/class-backend-search.php
* File Version            : 1.0.2
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end search PHP class.
*/

if (!class_exists('DOPBSPBackEndSearch')){
    class DOPBSPBackEndSearch{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Add a search.
         */
        function add(){
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
            $wpdb->insert($DOPBSP->tables->searches,
                          array('user_id' => wp_get_current_user()->ID,
                                'name'    => $DOPBSP->text('SEARCHES_ADD_SEARCH_NAME')));

            $DOPBSP->classes->backend_searches->display();

            die();
        }

        /*
         * Prints out the search.
         *
         * @post id (integer): search ID
         * @post language (string): search current editing language
         *
         * @return search HTML
         */
        function display(){
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

            $id = $DOT->post('id',
                             'int');
            $language = $DOT->post('language');

            $DOPBSP->views->backend_search->template(array('id'       => $id,
                                                           'language' => $language));

            die();
        }

        /*
         * Edit search fields.
         *
         * @post id (integer): search ID
         * @post field (string): search field
         * @post value (string): search new value
         */
        function edit(){
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

            $id = $DOT->post('id',
                             'int');
            $field = $DOT->post('field');
            $value = $DOT->post('value');

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->update($DOPBSP->tables->searches,
                          array($field => $value),
                          array('id' => $id));

            die();
        }

        /*
         * Delete search.
         *
         * @post id (integer): search ID
         *
         * @return number of searches left
         */
        function delete(){
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

            $id = $DOT->post('id',
                             'int');

            /*
             * Delete search.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->searches,
                          array('id' => $id));

            /*
             * Delete search settings.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->settings_search,
                          array('search_id' => $id));

            /*
             * Count the number of remaining searches.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id DESC',
                               $DOPBSP->tables->searches));

            $DOT->echo($wpdb->num_rows,
                       'int');

            die();
        }
    }
}