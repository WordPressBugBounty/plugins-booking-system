<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : includes/emails/class-backend-email.php
* File Version            : 1.0.5
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end email PHP class.
*/

if (!class_exists('DOPBSPBackEndEmail')){
    class DOPBSPBackEndEmail{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Add an email.
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
            $wpdb->insert($DOPBSP->tables->emails,
                          array('user_id' => wp_get_current_user()->ID,
                                'name'    => $DOPBSP->text('EMAILS_ADD_EMAIL_NAME')));
            $email_id = $wpdb->insert_id;

            /*
             * Simple book.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->emails_translation,
                          array('email_id' => $email_id,
                                'template' => 'book_admin',
                                'subject'  => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_BOOK_ADMIN_SUBJECT'),
                                'message'  => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_BOOK_ADMIN')));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->emails_translation,
                          array('email_id' => $email_id,
                                'template' => 'book_user',
                                'subject'  => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_BOOK_USER_SUBJECT'),
                                'message'  => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_BOOK_USER')));
            /*
             * Book with approval.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->emails_translation,
                          array('email_id' => $email_id,
                                'template' => 'book_with_approval_admin',
                                'subject'  => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_BOOK_WITH_APPROVAL_ADMIN_SUBJECT'),
                                'message'  => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_BOOK_WITH_APPROVAL_ADMIN')));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->emails_translation,
                          array('email_id' => $email_id,
                                'template' => 'book_with_approval_user',
                                'subject'  => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_BOOK_WITH_APPROVAL_USER_SUBJECT'),
                                'message'  => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_BOOK_WITH_APPROVAL_USER')));
            /*
             * Approved
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->emails_translation,
                          array('email_id' => $email_id,
                                'template' => 'approved',
                                'subject'  => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_APPROVED_SUBJECT'),
                                'message'  => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_APPROVED')));
            /*
             * Canceled
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->emails_translation,
                          array('email_id' => $email_id,
                                'template' => 'canceled',
                                'subject'  => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_CANCELED_SUBJECT'),
                                'message'  => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_CANCELED')));
            /*
             * Rejected
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->emails_translation,
                          array('email_id' => $email_id,
                                'template' => 'rejected',
                                'subject'  => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_REJECTED_SUBJECT'),
                                'message'  => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_REJECTED')));

            /*
             * Payment gateways.
             */
            $pg_list = $DOPBSP->classes->payment_gateways->get();

            for ($i = 0; $i<count($pg_list); $i++){
                $pg_id = $pg_list[$i];

                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->insert($DOPBSP->tables->emails_translation,
                              array('email_id' => $email_id,
                                    'template' => $pg_id.'_admin',
                                    'subject'  => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_'.strtoupper($pg_id).'_ADMIN_SUBJECT'),
                                    'message'  => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_'.strtoupper($pg_id).'_ADMIN')));
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->insert($DOPBSP->tables->emails_translation,
                              array('email_id' => $email_id,
                                    'template' => $pg_id.'_user',
                                    'subject'  => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_'.strtoupper($pg_id).'_USER_SUBJECT'),
                                    'message'  => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_'.strtoupper($pg_id).'_USER')));
            }

            $DOPBSP->classes->backend_emails->display();

            die();
        }

        /*
         * Prints out the email.
         *
         * @post id (integer): email ID
         * @post language (string): email current editing language
         * @param template (string): email template key
         *
         * @return email HTML
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

            $DOPBSP->views->backend_email->template(array('id'       => $id,
                                                          'language' => $language,
                                                          'template' => $template));

            die();
        }

        /*
         * Get email template and if it does not exist create a new one.
         *
         * @param id (integer): email ID
         * @param template (string): email template key
         *
         * @return email template
         */
        function get($id,
                     $template){
            global $wpdb;
            global $DOPBSP;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $template_data = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE email_id=%d AND template=%s',
                                                           $DOPBSP->tables->emails_translation,
                                                           $id,
                                                           $template));

            if ($template_data == ''){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->insert($DOPBSP->tables->emails_translation,
                              array('email_id' => $id,
                                    'template' => $template,
                                    'subject'  => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_'.strtoupper($template).'_SUBJECT'),
                                    'message'  => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_'.strtoupper($template))));
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $template_data = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE email_id=%d AND template=%s',
                                                               $DOPBSP->tables->emails_translation,
                                                               $id,
                                                               $template));
            }

            return $template_data;
        }

        /*
         * Edit email fields.
         *
         * @post id (integer): email ID
         * @post template (string): email template
         * @post field (string): email field
         * @post value (string): email new value
         * @post language (string): email selected language
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
            $value = $DOT->post('value',
                                'html');
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
                $email_translation = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE email_id=%d AND template=%s',
                                                                   $DOPBSP->tables->emails_translation,
                                                                   $id,
                                                                   $template));

                $translation = json_decode($email_translation->$field);
                $translation->$language = $value;
                $value = json_encode($translation);

                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->update($DOPBSP->tables->emails_translation,
                              array($field => $value),
                              array('email_id' => $id,
                                    'template' => $template));
            }
            else{
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->update($DOPBSP->tables->emails,
                              array($field => $value),
                              array('id' => $id));
            }

            die();
        }

        /*
         * Delete email.
         *
         * @post id (integer): email ID
         *
         * @return number of emails left
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
             * Delete email.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->emails,
                          array('id' => $id));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->emails_translation,
                          array('email_id' => $id));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id DESC',
                                              $DOPBSP->tables->emails));

            $DOT->echo($wpdb->num_rows,
                       'int');

            die();
        }

        /*
         * Default email template.
         *
         * @param key (string): translation key
         *
         * @return default email content
         */
        function defaultTemplate($key = ''){
            global $DOPBSP;

            return $DOPBSP->classes->translation->encodeJSON($key,
                                                             '',
                                                             '',
                                                             '<<new-line>><br /><br /><<new-line>>|DETAILS|<<new-line>><br /><br /><<new-line>>|EXTRAS|<<new-line>><br /><br /><<new-line>>|DISCOUNT|<<new-line>><br /><br /><<new-line>>|COUPON|<<new-line>><br /><br /><<new-line>>|FEES|<<new-line>><br /><br /><<new-line>>|FORM|<<new-line>><br /><br /><<new-line>>|BILLING ADDRESS|<<new-line>><br /><br /><<new-line>>|SHIPPING ADDRESS|');
        }
    }
}