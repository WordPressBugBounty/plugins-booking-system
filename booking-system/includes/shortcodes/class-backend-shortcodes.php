<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : includes/class-backend-shortcodes.php
* File Version            : 1.0.3
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end shortcodes PHP class.
*/

if (!class_exists('DOPBSPBackEndShortcodes')){
    class DOPBSPBackEndShortcodes{
        /*
         * Constructor
         */
        function __construct(){
            add_action('init',
                       array(&$this,
                             'initShortcodes'));
        }

        /*
         * Initialize shortcodes in TinyMCE editor.
         */
        function initShortcodes(){
            if (!current_user_can('edit_posts')
                    && !current_user_can('edit_pages')){
                return;
            }

            if (get_user_option('rich_editing') == 'true'){
                add_action('admin_head',
                           array(&$this,
                                 'setData'));
                add_filter('mce_external_plugins',
                           array(&$this,
                                 'initTinyMCEPlugin'),
                           5);
                add_filter('mce_buttons',
                           array(&$this,
                                 'setTinyMCEButton'),
                           5);
            }
        }

        /*
         * Set data for shortcodes in TinyMCE editor.
         *
         * @return HTML data
         */
        function setData(){
            global $wpdb;
            global $DOPBSP;
            global $DOT;

            $calendars_list = array();
            $searches_list = array();
            $languages_list = array();

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $calendars = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d ORDER BY id',
                                                           $DOPBSP->tables->calendars,
                                                           wp_get_current_user()->ID));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $searches = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id',
                                                          $DOPBSP->tables->searches));
            $selected_language = '';
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $enabled_languages = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE enabled="true"',
                                                                   $DOPBSP->tables->languages));

            foreach ($calendars as $calendar){
                $calendars_list[] = $calendar->id.';;'.$calendar->name;
            }

            foreach ($searches as $search){
                $searches_list[] = $search->id.';;'.$search->name;
            }

            foreach ($enabled_languages as $enabled_language){
                $languages_list[] = $enabled_language->code.';;'.$enabled_language->name;
            }

            $dopbsp_path = plugin_dir_url(__FILE__);
            $dopbsp_path = str_replace('includes/shortcodes/',
                                       '',
                                       $dopbsp_path);

            $DOT->echo('<script>'.
                       '    let DOPBSP_tinyMCE_data = "'.$DOPBSP->text('TINYMCE_ADD').';;;;;'.implode(';;;',
                                                                                                      $calendars_list).';;;;;'.$DOPBSP->text('TINYMCE_CALENDAR').';;;;;'.$DOPBSP->text('TINYMCE_SELECT_CALENDAR').';;;;;'.$DOPBSP->text('TINYMCE_LANGUAGE').';;;;;'.$DOPBSP->text('TINYMCE_SELECT_LANGUAGE').';;;;;'.implode(';;;',
                                                                                                                                                                                                                                                                                                                             $languages_list).';;;;;'.implode(';;;',
                                                                                                                                                                                                                                                                                                                                                              $searches_list).'",'.
                       '        DOPBSP_PATH = "'.$dopbsp_path.'",'.
                       '        DOPBSP_language = "'.$selected_language.'",'.
                       '        WP_version = "'.get_bloginfo("version").'";'.
                       '</script>',
                       'content',
                       ['script' => []]);
        }

        /*
         * Initialize TinyMCE editor plugin.
         *
         * @param plugin_array (array): list of plugins for TinyMCE editor
         *
         * @return modified TinyMCE editor plugins list
         */
        function initTinyMCEPlugin($plugin_array){
            global $DOPBSP;

            $plugin_array['DOPBSP'] = $DOPBSP->paths->url.'assets/js/shortcodes/backend-shortcodes.js';

            return $plugin_array;
        }

        /*
         * Set button for TinyMCE editor.
         *
         * @param buttons (array): list of TinyMCE editor buttons
         *
         * @return modified TinyMCE editor buttons list
         */
        function setTinyMCEButton($buttons){
            array_push($buttons,
                       '',
                       'DOPBSP');

            return $buttons;
        }
    }
}