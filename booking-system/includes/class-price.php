<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : includes/class-price.php
* File Version            : 1.0.1
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Price PHP class.
*/

if (!class_exists('DOPBSPPrice')){
    class DOPBSPPrice{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Display price with currency in set format.
         *
         * @param price (float): price value
         * @param currency (string): currency sign
         * @param position (string): currency position
         *
         * @return price with currency
         */
        function set($price,
                     $currency,
                     $position = 'before'){
            global $DOPBSP;

            $price = $DOPBSP->classes->prototypes->getWithDecimals(abs($price),
                                                                   2);

            return match ($position) {
                'after'             => $price.$currency,
                'after_with_space'  => $price.' '.$currency,
                'before_with_space' => $currency.' '.$price,
                default             => $currency.$price,
            };
        }
    }
}