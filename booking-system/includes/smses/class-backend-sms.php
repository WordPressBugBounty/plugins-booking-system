<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Author                  : PINPOINT.WORLD
* Copyright               : © 2018 PINPOINT.WORLD
* Website                 : http://www.pinpoint.world
* Description             : Back end sms PHP class.
*/

if (!class_exists('DOPBSPBackEndSms')){
    class DOPBSPBackEndSms{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Add an SMS.
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
            $wpdb->insert($DOPBSP->tables->smses,
                          array('user_id' => wp_get_current_user()->ID,
                                'name'    => $DOPBSP->text('SMSES_ADD_SMS_NAME')));
            $sms_id = $wpdb->insert_id;

            /*
             * Simple book.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->smses_translation,
                          array('sms_id'   => $sms_id,
                                'template' => 'book_admin',
                                'message'  => $DOPBSP->classes->backend_sms->defaultTemplate('SMSES_DEFAULT_BOOK_ADMIN')));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->smses_translation,
                          array('sms_id'   => $sms_id,
                                'template' => 'book_user',
                                'message'  => $DOPBSP->classes->backend_sms->defaultTemplate('SMSES_DEFAULT_BOOK_USER')));
            /*
             * Book with approval.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->smses_translation,
                          array('sms_id'   => $sms_id,
                                'template' => 'book_with_approval_admin',
                                'message'  => $DOPBSP->classes->backend_sms->defaultTemplate('SMSES_DEFAULT_BOOK_WITH_APPROVAL_ADMIN')));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->smses_translation,
                          array('sms_id'   => $sms_id,
                                'template' => 'book_with_approval_user',
                                'message'  => $DOPBSP->classes->backend_sms->defaultTemplate('SMSES_DEFAULT_BOOK_WITH_APPROVAL_USER')));
            /*
             * Approved
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->smses_translation,
                          array('sms_id'   => $sms_id,
                                'template' => 'approved',
                                'message'  => $DOPBSP->classes->backend_sms->defaultTemplate('SMSES_DEFAULT_APPROVED')));
            /*
             * Canceled
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->smses_translation,
                          array('sms_id'   => $sms_id,
                                'template' => 'canceled',
                                'message'  => $DOPBSP->classes->backend_sms->defaultTemplate('SMSES_DEFAULT_CANCELED')));
            /*
             * Rejected
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->smses_translation,
                          array('sms_id'   => $sms_id,
                                'template' => 'rejected',
                                'message'  => $DOPBSP->classes->backend_sms->defaultTemplate('SMSES_DEFAULT_REJECTED')));

            /*
             * Payment gateways.
             */
            $pg_list = $DOPBSP->classes->payment_gateways->get();

            for ($i = 0; $i<count($pg_list); $i++){
                $pg_id = $pg_list[$i];

                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->insert($DOPBSP->tables->smses_translation,
                              array('sms_id'   => $sms_id,
                                    'template' => $pg_id.'_admin',
                                    'message'  => $DOPBSP->classes->backend_sms->defaultTemplate('SMSES_DEFAULT_'.strtoupper($pg_id).'_ADMIN')));
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->insert($DOPBSP->tables->smses_translation,
                              array('sms_id'   => $sms_id,
                                    'template' => $pg_id.'_user',
                                    'message'  => $DOPBSP->classes->backend_sms->defaultTemplate('SMSES_DEFAULT_'.strtoupper($pg_id).'_USER')));
            }

            $DOPBSP->classes->backend_smses->display();

            die();
        }

        /*
         * Prints out the SMS.
         *
         * @post id (integer): SMS ID
         * @post language (string): Current SMS editing language
         * @param template (string): SMS template key
         *
         * @return SMS HTML
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
            $template = $DOT->post('template');

            $DOPBSP->views->backend_sms->template(array('id'       => $id,
                                                        'language' => $language,
                                                        'template' => $template));

            die();
        }

        /*
         * Get SMS template and if it does not exist create a new one.
         *
         * @param id (integer): SMS ID
         * @param template (string): SMS template key
         *
         * @return SMS template
         */
        function get($id,
                     $template){
            global $wpdb;
            global $DOPBSP;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $template_data = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE sms_id=%d AND template=%s',
                                                           $DOPBSP->tables->smses_translation,
                                                           $id,
                                                           $template));

            if ($template_data == ''){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->insert($DOPBSP->tables->smses_translation,
                              array('sms_id'   => $id,
                                    'template' => $template,
                                    'message'  => $DOPBSP->classes->backend_sms->defaultTemplate('SMSES_DEFAULT_'.strtoupper($template))));
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $template_data = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE sms_id=%d AND template=%s',
                                                               $DOPBSP->tables->smses_translation,
                                                               $id,
                                                               $template));
            }

            return $template_data;
        }

        /*
         * Edit SMS fields.
         *
         * @post id (integer): SMS ID
         * @post template (string): SMS template
         * @post field (string): SMS field
         * @post value (string): SMS new value
         * @post language (string): SMS selected language
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
            $template = $DOT->post('template');
            $field = $DOT->post('field');
            $value = $DOT->post('value');
            $language = $DOT->post('language');

            if ($field != 'name'){
                $value = str_replace("\n",
                                     '<<new-line>>',
                                     $value);
                $value = str_replace("\'",
                                     '<<single-quote>>',
                                     $value);
                $value = mb_convert_encoding($value,
                                             'UTF-8',
                                             'ISO-8859-1');

                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $sms_translation = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE sms_id=%d AND template=%s',
                                                                 $DOPBSP->tables->smses_translation,
                                                                 $id,
                                                                 $template));

                $translation = json_decode($sms_translation->$field);
                $translation->$language = $value;
                $value = json_encode($translation);

                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->update($DOPBSP->tables->smses_translation,
                              array($field => $value),
                              array('sms_id'   => $id,
                                    'template' => $template));
            }
            else{
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->update($DOPBSP->tables->smses,
                              array($field => $value),
                              array('id' => $id));
            }

            die();
        }

        /*
         * Delete SMS.
         *
         * @post id (integer): SMS ID
         *
         * @return number of SMSes left
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
             * Delete sms.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->smses,
                          array('id' => $id));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->smses_translation,
                          array('sms_id' => $id));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id DESC',
                                              $DOPBSP->tables->smses));

            $DOT->echo($wpdb->num_rows,
                       'int');
            die();
        }

        /*
         * Default SMS template.
         *
         * @param key (string): translation key
         *
         * @return default SMS content
         */
        function defaultTemplate($key = ''){
            global $DOPBSP;

            return $DOPBSP->classes->translation->encodeJSON($key,
                                                             '',
                                                             '',
                                                             '|DETAILS|');
        }
    }
}