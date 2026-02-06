<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.6
* File                    : includes/discounts/class-backend-discount-item.php
* File Version            : 1.0.5
* Created / Last Modified : 15 February 2016
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end discount item PHP class.
*/

if (!class_exists('DOPBSPBackEndDiscountItem')){
    class DOPBSPBackEndDiscountItem{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Add discount item.
         *
         * @post discount_id (integer): discount ID
         * @post position (integer): item position
         * @post language (string): current item language
         *
         * @return new item HTML
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

            $discount_id = $DOT->post('discount_id',
                                      'int');
            $position = $DOT->post('position',
                                   'int');
            $language = $DOT->post('language');

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->discounts_items,
                          array('discount_id' => $discount_id,
                                'position'    => $position,
                                'translation' => $DOPBSP->classes->translation->encodeJSON('DISCOUNTS_DISCOUNT_ADD_ITEM_LABEL')));
            $id = $wpdb->insert_id;
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $item = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE id=%d',
                                                  $DOPBSP->tables->discounts_items,
                                                  $id));

            $DOPBSP->views->backend_discount_item->template(array('item'     => $item,
                                                                  'language' => $language));

            die();
        }

        /*
         * Edit discount item.
         *
         * @post id (integer): discount item ID
         * @post field (string): discount item field
         * @post value (string): discount item value
         * @post language (string): discount selected language
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
            $field = $DOT->post('field');
            $value = $DOT->post('value');
            $language = $DOT->post('language');

            if ($field == 'label'){
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
                $item_data = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE id=%d',
                                                           $DOPBSP->tables->discounts_items,
                                                           $id));

                $translation = json_decode($item_data->translation);
                $translation->$language = $value;

                $value = wp_json_encode($translation);
                $field = 'translation';
            }

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->update($DOPBSP->tables->discounts_items,
                          array($field => $value),
                          array('id' => $id));

            die();
        }

        /*
         * Delete discount item.
         *
         * @post id (integer): discount item ID
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

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->discounts_items,
                          array('id' => $id));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->discounts_items_rules,
                          array('discount_item_id' => $id));

            die();
        }
    }
}