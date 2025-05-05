<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : views/reservations/views-backend-reservation-discount.php
* File Version            : 1.0.5
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end reservation discount views class.
*/

if (!class_exists('DOPBSPViewsBackEndReservationDiscount')){
    class DOPBSPViewsBackEndReservationDiscount extends DOPBSPViewsBackEndReservation{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * @param args (array): function arguments
         *                      * reservation (object): reservation data
         *                      * settings_calendar (object): calendar settings data
         */
        function template($args = array()){
            global $DOPBSP;

            $reservation = $args['reservation'];
            $settings_calendar = $args['settings_calendar'];

            $discount = json_decode(mb_convert_encoding($reservation->discount,
                                                        'ISO-8859-1',
                                                        'UTF-8'));
            ?>
            <div class="dopbsp-data-module">
                <div class="dopbsp-data-head">
                    <h3><?php echo $DOPBSP->text('DISCOUNTS_FRONT_END_TITLE'); ?></h3>
                </div>
                <div class="dopbsp-data-body">
                    <?php
                    if ($discount->id != 0){
                        $value = array();

                        $value[] = '<span class="dopbsp-info-rule">&#9632;&nbsp;';

                        if ($discount->price_type == 'fixed'){
                            $value[] = $discount->operation.'&nbsp;'.$DOPBSP->classes->price->set($discount->price,
                                                                                                  $reservation->currency,
                                                                                                  $settings_calendar->currency_position);
                        }
                        else{
                            $value[] = $discount->operation.'&nbsp;'.$discount->price.'%';
                        }

                        if ($discount->price_by != 'once'){
                            $value[] = '/'.($settings_calendar->hours_enabled == 'true'
                                            ? $DOPBSP->text('DISCOUNTS_FRONT_END_BY_HOUR')
                                            : $DOPBSP->text('DISCOUNTS_FRONT_END_BY_DAY'));
                        }
                        $value[] = '</span>';

                        $this->displayData($discount->translation,
                                           implode('',
                                                   $value));

                        if ($reservation->discount_price != 0){
                            echo '<br />';
                            $this->displayData($DOPBSP->text('RESERVATIONS_RESERVATION_PAYMENT_PRICE_CHANGE'),
                                               ($reservation->discount_price>0
                                                       ? '+'
                                                       : '-').
                                               '&nbsp;'.
                                               $DOPBSP->classes->price->set($reservation->discount_price,
                                                                            $reservation->currency,
                                                                            $settings_calendar->currency_position),
                                               'dopbsp-price');
                        }
                    }
                    else{
                        echo '<em>'.$DOPBSP->text('RESERVATIONS_RESERVATION_NO_DISCOUNT').'</em>';
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }
}