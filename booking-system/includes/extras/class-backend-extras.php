<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.2.4
* File                    : includes/extras/class-backend-extras.php
* File Version            : 1.0.7
* Created / Last Modified : 04 May 2016
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end extras PHP class.
*/

if (!class_exists('DOPBSPBackEndExtras')){
    class DOPBSPBackEndExtras{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Prints out the extras page.
         *
         * @return HTML page
         */
        function view(){
            global $DOPBSP;

            $DOPBSP->views->backend_extras->template();
        }

        /*
         * Display extras list.
         *
         * @return extras list HTML
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
                $extras = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id DESC',
                                                            $DOPBSP->tables->extras));
            }
            else{
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $extras = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id DESC',
                                                            $DOPBSP->tables->extras,
                                                            wp_get_current_user()->ID));
            }

            /*
             * Create extras list HTML.
             */
            $html[] = '<ul>';

            if ($wpdb->num_rows != 0){
                if ($extras){
                    foreach ($extras as $extra){
                        $html[] = $this->listItem($extra);
                    }
                }
            }
            else{
                $html[] = '<li class="dopbsp-no-data">'.$DOPBSP->text('EXTRAS_NO_EXTRAS').'</li>';
            }
            $html[] = '</ul>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->items());

            die();
        }

        /*
         * Returns extras list item HTML.
         *
         * @param extra (object): extra data
         *
         * @return extra list item HTML
         */
        function listItem($extra){
            global $DOPBSP;

            $html = array();
            $user = get_userdata($extra->user_id); // Get data about the user who created the extras.

            $html[] = '<li class="dopbsp-item" id="DOPBSP-extra-ID-'.$extra->id.'" onclick="DOPBSPBackEndExtra.display('.$extra->id.')">';
            $html[] = ' <div class="dopbsp-header">';

            /*
             * Display extra ID.
             */
            $html[] = '     <span class="dopbsp-id">ID: '.$extra->id.'</span>';

            /*
             * Display data about the user who created the extra.
             */
            if ($extra->user_id>0){
                $html[] = '     <span class="dopbsp-header-item dopbsp-avatar">'.get_avatar($extra->user_id,
                                                                                            17);
                $html[] = '         <span class="dopbsp-info">'.$DOPBSP->text('EXTRAS_CREATED_BY').': '.$user->data->display_name.'</span>';
                $html[] = '         <br class="dopbsp-clear" />';
                $html[] = '     </span>';
            }
            $html[] = '     <br class="dopbsp-clear" />';
            $html[] = ' </div>';
            $html[] = ' <div class="dopbsp-name">'.($extra->name == ''
                            ? '&nbsp;'
                            : $extra->name).'</div>';
            $html[] = '</li>';

            return implode('',
                           $html);
        }
    }
}