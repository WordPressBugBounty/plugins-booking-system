<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.2.4
* File                    : includes/coupons/class-backend-coupons.php
* File Version            : 1.0.7
* Created / Last Modified : 04 May 2016
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end coupons PHP class.
*/

if (!class_exists('DOPBSPBackEndCoupons')){
    class DOPBSPBackEndCoupons{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Prints out the coupons page.
         *
         * @return HTML page
         */
        function view(){
            global $DOPBSP;

            $DOPBSP->views->backend_coupons->template();
        }

        /*
         * Display coupons list.
         *
         * @return coupons list HTML
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
                $coupons = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id DESC',
                                                             $DOPBSP->tables->coupons));
            }
            else{
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $coupons = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id DESC',
                                                             $DOPBSP->tables->coupons,
                                                             wp_get_current_user()->ID));
            }

            /*
             * Create coupons list HTML.
             */
            $html[] = '<ul>';

            if ($wpdb->num_rows != 0){
                if ($coupons){
                    foreach ($coupons as $coupon){
                        $html[] = $this->listItem($coupon);
                    }
                }
            }
            else{
                $html[] = '<li class="dopbsp-no-data">'.$DOT->escape($DOPBSP->text('COUPONS_NO_COUPONS')).'</li>';
            }
            $html[] = '</ul>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->items());

            die();
        }

        /*
         * Returns coupons list item HTML.
         *
         * @param coupon (object): coupon data
         *
         * @return coupon list item HTML
         */
        function listItem($coupon){
            global $DOPBSP;
            global $DOT;

            $html = array();
            $user = get_userdata($coupon->user_id); // Get data about the user who created the coupons.

            $html[] = '<li class="dopbsp-item" id="'.$DOT->escape('DOPBSP-coupon-ID-'.$coupon->id,
                                                                  'attr').'" onclick="DOPBSPBackEndCoupon.display('.$DOT->escape($coupon->id,
                                                                                                                                 'attr').')">';
            $html[] = ' <div class="dopbsp-header">';

            /*
             * Display coupon ID.
             */
            $html[] = '     <span class="dopbsp-id">ID: '.$DOT->escape($coupon->id).'</span>';

            /*
             * Display data about the user who created the coupon.
             */
            if ($coupon->user_id>0){
                $html[] = '     <span class="dopbsp-header-item dopbsp-avatar">'.get_avatar($coupon->user_id,
                                                                                            17);
                $html[] = '         <span class="dopbsp-info">'.$DOT->escape($DOPBSP->text('COUPONS_CREATED_BY').': '.$user->data->display_name).'</span>';
                $html[] = '         <br class="dopbsp-clear" />';
                $html[] = '     </span>';
            }
            $html[] = '     <br class="dopbsp-clear" />';
            $html[] = ' </div>';
            $html[] = ' <div class="dopbsp-name">'.$DOT->escape($coupon->name == ''
                                                                        ? '&nbsp;'
                                                                        : $coupon->name).'</div>';
            $html[] = '</li>';

            return implode('',
                           $html);
        }
    }
}