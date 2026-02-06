<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : includes/forms/class-backend-form.php
* File Version            : 1.0.2
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end form PHP class.
*/

if (!class_exists('DOPBSPBackEndForm')){
    class DOPBSPBackEndForm{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Add a form.
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
            $wpdb->insert($DOPBSP->tables->forms,
                          array('user_id' => wp_get_current_user()->ID,
                                'name'    => $DOPBSP->text('FORMS_ADD_FORM_NAME')));

            $DOPBSP->classes->backend_forms->display();

            die();
        }

        /*
         * Prints out the form.
         *
         * @post id (integer): form ID
         * @post language (string): form current editing language
         *
         * @return form HTML
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

            $DOPBSP->views->backend_form->template(array('id'       => $id,
                                                         'language' => $language));
            $DOPBSP->views->backend_form_fields->template(array('id'       => $id,
                                                                'language' => $language));

            die();
        }

        /*
         * Edit form fields.
         *
         * @post id (integer): form ID
         * @post field (string): form field
         * @post value (string): field new value
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
            $wpdb->update($DOPBSP->tables->forms,
                          array($DOT->post('field') => $DOT->post('value')),
                          array('id' => $DOT->post('id',
                                                   'int')));

            die();
        }

        /*
         * Delete form.
         *
         * @post id (integer): form ID
         *
         * @return number of forms left
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
             * Delete form.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->forms,
                          array('id' => $id));

            /*
             * Delete form fields.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $fields = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE form_id=%d',
                                                        $DOPBSP->tables->forms_fields,
                                                        $id));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->forms_fields,
                          array('form_id' => $id));

            /*
             * Delete form fields select options.
             */
            foreach ($fields as $field){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->delete($DOPBSP->tables->forms_fields_options,
                              array('field_id' => $field->id));
            }

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id DESC',
                                              $DOPBSP->tables->forms));

            $DOT->echo($wpdb->num_rows,
                       'int');

            die();
        }
    }
}