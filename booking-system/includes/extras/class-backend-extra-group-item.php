<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : includes/extras/class-backend-extra-group-item.php
* File Version            : 1.0.4
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end extra group item PHP class.
*/

if (!class_exists('DOPBSPBackEndExtraGroupItem')){
    class DOPBSPBackEndExtraGroupItem{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Add extra group item.
         *
         * @post group_id (integer): group ID
         * @post position (integer): group item position
         * @post language (string): current group item language
         *
         * @return new group HTML
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

            $group_id = $DOT->post('group_id',
                                   'int');
            $position = $DOT->post('position',
                                   'int');
            $language = $DOT->post('language');

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->extras_groups_items,
                          array('group_id'    => $group_id,
                                'position'    => $position,
                                'translation' => $DOPBSP->classes->translation->encodeJSON('EXTRAS_EXTRA_GROUP_ADD_ITEM_LABEL')));
            $id = $wpdb->insert_id;
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $item = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE id=%d',
                                                  $DOPBSP->tables->extras_groups_items,
                                                  $id));

            $DOPBSP->views->backend_extra_group_item->template(array('item'     => $item,
                                                                     'language' => $language));

            die();
        }

        /*
         * Edit extra group item.
         *
         * @post id (integer): group item ID
         * @post field (string): group item field
         * @post value (string): group item value
         * @post language (string): extra selected language
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
                $group_data = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE id=%d',
                                                            $DOPBSP->tables->extras_groups_items,
                                                            $id));

                $translation = json_decode($group_data->translation);
                $translation->$language = $value;

                $value = json_encode($translation);
                $field = 'translation';
            }

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->update($DOPBSP->tables->extras_groups_items,
                          array($field => $value),
                          array('id' => $id));

            die();
        }

        /*
         * Delete extra group item.
         *
         * @post id (integer): group item ID
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
            $wpdb->delete($DOPBSP->tables->extras_groups_items,
                          array('id' => $id));

            die();
        }
    }
}