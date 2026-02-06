<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.2
* File                    : includes/coupons/class-frontend-coupons.php
* File Version            : 1.0.3
* Created / Last Modified : 10 November 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Front end coupons PHP class.
*/

if (!class_exists('DOPBSPFrontEndCoupons')){
    class DOPBSPFrontEndCoupons{
        /*
         * Constructor.
         */
        function __construct(){
        }

        /*
         * Get selected coupons.
         *
         * @param id(string): coupon ID
         * @param language (string): selected language
         *
         * @return data array
         */
        function get($id,
                     $language = DOPBSP_CONFIG_TRANSLATION_DEFAULT_LANGUAGE){
            global $wpdb;
            global $DOPBSP;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $coupon = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE id=%d ORDER BY id',
                                                    $DOPBSP->tables->coupons,
                                                    $id));

            if ($id != 0){
                if (isset($coupon->translation)
                        && $coupon->translation != ''){
                    $coupon->translation = $DOPBSP->classes->translation->decodeJSON($coupon->translation,
                                                                                     $language);
                    $coupon->code = '';
                }
            }

            return array('data' => array('coupon' => $coupon,
                                         'id'     => $id),
                         'text' => array('byDay'         => $DOPBSP->text('COUPONS_FRONT_END_BY_DAY'),
                                         'byHour'        => $DOPBSP->text('COUPONS_FRONT_END_BY_HOUR'),
                                         'code'          => $DOPBSP->text('COUPONS_FRONT_END_CODE'),
                                         'title'         => $DOPBSP->text('COUPONS_FRONT_END_TITLE'),
                                         'use'           => $DOPBSP->text('COUPONS_FRONT_END_USE'),
                                         'verify'        => $DOPBSP->text('COUPONS_FRONT_END_VERIFY'),
                                         'verifyError'   => $DOPBSP->text('COUPONS_FRONT_END_VERIFY_ERROR'),
                                         'verifySuccess' => $DOPBSP->text('COUPONS_FRONT_END_VERIFY_SUCCESS')));
        }

        /*
         * Verify coupon code.
         *
         * @post id (integer): coupon ID
         * @post code (string): coupon code
         * @post today (string): today date
         * @post curr_time (string): current time
         *
         * @return "success" or "error" message
         */
        function verify(){
            global $DOT;
            global $wpdb;
            global $DOPBSP;

            $code = $DOT->post('code');
            $check_in = $DOT->post('check_in');
            $check_out = $DOT->post('check_out');
            $start_hour = $DOT->post('start_hour');
            $end_hour = $DOT->post('end_hour');
            $language = $DOT->post('language');
            $calendar_id = $DOT->post('calendar_id',
                                      'int');

            $settings_calendar = $DOPBSP->classes->backend_settings->values($calendar_id,
                                                                            'calendar');

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $coupon = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE code=%s ORDER BY id',
                                                    $DOPBSP->tables->coupons,
                                                    $code));

            if (str_contains($settings_calendar->coupon,
                             ',')){
                $coupons_active = explode(',',
                                          $settings_calendar->coupon);

                if (!in_array($coupon->id,
                              $coupons_active)){
                    $DOT->echo('error');
                    die();
                }
            }
            else{
                if ($coupon->id != $settings_calendar->coupon){
                    $DOT->echo('error');
                    die();
                }
            }

            if ($code == $coupon->code
                    && ($coupon->start_date == ''
                            || $coupon->start_date<=$check_in)
                    && ($coupon->end_date == ''
                            || $coupon->end_date>=$check_out
                            && $check_in<=$coupon->end_date)
                    && ($coupon->start_hour == ''
                            || $coupon->start_hour<=$start_hour)
                    && ($coupon->end_hour == ''
                            || $coupon->end_hour>=$end_hour
                            && $start_hour<=$coupon->end_hour)
                    && ($coupon->no_coupons == ''
                            || (int)$coupon->no_coupons>0)
                    && (int)$coupon->price>0){
                if ($coupon->translation != ''){
                    $coupon->translation = $DOPBSP->classes->translation->decodeJSON($coupon->translation,
                                                                                     $language);
                }
                $DOT->echo($coupon,
                           'json');
            }
            else{
                $DOT->echo('error');
            }

            die();
        }
    }
}