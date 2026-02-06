<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : includes/extras/class-backend-extra-group-items.php
* File Version            : 1.0.1
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end extra group items PHP class.
*/

if (!class_exists('DOPBSPBackEndExtraGroupItems')){
    class DOPBSPBackEndExtraGroupItems{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Sort extra group items.
         *
         * @post ids (string): list of items ids in new order
         */
        function sort(){
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

            $ids = explode(',',
                           $DOT->post('ids'));
            $i = 0;

            foreach ($ids as $id){
                $i++;
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->update($DOPBSP->tables->extras_groups_items,
                              array('position' => $i),
                              array('id' => $id));
            }

            die();
        }
    }
}