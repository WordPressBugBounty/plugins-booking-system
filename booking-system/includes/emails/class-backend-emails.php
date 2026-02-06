<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.2.4
* File                    : includes/emails/class-backend-emails.php
* File Version            : 1.0.7
* Created / Last Modified : 04 May 2016
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end emails PHP class.
*/

if (!class_exists('DOPBSPBackEndEmails')){
    class DOPBSPBackEndEmails{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Prints out the emails page.
         *
         * @return HTML page
         */
        function view(){
            global $DOPBSP;

            $DOPBSP->views->backend_emails->template();
        }

        /*
         * Display emails list.
         *
         * @return emails list HTML
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

            $html = array();
            $user_roles = array_values(wp_get_current_user()->roles);

            if ($user_roles[0] == 'administrator'){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $emails = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id DESC',
                                                            $DOPBSP->tables->emails));
            }
            else{
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $emails = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id DESC',
                                                            $DOPBSP->tables->emails,
                                                            wp_get_current_user()->ID));
            }

            /*
             * Create emails list HTML.
             */
            $html[] = '<ul>';

            if ($wpdb->num_rows != 0){
                if ($emails){
                    foreach ($emails as $email){
                        $email->name = esc_js($email->name);
                        $html[] = $this->listItem($email);
                    }
                }
            }
            else{
                $html[] = '<li class="dopbsp-no-data">'.$DOT->escape($DOPBSP->text('EMAILS_NO_EMAILS')).'</li>';
            }
            $html[] = '</ul>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->items());

            die();
        }

        /*
         * Returns emails list item HTML.
         *
         * @param email (object): email data
         *
         * @return email list item HTML
         */
        function listItem($email){
            global $DOPBSP;
            global $DOT;

            $html = array();
            $user = get_userdata($email->user_id); // Get data about the user who created the emails.

            $html[] = '<li class="dopbsp-item" id="'.$DOT->escape('DOPBSP-email-ID-'.$email->id,
                                                                  'attr').'" onclick="DOPBSPBackEndEmail.display('.$DOT->escape($email->id,
                                                                                                                                'attr').')">';
            $html[] = ' <div class="dopbsp-header">';

            /*
             * Display email ID.
             */
            $html[] = '     <span class="dopbsp-id">ID: '.$DOT->escape($email->id).'</span>';

            /*
             * Display data about the user who created the email.
             */
            if ($email->user_id>0){
                $html[] = '     <span class="dopbsp-header-item dopbsp-avatar">'.get_avatar($email->user_id,
                                                                                            17);
                $html[] = '         <span class="dopbsp-info">'.$DOT->escape($DOPBSP->text('EMAILS_CREATED_BY').': '.$user->data->display_name).'</span>';
                $html[] = '         <br class="dopbsp-clear" />';
                $html[] = '     </span>';
            }
            $html[] = '     <br class="dopbsp-clear" />';
            $html[] = ' </div>';
            $html[] = ' <div class="dopbsp-name">'.$DOT->escape($email->name == ''
                                                                        ? '&nbsp;'
                                                                        : $email->name).'</div>';
            $html[] = '</li>';

            return implode('',
                           $html);
        }
    }
}