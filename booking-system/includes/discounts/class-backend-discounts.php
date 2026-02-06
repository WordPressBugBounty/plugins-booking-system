<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.2.4
* File                    : includes/discounts/class-backend-discounts.php
* File Version            : 1.0.7
* Created / Last Modified : 04 May 2016
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end discounts PHP class.
*/

if (!class_exists('DOPBSPBackEndDiscounts')){
    class DOPBSPBackEndDiscounts{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Prints out the discounts page.
         *
         * @return HTML page
         */
        function view(){
            global $DOPBSP;

            $DOPBSP->views->backend_discounts->template();
        }

        /*
         * Display discounts list.
         *
         * @return discounts list HTML
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
                $discounts = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id DESC',
                                                               $DOPBSP->tables->discounts));
            }
            else{
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $discounts = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id DESC',
                                                               $DOPBSP->tables->discounts,
                                                               wp_get_current_user()->ID));
            }

            /*
             * Create discounts list HTML.
             */
            $html[] = '<ul>';

            if ($wpdb->num_rows != 0){
                if ($discounts){
                    foreach ($discounts as $discount){
                        $html[] = $this->listItem($discount);
                    }
                }
            }
            else{
                $html[] = '<li class="dopbsp-no-data">'.$DOT->escape($DOPBSP->text('DISCOUNTS_NO_DISCOUNTS')).'</li>';
            }
            $html[] = '</ul>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->items());

            die();
        }

        /*
         * Returns discounts list item HTML.
         *
         * @param discount (object): discount data
         *
         * @return discount list rule HTML
         */
        function listItem($discount){
            global $DOPBSP;
            global $DOT;

            $html = array();
            $user = get_userdata($discount->user_id); // Get data about the user who created the discounts.

            $html[] = '<li class="dopbsp-item" id="'.$DOT->escape('DOPBSP-discount-ID-'.$discount->id,
                                                                  'attr').'" onclick="DOPBSPBackEndDiscount.display('.$DOT->escape($discount->id,
                                                                                                                                   'attr').')">';
            $html[] = ' <div class="dopbsp-header">';

            /*
             * Display discount ID.
             */
            $html[] = '     <span class="dopbsp-id">ID: '.$DOT->escape($discount->id).'</span>';

            /*
             * Display data about the user who created the discount.
             */
            if ($discount->user_id>0){
                $html[] = '     <span class="dopbsp-header-item dopbsp-avatar">'.get_avatar($discount->user_id,
                                                                                            17);
                $html[] = '         <span class="dopbsp-info">'.$DOT->escape($DOPBSP->text('DISCOUNTS_CREATED_BY').': '.$user->data->display_name).'</span>';
                $html[] = '         <br class="dopbsp-clear" />';
                $html[] = '     </span>';
            }
            $html[] = '     <br class="dopbsp-clear" />';
            $html[] = ' </div>';
            $html[] = ' <div class="dopbsp-name">'.$DOT->escape($discount->name == ''
                                                                        ? '&nbsp;'
                                                                        : $discount->name).'</div>';
            $html[] = '</li>';

            return implode('',
                           $html);
        }
    }
}