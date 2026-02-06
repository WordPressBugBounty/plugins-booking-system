<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.2
* File                    : includes/searches/class-backend-searches.php
* File Version            : 1.0.4
* Created / Last Modified : 11 October 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end searches PHP class.
*/

if (!class_exists('DOPBSPBackEndSearches')){
    class DOPBSPBackEndSearches{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Prints out the searches page.
         *
         * @return HTML page
         */
        function view(){
            global $DOPBSP;

            $DOPBSP->views->backend_searches->template();
        }

        /*
         * Display searches list.
         *
         * @return searches list HTML
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

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $searches = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id DESC',
                                                          $DOPBSP->tables->searches,
                                                          wp_get_current_user()->ID));

            /*
             * Create searches list HTML.
             */
            $html[] = '<ul>';

            if ($wpdb->num_rows != 0){
                if ($searches){
                    foreach ($searches as $search){
                        $html[] = $this->listItem($search);
                    }
                }
            }
            else{
                $html[] = '<li class="dopbsp-no-data">'.$DOPBSP->text('SEARCHES_NO_SEARCHES').'</li>';
            }
            $html[] = '</ul>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->items());

            die();
        }

        /*
         * Returns searches list item HTML.
         *
         * @param search (object): search data
         *
         * @return search list item HTML
         */
        function listItem($search){
            global $DOPBSP;

            $html = array();
            $user = get_userdata($search->user_id); // Get data about the user who created the searches.

            $html[] = '<li class="dopbsp-item" id="DOPBSP-search-ID-'.$search->id.'" onclick="DOPBSPBackEndSearch.display('.$search->id.')">';
            $html[] = ' <div class="dopbsp-header">';

            /*
             * Display search ID.
             */
            $html[] = '     <span class="dopbsp-id">ID: '.$search->id.'</span>';

            /*
             * Display data about the user who created the search.
             */
            if ($search->user_id>0){
                $html[] = '     <span class="dopbsp-header-item dopbsp-avatar">'.get_avatar($search->user_id,
                                                                                            17);
                $html[] = '         <span class="dopbsp-info">'.$DOPBSP->text('SEARCHES_CREATED_BY').': '.$user->data->display_name.'</span>';
                $html[] = '         <br class="dopbsp-clear" />';
                $html[] = '     </span>';
            }
            $html[] = '     <br class="dopbsp-clear" />';
            $html[] = ' </div>';
            $html[] = ' <div class="dopbsp-name">'.($search->name == ''
                            ? '&nbsp;'
                            : $search->name).'</div>';
            $html[] = '</li>';

            return implode('',
                           $html);
        }
    }
}