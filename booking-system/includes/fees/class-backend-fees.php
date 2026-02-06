<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.2.4
* File                    : includes/fees/class-backend-fees.php
* File Version            : 1.0.7
* Created / Last Modified : 04 May 2016
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end fees PHP class.
*/

if (!class_exists('DOPBSPBackEndFees')){
    class DOPBSPBackEndFees{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Prints out the fees page.
         *
         * @return HTML page
         */
        function view(){
            global $DOPBSP;

            $DOPBSP->views->backend_fees->template();
        }

        /*
         * Display fees list.
         *
         * @return fees list HTML
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
                $fees = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id DESC',
                                                          $DOPBSP->tables->fees));
            }
            else{
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $fees = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id DESC',
                                                          $DOPBSP->tables->fees,
                                                          wp_get_current_user()->ID));
            }

            /*
             * Create fees list HTML.
             */
            $html[] = '<ul>';

            if ($wpdb->num_rows != 0){
                if ($fees){
                    foreach ($fees as $fee){
                        $html[] = $this->listItem($fee);
                    }
                }
            }
            else{
                $html[] = '<li class="dopbsp-no-data">'.$DOPBSP->text('FEES_NO_FEES').'</li>';
            }
            $html[] = '</ul>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->items());

            die();
        }

        /*
         * Returns fees list item HTML.
         *
         * @param fee (object): fee data
         *
         * @return fee list item HTML
         */
        function listItem($fee){
            global $DOPBSP;

            $html = array();
            $user = get_userdata($fee->user_id); // Get data about the user who created the fees.

            $html[] = '<li class="dopbsp-item" id="DOPBSP-fee-ID-'.$fee->id.'" onclick="DOPBSPBackEndFee.display('.$fee->id.')">';
            $html[] = ' <div class="dopbsp-header">';

            /*
             * Display fee ID.
             */
            $html[] = '     <span class="dopbsp-id">ID: '.$fee->id.'</span>';

            /*
             * Display data about the user who created the fee.
             */
            if ($fee->user_id>0){
                $html[] = '     <span class="dopbsp-header-item dopbsp-avatar">'.get_avatar($fee->user_id,
                                                                                            17);
                $html[] = '         <span class="dopbsp-info">'.$DOPBSP->text('FEES_CREATED_BY').': '.$user->data->display_name.'</span>';
                $html[] = '         <br class="dopbsp-clear" />';
                $html[] = '     </span>';
            }
            $html[] = '     <br class="dopbsp-clear" />';
            $html[] = ' </div>';
            $html[] = ' <div class="dopbsp-name">'.($fee->name == ''
                            ? '&nbsp;'
                            : $fee->name).'</div>';
            $html[] = '</li>';

            return implode('',
                           $html);
        }
    }
}