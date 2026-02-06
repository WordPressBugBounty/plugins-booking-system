<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : includes/tools/class-backend-tools-repair-search-settings.php
* File Version            : 1.0.1
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end repair search settings PHP class.
*/

if (!class_exists('DOPBSPBackEndToolsRepairSearchSettings')){
    class DOPBSPBackEndToolsRepairSearchSettings{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Display repair search settings.
         *
         * @return repair search settings HTML
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

            $DOPBSP->views->backend_tools_repair_search_settings->template();

            die();
        }

        /*
         * Get searches list.
         *
         * @return a string with all searches IDs
         */
        function get(){
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

            $searches_list = array();

            /*
             * Repair searches settings.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $searches = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id',
                                                          $DOPBSP->tables->searches));
            $searches_list[] = 0;

            foreach ($searches as $search){
                $searches_list[] = $search->id;
            }

            $DOT->echo(implode(',',
                               $searches_list));

            die();
        }

        /*
         * Repair settings for each search.
         *
         * @post id (integer): search ID
         * @post no (integer): search position
         *
         * @return status HTML
         */
        function set(){
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
                             'int')
                    ? $DOT->post('id',
                                 'int')
                    : 0;
            $no = $DOT->post('no',
                             'int')
                    ? $DOT->post('no',
                                 'int')
                    : 0;

            $html = array();

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $columns = $wpdb->get_results($wpdb->prepare('DESCRIBE %i',
                                                         $DOPBSP->tables->settings_search));

            $html[] = '<tr class="dopbsp-'.($no%2 == 0
                            ? 'odd'
                            : 'even').'">';

            if ($id != 0){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $search = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE id=%d',
                                                        $DOPBSP->tables->searches,
                                                        $id));

                $html[] = ' <td>ID: '.$id.' - '.$search->name.'</td>';
            }
            else{
                $html[] = ' <td>'.$DOPBSP->text('SETTINGS_GENERAL_TITLE').'</td>';
            }

            if (count($columns)>5){
                /*
                 * Update search settings.
                 */
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $settings_search = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE search_id=%d AND name=""',
                                                                 $DOPBSP->tables->settings_search,
                                                                 $id));
                $default_search = $DOPBSP->classes->backend_settings->default_search;

                foreach ($default_search as $key => $default){
                    //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                    $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE search_id=%d AND name=%s',
                                                  $DOPBSP->tables->settings_search,
                                                  $id,
                                                  $key));

                    if ($wpdb->num_rows == 0
                            && isset($settings_search->$key)
                            && $settings_search->$key != $default){
                        //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                        $wpdb->insert($DOPBSP->tables->settings_search,
                                      array('search_id' => $id,
                                            'name'      => $key,
                                            'value'     => $settings_search->$key));
                    }
                }

                $html[] = ' <td><span class="dopbsp-icon dopbsp-success"></span>'.$DOPBSP->text('TOOLS_REPAIR_SEARCH_SETTINGS_REPAIRED').'</td>';
            }
            else{
                $html[] = ' <td><span class="dopbsp-icon dopbsp-none"></span>'.$DOPBSP->text('TOOLS_REPAIR_SEARCH_SETTINGS_UNCHANGED').'</td>';
            }
            $html[] = '</tr>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       [
                               'span' => ['class' => []],
                               'td'   => [],
                               'tr'   => ['class' => []]
                       ]);

            die();
        }

        /*
         * Clean searches settings tables.
         */
        function clean(){
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

            /*
             * Delete columns.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $columns_search = $wpdb->get_results($wpdb->prepare('DESCRIBE %i',
                                                                $DOPBSP->tables->settings_search));

            if (count($columns_search)>5){
                foreach ($columns_search as $column){
                    if ($column->Field != 'id'
                            && $column->Field != 'search_id'
                            && $column->Field != 'name'
                            && $column->Field != 'value'){
                        //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                        $wpdb->query($wpdb->prepare('ALTER TABLE %i DROP COLUMN %i',
                                                    $DOPBSP->tables->settings_search,
                                                    $column->Field));
                    }
                }
            }

            /*
             * Delete old data.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->settings_search,
                          array('name' => ''));

            die();
        }
    }
}