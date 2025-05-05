<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : views/reservations/views-backend-reservation-extras.php
* File Version            : 1.0.5
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end reservation extras views class.
*/

if (!class_exists('DOPBSPViewsBackEndReservationExtras')){
    class DOPBSPViewsBackEndReservationExtras extends DOPBSPViewsBackEndReservation{
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
            ?>
            <div class="dopbsp-data-module">
                <div class="dopbsp-data-head">
                    <h3><?php echo $DOPBSP->text('EXTRAS_FRONT_END_TITLE'); ?></h3>
                </div>
                <div class="dopbsp-data-body">
                    <?php
                    if ($reservation->extras != ''){
                        $extras = json_decode(mb_convert_encoding($reservation->extras,
                                                                  'ISO-8859-1',
                                                                  'UTF-8'));

                        for ($i = 0; $i<count($extras); $i++){
                            $extras[$i]->displayed = false;
                        }

                        for ($i = 0; $i<count($extras); $i++){
                            $values = array();

                            if (!$extras[$i]->displayed){
                                for ($j = 0; $j<count($extras); $j++){
                                    $value = array();
                                    $extra = $extras[$j];

                                    if ($extras[$i]->group_id == $extra->group_id){
                                        $value[] = $extra->translation;

                                        if ($extra->price != 0){
                                            $value[] = '<br />';

                                            if ($extra->price_type != 'fixed'
                                                    || $extra->price_by != 'once'){
                                                $value[] = '<span class="dopbsp-info-rule">&#9632;&nbsp;';

                                                if ($extra->price_type == 'fixed'){
                                                    $value[] = $extra->operation.'&nbsp;'.$DOPBSP->classes->price->set($extra->price,
                                                                                                                       $reservation->currency,
                                                                                                                       $settings_calendar->currency_position);
                                                }
                                                else{
                                                    $value[] = $extra->operation.'&nbsp;'.$extra->price.'%';
                                                }

                                                if ($extra->price_by != 'once'){
                                                    $value[] = '/'.($settings_calendar->hours_enabled == 'true'
                                                                    ? $DOPBSP->text('EXTRAS_FRONT_END_BY_HOUR')
                                                                    : $DOPBSP->text('EXTRAS_FRONT_END_BY_DAY'));
                                                }
                                                $value[] = '</span><br />';
                                            }
                                            $value[] = '<span class="dopbsp-info-price">'.$extra->operation.'&nbsp;';
                                            $value[] = $DOPBSP->classes->price->set($extra->price_total,
                                                                                    $reservation->currency,
                                                                                    $settings_calendar->currency_position);
                                            $value[] = '</span>';
                                        }

                                        if (count($value) != 0){
                                            $extras[$j]->displayed = true;
                                            $values[] = implode('',
                                                                $value);
                                        }
                                    }
                                }
                                $this->displayData($extras[$i]->group_translation,
                                                   implode('<br /><br />',
                                                           $values));
                            }
                        }

                        if ($reservation->extras_price != 0){
                            echo '<br />';
                            $this->displayData($DOPBSP->text('RESERVATIONS_RESERVATION_PAYMENT_PRICE_CHANGE'),
                                               ($reservation->extras_price>0
                                                       ? '+'
                                                       : '-').
                                               '&nbsp;'.
                                               $DOPBSP->classes->price->set($reservation->extras_price,
                                                                            $reservation->currency,
                                                                            $settings_calendar->currency_position),
                                               'dopbsp-price');
                        }
                    }
                    else{
                        echo '<em>'.$DOPBSP->text('RESERVATIONS_RESERVATION_NO_EXTRAS').'</em>';
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }
}