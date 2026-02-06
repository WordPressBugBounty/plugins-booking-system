<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.2.4
* File                    : includes/forms/class-backend-forms.php
* File Version            : 1.0.8
* Created / Last Modified : 04 May 2016
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end forms PHP class.
*/

if (!class_exists('DOPBSPBackEndForms')){
    class DOPBSPBackEndForms{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Prints out the forms page.
         *
         * @return HTML page
         */
        function view(){
            global $DOPBSP;

            $DOPBSP->views->backend_forms->template();
        }

        /*
         * Display forms list.
         *
         * @return forms list HTML
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
                $forms = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id DESC',
                                                           $DOPBSP->tables->forms));
            }
            else{
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $forms = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id DESC',
                                                           $DOPBSP->tables->forms,
                                                           wp_get_current_user()->ID));
            }

            /*
             * Create forms list HTML.
             */
            $html[] = '<ul>';

            if ($wpdb->num_rows != 0){
                if ($forms){
                    foreach ($forms as $form){
                        $html[] = $this->listItem($form);
                    }
                }
            }
            else{
                $html[] = '<li class="dopbsp-no-data">'.$DOPBSP->text('FORMS_NO_FORMS').'</li>';
            }
            $html[] = '</ul>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->items());

            die();
        }

        /*
         * Returns forms list item HTML.
         *
         * @param form (object): form data
         *
         * @return form list item HTML
         */
        function listItem($form){
            global $DOPBSP;

            $html = array();
            $user = get_userdata($form->user_id); // Get data about the user who created the form.

            $html[] = '<li class="dopbsp-item" id="DOPBSP-form-ID-'.$form->id.'" onclick="DOPBSPBackEndForm.display('.$form->id.')">';
            $html[] = ' <div class="dopbsp-header">';

            /*
             * Display form ID.
             */
            $html[] = '     <span class="dopbsp-id">ID: '.$form->id.'</span>';

            /*
             * Display data about the user who created the form.
             */
            if ($form->user_id>0){
                $html[] = '     <span class="dopbsp-header-item dopbsp-avatar">'.get_avatar($form->user_id,
                                                                                            17);
                $html[] = '         <span class="dopbsp-info">'.$DOPBSP->text('FORMS_CREATED_BY').': '.$user->data->display_name.'</span>';
                $html[] = '         <br class="dopbsp-clear" />';
                $html[] = '     </span>';
            }
            $html[] = '     <br class="dopbsp-clear" />';
            $html[] = ' </div>';
            $html[] = ' <div class="dopbsp-name">'.($form->name == ''
                            ? '&nbsp;'
                            : $form->name).'</div>';
            $html[] = '</li>';

            return implode('',
                           $html);
        }
    }
}