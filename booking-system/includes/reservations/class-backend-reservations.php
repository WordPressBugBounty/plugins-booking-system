<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.6.7
* File                    : includes/reservations/class-backend-reservations.php
* File Version            : 1.0.6
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end reservations PHP class.
*/

if (!class_exists('DOPBSPBackEndReservations')){
    class DOPBSPBackEndReservations{
        /*
         * Constructor.
         */
        function __construct(){
        }

        /*
         * Prints out the reservations page.
         *
         * @return HTML page
         */
        function view(){
            global $DOPBSP;

            /*
             * Check if reservations have expired each time you open the reservations page.
             */
            $this->clean();

            /*
             * Display reservations template.
             */
            $DOPBSP->views->backend_reservations->template();
        }

        /*
         * Search & display reservations list.
         *
         *
         * @post type (string): type ( csv/json )
         * @post key (string): API key
         * @post calendar_id (string/integer): list of calendars or calendar
         * @post start_date (string): reservations start date
         * @post end_date (string): reservations end date
         * @post start_hour (string): reservations start hour
         * @post end_hour (string): reservations end hour
         * @post status_pending (boolean): display reservations with status pending
         * @post status_approved (boolean): display reservations with status approved
         * @post status_rejected (boolean): display reservations with status rejected
         * @post status_canceled (boolean): display reservations with status canceled
         * @post status_expired (boolean): display reservations with status expired
         * @post payment_methods (string): list of payment methods
         * @post search (string): search text
         * @post page (integer): page number to be displayed
         * @post per_page (integer): number of reservation displayed per page
         * @post order (string): order direction "ASC", "DESC"
         * @post order_by (string): order by "check_in", "check_out", "start_hour", "end_hour", "id", "status", "date_created"
         *
         * @get dopbsp_api (boolean): will initialize API calls if it is enabled
         * @get calendar_id (string/integer): list of calendars or calendar
         * @get start_date (string): reservations start date
         * @get end_date (string): reservations end date
         * @get start_hour (string): reservations start hour
         * @get end_hour (string): reservations end hour
         * @get status (boolean): display reservations with selected status
         * @get payment_methods (string): list of payment methods
         * @get search (string): search text
         * @get page (integer): page number to be displayed
         * @get per_page (integer): number of reservation displayed per page
         * @get order (string): order direction "ASC", "DESC"
         * @get order_by (string): order by "check_in", "check_out", "start_hour", "end_hour", "id", "status", "date_created"
         *
         * @return reservations list
         */
        function get(){
            global $wpdb;
            global $DOPBSP;
            global $DOT;

            $api = $DOT->get('dopbsp_api') == 'true';

            /*
             * Verify nonce.
             */
            $nonce = $DOT->post('nonce');

            if (!wp_verify_nonce($nonce,
                                 'dopbsp_user_nonce')
                    && !$api){
                return false;
            }
            /*
             * End verify nonce.
             */

            $query = array();
            $values = array();
            $export_date = gmdate("Y/m/d");

            if (!$api){
                $type = $DOT->post('type');
                $calendar_id = $DOT->post('calendar_id');
                $start_date = $DOT->post('start_date');
                $end_date = $DOT->post('end_date');
                $start_hour = $DOT->post('start_hour');
                $end_hour = $DOT->post('end_hour');
                $status_pending = $DOT->post('status_pending') == 'true';
                $status_approved = $DOT->post('status_approved') == 'true';
                $status_rejected = $DOT->post('status_rejected') == 'true';
                $status_canceled = $DOT->post('status_canceled') == 'true';
                $status_expired = $DOT->post('status_expired') == 'true';
                $payment_methods = $DOT->post('payment_methods') == ''
                        ? array()
                        : explode(',',
                                  $DOT->post('payment_methods'));
                $search = $DOT->post('search');
                $page = $DOT->post('page',
                                   'int');
                $per_page = $DOT->post('per_page',
                                       'int');
                $order = $DOT->post('order');
                $order_by = $DOT->post('order_by');
            }
            else{
                $type = $DOT->get('type')
                        ? $DOT->get('type')
                        : '';

                if ($DOT->get('calendar_id') !== false
                        || $DOT->get('calendar_id') != ''){
                    $calendars_requested = ','.$DOT->get('calendar_id').',';
                }
                else{
                    $calendars_requested = '';
                }

                if ($type != 'ics'){
                    $calendars_id = array();
                    $key_pieces = explode('-',
                                          $DOT->post('key'));
                    $calendars = $DOPBSP->classes->backend_calendars->get(array('user_id' => (int)$key_pieces[1]));

                    foreach ($calendars as $calendar){
                        if ($calendars_requested != ''){
                            if (str_contains($calendars_requested,
                                             ','.$calendar->id.',')){
                                $calendars_id[] = $calendar->id;
                            }
                        }
                        else{
                            $calendars_id[] = $calendar->id;
                        }
                    }

                    $calendar_id = implode(',',
                                           $calendars_id);
                }
                else{
                    $calendar_id = $DOT->get('calendar_id',
                                             'int');
                }
                $start_date = $DOT->get('start_date')
                        ? $DOT->get('start_date')
                        : '';
                $end_date = $DOT->get('end_date')
                        ? $DOT->get('end_date')
                        : '';
                $start_hour = $DOT->get('start_hour')
                        ? $DOT->get('start_hour')
                        : '00:00';
                $end_hour = $DOT->get('end_hour')
                        ? $DOT->get('end_hour')
                        : '24:00';
                $status = $DOT->get('status')
                        ? $DOT->get('status')
                        : '';
                $status_pending = str_contains($status,
                                               'pending');
                $status_approved = str_contains($status,
                                                'approved');
                $status_rejected = str_contains($status,
                                                'rejected');
                $status_canceled = str_contains($status,
                                                'canceled');
                $status_expired = str_contains($status,
                                               'expired');
                $payment_methods = $DOT->get('payment_methods') != ''
                        ? explode(',',
                                  $DOT->get('payment_methods'))
                        : array();
                $search = $DOT->get('search')
                        ? $DOT->get('search')
                        : '';
                $page = $DOT->get('page')
                        ? $DOT->get('page')
                        : '1';
                $per_page = $DOT->get('per_page')
                        ? $DOT->get('per_page')
                        : '10';
                $order = $DOT->get('order')
                        ? $DOT->get('order')
                        : 'ASC';
                $order_by = $DOT->get('order_by')
                        ? $DOT->get('order_by')
                        : 'check_in';

                if (strtolower($type) == 'ics'){
                    $per_page = 1000000;
                }
            }

            /*
             * Calendars query.
             */
            if (str_contains($calendar_id,
                             ',')){
                $calendars_ids = explode(',',
                                         $calendar_id);
                $query[] = 'SELECT * FROM %i WHERE (calendar_id=%d';
                $values[] = $DOPBSP->tables->reservations;
                $values[] = $calendars_ids[0];

                for ($i = 1; $i<count($calendars_ids); $i++){
                    $query[] = ' OR calendar_id=%d';
                    $values[] = $calendars_ids[$i];
                }
                $query[] = ')';
            }
            else{
                $query[] = 'SELECT * FROM %i WHERE calendar_id=%d';
                $values[] = $DOPBSP->tables->reservations;
                $values[] = $calendar_id;
            }

            /*
             * Days query.
             */
            if ($start_date != ''){
                if ($end_date != ''){
                    $query[] = ' AND (check_in >= %s AND check_in <= %s';
                    $values[] = $start_date;
                    $values[] = $end_date;

                    $query[] = ' OR check_out >= %s AND check_out <= %s AND check_out <> "")';
                    $values[] = $start_date;
                    $values[] = $end_date;
                }
                else{
                    $query[] = ' AND (check_in >= %s)';
                    $values[] = $start_date;
                }
            }
            elseif ($end_date != ''){
                $query[] = ' AND check_in <= %s';
                $values[] = $end_date;
            }

            /*
             *  Source for sync
             */
            //                if($type == 'ics') {
            $query[] = ' AND reservation_from <> %s';
            $values[] = 'airbnb';
            //                }

            /*
             * Hours query.
             */
            $query[] = ' AND (start_hour >= %s AND start_hour <= %s OR start_hour = ""';
            $values[] = $start_hour;
            $values[] = $end_hour;

            $query[] = ' OR end_hour >= %s AND end_hour <= %s OR end_hour = "")';
            $values[] = $start_hour;
            $values[] = $end_hour;

            /*
             * Status query.
             */
            if ($status_pending
                    || $status_approved
                    || $status_rejected
                    || $status_canceled
                    || $status_expired){
                $status_init = false;

                if ($status_pending){
                    $query[] = ' AND (status = %s';
                    $values[] = 'pending';
                    $status_init = true;
                }

                if ($status_approved){
                    $query[] = $status_init
                            ? ' OR status = %s'
                            : ' AND (status = %s';
                    $values[] = 'approved';
                    $status_init = true;
                }

                if ($status_rejected){
                    $query[] = $status_init
                            ? ' OR status = %s'
                            : ' AND (status = %s';
                    $values[] = 'rejected';
                    $status_init = true;
                }

                if ($status_canceled){
                    $query[] = $status_init
                            ? ' OR status = %s'
                            : ' AND (status = %s';
                    $values[] = 'canceled';
                    $status_init = true;
                }

                if ($status_expired){
                    $query[] = $status_init
                            ? ' OR status = %s'
                            : ' AND (status = %s';
                    $values[] = 'expired';
                }
                $query[] = ')';
            }
            else{
                $query[] = ' AND status <> %s';
                $values[] = 'expired';
            }

            /*
             * Payment query.
             */
            if (count($payment_methods)>0){
                $payment_init = false;

                for ($i = 0; $i<count($payment_methods); $i++){
                    $query[] = $payment_init
                            ? ' OR payment_method=%s'
                            : ' AND (payment_method=%s';
                    $values[] = $payment_methods[$i];
                    $payment_init = true;
                }
                $query[] = ')';
            }

            /*
             * Search query.
             */
            if ($search != ''){
                $query[] = ' AND (id=%s OR transaction_id=%s OR form LIKE %s)';
                $values[] = $search;
                $values[] = $search;
                $values[] = '%'.$search.'%';
            }

            /*
             * Exclude reservations with incomplete payment.
             */
            $query[] = ' AND (token="" OR (token<>"" AND (payment_method="none" OR payment_method="default")))';

            /*
             * Order query.
             */
            $order_value = $order == 'DESC'
                    ? 'DESC'
                    : 'ASC';

            $order_by_value = match ($order_by) {
                'check_out'    => 'check_out',
                'start_hour'   => 'start_hour',
                'end_hour'     => 'end_hour',
                'id'           => 'id',
                'status'       => 'status',
                'date_created' => 'date_created',
                default        => 'check_in',
            };

            $query[] = ' ORDER BY '.$order_by_value.' '.($order_value);

            /*
             * Pagination query.
             */
            $query[] = ' LIMIT %d, %d';
            $values[] = (($page-1)*$per_page);
            $values[] = $per_page;

            /*
             * ************************************************************* Get reservations.
             */
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $reservations = $wpdb->get_results($wpdb->prepare(implode('',
                                                                      $query),
                                                              $values));

            $csvReservations = array();
            $csvReservationHeader = array('ID',
                                          'Calendar ID',
                                          'Calendar Name',
                                          'Check In',
                                          'Check Out',
                                          'Start Hour');
            $jsonReservationsData = array();

            // ICS
            strtolower($type) == 'ics'
                    ? $DOT->models->reservations_ical->get($reservations)
                    : null;

            // XLS
            strtolower($type) == 'xls'
                    ? $DOT->models->reservations_xls->get($reservations)
                    : null;

            foreach ($reservations as $reservation){
                $csvReservation = array();
                $reservations_form = json_decode($reservation->form);
                $reservation_extras = json_decode($reservation->extras);
                $reservation = (array)$reservation;

                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $calendar = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE id=%d',
                                                          $DOPBSP->tables->calendars,
                                                          $reservation['calendar_id']));

                $csvReservation[] = $reservation['id'];

                if (!array_key_exists('id',
                                      $jsonReservationsData)){
                    $jsonReservationsData['id'] = array();
                }
                $jsonReservationsData['id'][] = $reservation['id'];

                $csvReservation[] = $reservation['calendar_id'];

                $csvReservation[] = $calendar->name;

                if (!array_key_exists('calendar_id',
                                      $jsonReservationsData)){
                    $jsonReservationsData['calendar_id'] = array();
                }
                $jsonReservationsData['calendar_id'][] = $reservation['calendar_id'];

                $csvReservation[] = $reservation['check_in'];

                if (!array_key_exists('check_in',
                                      $jsonReservationsData)){
                    $jsonReservationsData['check_in'] = array();
                }
                $jsonReservationsData['check_in'][] = $reservation['check_in'];

                if ($reservation['check_out'] == ''){
                    $reservation['check_out'] = ' ';
                }

                if ($reservation['check_out'] == ''){
                    unset($csvReservationHeader[3]);
                }
                else{
                    $csvReservation[] = $reservation['check_out'];

                    if (!array_key_exists('check_out',
                                          $jsonReservationsData)){
                        $jsonReservationsData['check_out'] = array();
                    }
                    $jsonReservationsData['check_out'][] = $reservation['check_out'];
                }

                if ($reservation['start_hour'] == ''){
                    $reservation['start_hour'] = ' ';
                }

                if ($reservation['start_hour'] == ''){
                    if ($reservation['check_out'] == ''){
                        unset($csvReservationHeader[3]);
                    }
                    else{
                        unset($csvReservationHeader[4]);
                    }
                }
                else{
                    $csvReservation[] = $reservation['start_hour'];

                    if (!array_key_exists('start_hour',
                                          $jsonReservationsData)){
                        $jsonReservationsData['start_hour'] = array();
                    }
                    $jsonReservationsData['start_hour'][] = $reservation['start_hour'];
                }

                if ($reservation['end_hour'] == ''){
                    $reservation['end_hour'] = ' ';
                }

                //                    if($reservation['end_hour'] != '') {
                $csvReservation[] = $reservation['end_hour'];

                if (!array_key_exists('end_hour',
                                      $jsonReservationsData)){
                    $jsonReservationsData['end_hour'] = array();
                    $csvReservationHeader[] = 'End hour';
                }
                $jsonReservationsData['end_hour'][] = $reservation['end_hour'];
                //                    }

                $csvReservation[] = $reservation['status'];

                if (!array_key_exists('status',
                                      $jsonReservationsData)){
                    $jsonReservationsData['status'] = array();
                    $csvReservationHeader[] = 'Status';
                }
                $jsonReservationsData['status'][] = $reservation['status'];

                if ($reservation['price'] != 0){
                    $csvReservation[] = $reservation['price'];

                    if (!array_key_exists('price',
                                          $jsonReservationsData)){
                        $jsonReservationsData['price'] = array();
                        $csvReservationHeader[] = 'Price';
                    }
                    $jsonReservationsData['price'][] = $reservation['price'];
                }
                else{
                    $csvReservation[] = '0';

                    if (!array_key_exists('price',
                                          $jsonReservationsData)){
                        $jsonReservationsData['price'] = array();
                        $csvReservationHeader[] = 'Price';
                    }
                }

                if ($reservation['extras_price'] != 0){
                    $csvReservation[] = $reservation['extras_price'];

                    if (!array_key_exists('extras_price',
                                          $jsonReservationsData)){
                        $jsonReservationsData['extras_price'] = array();
                        $csvReservationHeader[] = 'Extras price';
                    }
                    $jsonReservationsData['extras_price'][] = $reservation['extras_price'];
                }
                else{
                    $csvReservation[] = '0';

                    if (!array_key_exists('extras_price',
                                          $jsonReservationsData)){
                        $jsonReservationsData['extras_price'] = array();
                        $csvReservationHeader[] = 'Extras price';
                    }
                }

                if ($reservation['fees_price'] != 0){
                    $csvReservation[] = $reservation['fees_price'];

                    if (!array_key_exists('fees_price',
                                          $jsonReservationsData)){
                        $jsonReservationsData['fees_price'] = array();
                        $csvReservationHeader[] = 'Fees price';
                    }
                    $jsonReservationsData['fees_price'][] = $reservation['fees_price'];
                }
                else{
                    $csvReservation[] = '0';

                    if (!array_key_exists('fees_price',
                                          $jsonReservationsData)){
                        $jsonReservationsData['fees_price'] = array();
                        $csvReservationHeader[] = 'Fees price';
                    }
                }

                if ($reservation['coupon_price'] != 0){
                    $csvReservation[] = $reservation['coupon_price'];

                    if (!array_key_exists('coupon_price',
                                          $jsonReservationsData)){
                        $jsonReservationsData['coupon_price'] = array();
                        $csvReservationHeader[] = 'Coupon price';
                    }
                    $jsonReservationsData['coupon_price'][] = $reservation['coupon_price'];
                }
                else{
                    $csvReservation[] = '0';

                    if (!array_key_exists('coupon_price',
                                          $jsonReservationsData)){
                        $jsonReservationsData['coupon_price'] = array();
                        $csvReservationHeader[] = 'Coupon price';
                    }
                }

                if ($reservation['deposit_price'] != 0){
                    $csvReservation[] = $reservation['deposit_price'];

                    if (!array_key_exists('deposit_price',
                                          $jsonReservationsData)){
                        $jsonReservationsData['deposit_price'] = array();
                        $csvReservationHeader[] = 'Deposit price';
                    }
                    $jsonReservationsData['deposit_price'][] = $reservation['deposit_price'];
                }
                else{
                    $csvReservation[] = '0';

                    if (!array_key_exists('deposit_price',
                                          $jsonReservationsData)){
                        $jsonReservationsData['deposit_price'] = array();
                        $csvReservationHeader[] = 'Deposit price';
                    }
                }

                $csvReservation[] = $reservation['price_total'];

                if (!array_key_exists('price_total',
                                      $jsonReservationsData)){
                    $jsonReservationsData['price_total'] = array();
                    $csvReservationHeader[] = 'Total price';
                }
                $jsonReservationsData['price_total'][] = $reservation['price_total'];
                $csvReservation[] = $reservation['currency_code'];

                if (!array_key_exists('currency_code',
                                      $jsonReservationsData)){
                    $jsonReservationsData['currency_code'] = array();
                    $csvReservationHeader[] = 'Currency';
                }
                $jsonReservationsData['currency_code'][] = $reservation['currency_code'];

                if ($reservation['no_items'] != 0){
                    $csvReservation[] = $reservation['no_items'];

                    if (!array_key_exists('no_items',
                                          $jsonReservationsData)){
                        $jsonReservationsData['no_items'] = array();
                        $csvReservationHeader[] = 'No. Items';
                    }
                    $jsonReservationsData['no_items'][] = $reservation['no_items'];
                }
                else{
                    $csvReservation[] = '0';

                    if (!array_key_exists('no_items',
                                          $jsonReservationsData)){
                        $jsonReservationsData['no_items'] = array();
                        $csvReservationHeader[] = 'No. Items';
                    }
                }

                foreach ($reservations_form as $data){
                    if (!in_array($data->translation,
                                  $csvReservationHeader)){
                        $csvReservationHeader[] = $data->translation;
                    }
                    $csvReservation[] = $data->value;

                    if (!array_key_exists(str_replace(" ",
                                                      "",
                                                      strtolower($data->translation)),
                                          $jsonReservationsData)){
                        $jsonReservationsData[str_replace(" ",
                                                          "",
                                                          strtolower($data->translation))] = array();
                    }
                    $jsonReservationsData[str_replace(" ",
                                                      "",
                                                      strtolower($data->translation))][] = $data->value;
                }

                foreach ($reservation_extras as $data){
                    if (!in_array($data->group_translation,
                                  $csvReservationHeader)){
                        $csvReservationHeader[] = $data->group_translation;
                    }
                    $csvReservation[] = $data->translation;

                    if (!array_key_exists(str_replace(" ",
                                                      "",
                                                      strtolower($data->group_translation)),
                                          $jsonReservationsData)){
                        $jsonReservationsData[str_replace(" ",
                                                          "",
                                                          strtolower($data->group_translation))] = array();
                    }
                    $jsonReservationsData[str_replace(" ",
                                                      "",
                                                      strtolower($data->group_translation))][] = $data->translation;
                }

                $csvReservation[] = $reservation['date_created'];

                if (!array_key_exists('date_created',
                                      $jsonReservationsData)){
                    $jsonReservationsData['date_created'] = array();
                    $csvReservationHeader[] = 'Date created';
                }
                $jsonReservationsData['date_created'][] = $reservation['date_created'];

                $csvReservations[] = implode(',',
                                             $csvReservation);
            }

            if (!array_key_exists('Export date:',
                                  $jsonReservationsData)){
                $csvReservationHeader[] = 'Export date:';
            }
            $csvReservationHeader[] = $export_date;

            array_unshift($csvReservations,
                          implode(',',
                                  $csvReservationHeader));

            if (strtolower($type) == 'csv'){
                $DOT->echo(implode('\r\n',
                                   $csvReservations),
                           'textarea');
            }
            elseif (strtolower($type) == 'json'){
                $DOT->echo($jsonReservationsData,
                           'json');
            }

            exit;
        }

        /*
         * Get reservation with data.
         *
         * @param message (string): message template
         * @param reservation (object): reservation data
         * @param calendar (object): calendar data
         * @param settings_calendar (object): calendar settings data
         * @param settings_payment (object): payment settings data
         *
         * @return modified message
         */
        function getSyncDescription($message,
                                    $reservation){
            global $DOPBSP;
            global $wpdb;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE id=%d',
                                          $DOPBSP->tables->calendars,
                                          $reservation->calendar_id));

            $DOPBSP->classes->backend_settings->values($reservation->calendar_id,
                                                       'calendar');
            $DOPBSP->classes->backend_settings->values($reservation->calendar_id,
                                                       'payment');
            $DOPBSP->classes->translation->set();

            return str_replace('|FORM|',
                               '',
                               $message);
        }

        /*
         * Get reservation form.
         *
         * @param reservation (object): reservation data
         *
         * @return form info
         */
        function getForm($reservation){
            global $DOPBSP;

            $info = array();

            $form = json_decode($reservation->form);

            for ($i = 0; $i<count($form); $i++){
                if (!is_array($form[$i])){
                    $form_item = get_object_vars($form[$i]);
                }
                else{
                    $form_item = $form[$i];
                }

                if (is_array($form_item['value'])){
                    $values = array();

                    foreach ($form_item['value'] as $value){
                        $values[] = $value->translation;
                    }
                    $info[] = $this->getSyncInfo($form_item['translation'],
                                                 implode('',
                                                         $values));
                }
                else{
                    if ($form_item['value'] == 'true'){
                        $value = $DOPBSP->text('FORMS_FORM_FIELD_TYPE_CHECKBOX_CHECKED_LABEL');
                    }
                    elseif ($form_item['value'] == 'false'){
                        $value = $DOPBSP->text('FORMS_FORM_FIELD_TYPE_CHECKBOX_UNCHECKED_LABEL');
                    }
                    else{
                        $value = $form_item['value'];
                    }
                    $info[] = $this->getSyncInfo('',
                                                 $value != ''
                                                         ? $value
                                                         : $DOPBSP->text('RESERVATIONS_RESERVATION_NO_FORM_FIELD'));
                }
            }

            return implode(', ',
                           $info);
        }

        /*
         * Get info field.
         *
         * @param label (string):  data label
         * @param value (string):  data value
         *
         * @return info field
         */
        function getSyncInfo($label = '',
                             $value = ''){
            $info = array();

            $info[] = $label.''.$value;

            return implode('',
                           $info);
        }

        /*
         * Set reservations status to expired if check out day has passed.
         */
        function clean(){
            global $wpdb;
            global $DOPBSP;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->query($wpdb->prepare('DELETE FROM %i WHERE token <> "" AND ((check_out < "'.date('Y-m-d').'" AND check_out <> "") OR (check_in < "'.date('Y-m-d').'" AND check_out = ""))',
                                        $DOPBSP->tables->reservations));
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->query($wpdb->prepare('UPDATE %i SET status="expired" WHERE status <> "expired" AND ((check_out < "'.date('Y-m-d').'" AND check_out <> "") OR (check_in < "'.date('Y-m-d').'" AND check_out = ""))',
                                        $DOPBSP->tables->reservations));
        }
    }
}