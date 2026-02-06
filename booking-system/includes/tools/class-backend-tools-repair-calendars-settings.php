<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : includes/tools/class-backend-tools-repair-calendars-settings.php
* File Version            : 1.0.5
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end repair calendars settings PHP class.
*/

if (!class_exists('DOPBSPBackEndToolsRepairCalendarsSettings')){
    class DOPBSPBackEndToolsRepairCalendarsSettings{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Display repair calendars settings.
         *
         * @return repair calendars settings HTML
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

            $DOPBSP->views->backend_tools_repair_calendars_settings->template();

            die();
        }

        /*
         * Get calendars list.
         *
         * @return a string with all calendars IDs
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

            /*
             * Rename calendar settings table.
             */
            $DOPBSP->classes->database->updateRename();

            $calendars_list = array();

            /*
             * Repair calendars settings.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $calendars = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id',$DOPBSP->tables->calendars));
            $calendars_list[] = 0;

            foreach ($calendars as $calendar){
                $calendars_list[] = $calendar->id;
            }

            $DOT->echo(implode(',',
                               $calendars_list));

            die();
        }

        /*
         * Repair settings for each calendar.
         *
         * @post id (integer): calendar ID
         * @post no (integer): calendar position
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
                                                         $DOPBSP->tables->settings_calendar));

            $html[] = '<tr class="dopbsp-'.($no%2 == 0
                            ? 'odd'
                            : 'even').'">';

            if ($id != 0){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $calendar = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE id=%d',
                                                          $DOPBSP->tables->calendars,
                                                          $id));

                $html[] = ' <td>ID: '.$id.' - '.$calendar->name.'</td>';
            }
            else{
                $html[] = ' <td>'.$DOPBSP->text('SETTINGS_GENERAL_TITLE').'</td>';
            }

            if (count($columns)>5){
                /*
                 * Update calendar settings.
                 */
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $settings_calendar = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE calendar_id=%d AND name=""',
                                                                   $DOPBSP->tables->settings_calendar,
                                                                   $id));
                $default_calendar = $DOPBSP->classes->backend_settings->default_calendar;

                foreach ($default_calendar as $key => $default){
                    //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                    $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE calendar_id=%d AND name=%s',
                                                  $DOPBSP->tables->settings_calendar,
                                                  $id,
                                                  $key));

                    if ($wpdb->num_rows == 0
                            && isset($settings_calendar->$key)
                            && $settings_calendar->$key != $default){
                        //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                        $wpdb->insert($DOPBSP->tables->settings_calendar,
                                      array('calendar_id' => $id,
                                            'name'        => $key,
                                            'value'       => $settings_calendar->$key));
                    }
                }

                /*
                 * Update notifications settings.
                 */
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $settings_notifications = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE calendar_id=%d AND name=""',
                                                                        $DOPBSP->tables->settings_notifications,
                                                                        $id));
                $default_notifications = $DOPBSP->classes->backend_settings->default_notifications;

                foreach ($default_notifications as $key => $default){
                    //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                    $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE calendar_id=%d AND name=%s',
                                                  $DOPBSP->tables->settings_notifications,
                                                  $id,
                                                  $key));

                    if ($wpdb->num_rows == 0
                            && isset($settings_notifications->$key)
                            && $settings_notifications->$key != $default){
                        //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                        $wpdb->insert($DOPBSP->tables->settings_notifications,
                                      array('calendar_id' => $id,
                                            'name'        => $key,
                                            'value'       => $settings_calendar->$key));
                    }
                }

                /*
                 * Update payment settings.
                 */
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $settings_payment = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE calendar_id=%d AND name=""',
                                                                  $DOPBSP->tables->settings_payment,
                                                                  $id));
                $default_payment = $DOPBSP->classes->backend_settings->default_payment;

                foreach ($default_payment as $key => $default){
                    //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                    $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE calendar_id=%d AND name=%s',
                                                  $DOPBSP->tables->settings_payment,
                                                  $id,
                                                  $key));

                    if ($wpdb->num_rows == 0
                            && isset($settings_payment->$key)
                            && $settings_payment->$key != $default){
                        //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                        $wpdb->insert($DOPBSP->tables->settings_payment,
                                      array('calendar_id' => $id,
                                            'name'        => $key,
                                            'value'       => $settings_calendar->$key));
                    }
                }

                $html[] = ' <td><span class="dopbsp-icon dopbsp-success"></span>'.$DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_REPAIRED').'</td>';
                $html[] = ' <td><span class="dopbsp-icon dopbsp-success"></span>'.$DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_REPAIRED').'</td>';
                $html[] = ' <td><span class="dopbsp-icon dopbsp-success"></span>'.$DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_REPAIRED').'</td>';
            }
            else{
                $html[] = ' <td><span class="dopbsp-icon dopbsp-none"></span>'.$DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_UNCHANGED').'</td>';
                $html[] = ' <td><span class="dopbsp-icon dopbsp-none"></span>'.$DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_UNCHANGED').'</td>';
                $html[] = ' <td><span class="dopbsp-icon dopbsp-none"></span>'.$DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_UNCHANGED').'</td>';
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
         * Clean calendars settings tables.
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
            $columns_calendar = $wpdb->get_results($wpdb->prepare('DESCRIBE %i',$DOPBSP->tables->settings_calendar));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $columns_notifications = $wpdb->get_results($wpdb->prepare('DESCRIBE %i',$DOPBSP->tables->settings_notifications));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $columns_payment = $wpdb->get_results($wpdb->prepare('DESCRIBE %i',$DOPBSP->tables->settings_payment));

            if (count($columns_calendar)>5){
                foreach ($columns_calendar as $column){
                    if ($column->Field != 'id'
                            && $column->Field != 'calendar_id'
                            && $column->Field != 'name'
                            && $column->Field != 'value'){
                        //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                        $wpdb->query($wpdb->prepare('ALTER TABLE %i DROP COLUMN %i',
                                                    $DOPBSP->tables->settings_calendar,
                                                    $column->Field));
                    }
                }
            }

            if (count($columns_notifications)>5){
                foreach ($columns_notifications as $column){
                    if ($column->Field != 'id'
                            && $column->Field != 'calendar_id'
                            && $column->Field != 'name'
                            && $column->Field != 'value'){
                        //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                        $wpdb->query($wpdb->prepare('ALTER TABLE %i DROP COLUMN %i',
                                                    $DOPBSP->tables->settings_notifications,
                                                    $column->Field));
                    }
                }
            }

            if (count($columns_payment)>5){
                foreach ($columns_payment as $column){
                    if ($column->Field != 'id'
                            && $column->Field != 'calendar_id'
                            && $column->Field != 'name'
                            && $column->Field != 'value'){
                        //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                        $wpdb->query($wpdb->prepare('ALTER TABLE %i DROP COLUMN %i',
                                                    $DOPBSP->tables->settings_payment,
                                                    $column->Field));
                    }
                }
            }

            /*
             * Delete old data.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->settings_calendar,
                          array('name' => ''));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->settings_notifications,
                          array('name' => ''));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->settings_payment,
                          array('name' => ''));

            die();
        }
    }
}