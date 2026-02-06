<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.2
* File                    : includes/locations/class-backend-locations.php
* File Version            : 1.0.4
* Created / Last Modified : 11 October 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end locations PHP class.
*/

if (!class_exists('DOPBSPBackEndLocations')){
    class DOPBSPBackEndLocations{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Prints out the locations page.
         *
         * @return HTML page
         */
        function view(){
            global $DOPBSP;

            $DOPBSP->views->backend_locations->template();
        }

        /*
         * Display locations list.
         *
         * @return locations list HTML
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
            $locations = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id DESC',
                                                           $DOPBSP->tables->locations,
                                                           wp_get_current_user()->ID));

            /*
             * Create locations list HTML.
             */
            $html[] = '<ul>';

            if ($wpdb->num_rows != 0){
                if ($locations){
                    foreach ($locations as $location){
                        $html[] = $this->listItem($location);
                    }
                }
            }
            else{
                $html[] = '<li class="dopbsp-no-data">'.$DOPBSP->text('LOCATIONS_NO_LOCATIONS').'</li>';
            }
            $html[] = '</ul>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->items());

            die();
        }

        /*
         * Returns locations list item HTML.
         *
         * @param location (object): location data
         *
         * @return location list item HTML
         */
        function listItem($location){
            global $DOPBSP;

            $html = array();
            $user = get_userdata($location->user_id); // Get data about the user who created the locations.

            $html[] = '<li class="dopbsp-item" id="DOPBSP-location-ID-'.$location->id.'" onclick="DOPBSPBackEndLocation.display('.$location->id.')">';
            $html[] = ' <div class="dopbsp-header">';

            /*
             * Display location ID.
             */
            $html[] = '     <span class="dopbsp-id">ID: '.$location->id.'</span>';

            /*
             * Display data about the user who created the location.
             */
            if ($location->user_id>0){
                $html[] = '     <span class="dopbsp-header-item dopbsp-avatar">'.get_avatar($location->user_id,
                                                                                            17);
                $html[] = '         <span class="dopbsp-info">'.$DOPBSP->text('LOCATIONS_CREATED_BY').': '.$user->data->display_name.'</span>';
                $html[] = '         <br class="dopbsp-clear" />';
                $html[] = '     </span>';
            }
            $html[] = '     <br class="dopbsp-clear" />';
            $html[] = ' </div>';
            $html[] = ' <div class="dopbsp-name">'.($location->name == ''
                            ? '&nbsp;'
                            : $location->name).'</div>';
            $html[] = '</li>';

            return implode('',
                           $html);
        }
    }
}