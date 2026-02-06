<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : includes/extras/class-backend-extra.php
* File Version            : 1.0.3
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end extra PHP class.
*/

if (!class_exists('DOPBSPBackEndExtra')){
    class DOPBSPBackEndExtra{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Add an extra.
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
            $wpdb->insert($DOPBSP->tables->extras,
                          array('user_id' => wp_get_current_user()->ID,
                                'name'    => $DOPBSP->text('EXTRAS_ADD_EXTRA_NAME')));

            $DOPBSP->classes->backend_extras->display();

            die();
        }

        /*
         * Prints out the extra.
         *
         * @post id (integer): extra ID
         * @post language (string): extra current editing language
         *
         * @return extra HTML
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

            $DOPBSP->views->backend_extra->template(array('id'       => $id,
                                                          'language' => $language));
            $DOPBSP->views->backend_extra_groups->template(array('id'       => $id,
                                                                 'language' => $language));

            die();
        }

        /*
         * Edit extra fields.
         *
         * @post id (integer): extra ID
         * @post field (string): extra field
         * @post value (string): group new value
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

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->update($DOPBSP->tables->extras,
                          array($DOT->post('field') => $DOT->post('value')),
                          array('id' => $DOT->post('id',
                                                   'int')));

            die();
        }

        /*
         * Delete extra.
         *
         * @post id (integer): extra ID
         *
         * @return number of extras left
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
             * Delete extra.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->extras,
                          array('id' => $id));

            /*
             * Delete extra groups.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $groups = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE extra_id=%d',
                                                        $DOPBSP->tables->extras_groups,
                                                        $id));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->extras_groups,
                          array('extra_id' => $id));

            /*
             * Delete extra groups items.
             */
            foreach ($groups as $group){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->delete($DOPBSP->tables->extras_groups_items,
                              array('group_id' => $group->id));
            }

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id DESC',
                                              $DOPBSP->tables->extras));

            $DOT->echo($wpdb->num_rows,
                       'int');

            die();
        }
    }
}