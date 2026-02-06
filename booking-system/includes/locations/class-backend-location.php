<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : includes/locations/class-backend-location.php
* File Version            : 1.0.1
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end location PHP class.
*/

if (!class_exists('DOPBSPBackEndLocation')){
    class DOPBSPBackEndLocation{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Add a location.
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

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($DOPBSP->tables->locations,
                          array('user_id' => wp_get_current_user()->ID,
                                'name'    => $DOPBSP->text('LOCATIONS_ADD_LOCATION_NAME')));

            $DOPBSP->classes->backend_locations->display();

            die();
        }

        /*
         * Prints out the location.
         *
         * @post id (integer): location ID
         * @post language (string): location current editing language
         *
         * @return location HTML
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

            $id = $DOT->post('id',
                             'int');
            $language = $DOT->post('language');

            $DOPBSP->views->backend_location->template(array('id'       => $id,
                                                             'language' => $language));

            die();
        }

        /*
         * Edit location fields.
         *
         * @post id (integer): location ID
         * @post field (string): location field
         * @post value (string): location new value
         * @post coordinates (string): location coordinates
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
            $coordinates = $DOT->post('coordinates');

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->update($DOPBSP->tables->locations,
                          array($field => $value),
                          array('id' => $id));

            if ($field == 'address'){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->update($DOPBSP->tables->locations,
                              array('address_en' => $DOPBSP->classes->prototypes->getEnglishCharacters($value)),
                              array('id' => $id));
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->update($DOPBSP->tables->locations,
                              array('coordinates' => $coordinates),
                              array('id' => $id));
            }
            elseif ($field == 'address_alt'){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $wpdb->update($DOPBSP->tables->locations,
                              array('address_alt_en' => $DOPBSP->classes->prototypes->getEnglishCharacters($value)),
                              array('id' => $id));
            }

            if ($field == 'address'
                    || $field == 'calendars'){
                $this->setCoordinates($id);
            }

            die();
        }

        /*
         * Set coordinates from location in selected calendars.
         *
         * @param id (integer): location ID
         * @param clean (boolean): set to "true" clean coordinates from calendars
         */
        function setCoordinates($id,
                                $clean = false){
            global $wpdb;
            global $DOPBSP;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $location = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE id=%d',
                                                      $DOPBSP->tables->locations,
                                                      $id));

            if (isset($location->calendars)
                    && $location->calendars != ''){
                $calendars = explode(',',
                                     $location->calendars);

                foreach ($calendars as $calendar){
                    //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                    $wpdb->update($DOPBSP->tables->calendars,
                                  array('address'        => $clean
                                          ? ''
                                          : $location->address,
                                        'address_en'     => $clean
                                                ? ''
                                                : $location->address_en,
                                        'address_alt'    => $clean
                                                ? ''
                                                : $location->address_alt,
                                        'address_alt_en' => $clean
                                                ? ''
                                                : $location->address_alt_en,
                                        'coordinates'    => $clean
                                                ? ''
                                                : $location->coordinates),
                                  array('id' => $calendar));
                }
            }
        }

        /*
         * Delete location.
         *
         * @post id (integer): location ID
         *
         * @return number of locations left
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

            /*
             * Clean coordinates from calendars.
             */
            $this->setCoordinates($id,
                                  true);

            /*
             * Delete location.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->delete($DOPBSP->tables->locations,
                          array('id' => $id));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id DESC',
                                              $DOPBSP->tables->locations));

            $DOT->echo($wpdb->num_rows,
                       'int');

            die();
        }
    }
}