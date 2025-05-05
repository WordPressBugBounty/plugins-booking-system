<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.8
* File                    : views/views.php
* File Version            : 1.1.1
* Created / Last Modified : 15 March 2016
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Views class.
*/

if (!class_exists('DOPBSPViews')){
    class DOPBSPViews{
        /*
         * Private variables.
         */
        private array $views = array();

        /*
         * Public variables.
         */
        public object $backend;

        public object $frontend;

        public object $backend_addons;
        public object $backend_addons_filters;
        public object $backend_addons_list;

        public object $backend_amenities;

        public object $backend_calendars;

        public object $backend_coupons;
        public object $backend_coupon;

        public object $backend_dashboard;
        public object $backend_dashboard_api;
        public object $backend_dashboard_server;
        public object $backend_dashboard_start;

        public object $backend_discounts;
        public object $backend_discount;
        public object $backend_discount_items;
        public object $backend_discount_item;
        public object $backend_discount_item_rule;

        public object $backend_emails;
        public object $backend_email;

        public object $backend_extras;
        public object $backend_extra;
        public object $backend_extra_groups;
        public object $backend_extra_group;
        public object $backend_extra_group_item;

        public object $backend_fees;
        public object $backend_fee;

        public object $backend_forms;
        public object $backend_form;
        public object $backend_form_fields;
        public object $backend_form_field;
        public object $backend_form_field_select_option;

        public object $backend_languages;

        public object $backend_locations;
        public object $backend_location;

        public object $backend_models;
        public object $backend_model;

        public object $backend_reservations;
        public object $backend_reservations_list;
        public object $backend_reservation;
        public object $backend_reservation_address;
        public object $backend_reservation_coupon;
        public object $backend_reservation_details;
        public object $backend_reservation_discount;
        public object $backend_reservation_extras;
        public object $backend_reservation_fees;
        public object $backend_reservation_form;

        public object $backend_reviews;

        public object $backend_rules;
        public object $backend_rule;

        public object $backend_searches;
        public object $backend_search;
        public object $frontend_search;
        public object $frontend_search_results;
        public object $frontend_search_results_list;
        public object $frontend_search_results_grid;
        public object $frontend_search_sidebar;
        public object $frontend_search_sort;
        public object $frontend_search_view;

        public object $backend_settings;
        public object $backend_settings_general;
        public object $backend_settings_calendar;
        public object $backend_settings_licences;
        public object $backend_settings_notifications;
        public object $backend_settings_payment_gateways;
        public object $backend_settings_paypal;
        public object $backend_settings_search;
        public object $backend_settings_users;

        public object $backend_settings_mollie;
        public object $backend_settings_stripe;

        public object $backend_smses;
        public object $backend_sms;

        public object $backend_templates;

        public object $backend_themes;
        public object $backend_themes_filters;
        public object $backend_themes_list;

        public object $backend_tools;
        public object $backend_tools_repair_calendars_settings;
        public object $backend_tools_repair_search_settings;

        public object $backend_translation;

        /*
         * Constructor
         */
        function __construct(){
            $this->set();

            add_action('init',
                       array(&$this,
                             'init'));
        }

        /*
         * Initialize view.
         */
        function init(){
            $this->views = apply_filters('dopbsp_filter_views',
                                         $this->views);

            $this->initViews();
        }

        /*
         * Initialize view classes.
         */
        function initViews(){
            $views = $this->views;

            for ($i = 0; $i<count($views); $i++){
                if (class_exists($views[$i]['name'])){
                    $key = $views[$i]['key'];
                    $this->{$key} = new $views[$i]['name']();
                }
            }
        }

        /*
         * Set view classes.
         */
        function set(){
            /*
             * Set back end view.
             */
            $this->views[] = array('key'  => 'backend',
                                   'name' => 'DOPBSPViewsBackEnd');

            /*
             * Set front end view.
             */
            $this->views[] = array('key'  => 'frontend',
                                   'name' => 'DOPBSPViewsFrontEnd');

            /*
             * Set addons view classes.
             */
            $this->views[] = array('key'  => 'backend_addons',
                                   'name' => 'DOPBSPViewsBackEndAddons');
            $this->views[] = array('key'  => 'backend_addons_filters',
                                   'name' => 'DOPBSPViewsBackEndAddonsFilters');
            $this->views[] = array('key'  => 'backend_addons_list',
                                   'name' => 'DOPBSPViewsBackEndAddonsList');

            /*
             * Set amenities view classes.
             */
            $this->views[] = array('key'  => 'backend_amenities',
                                   'name' => 'DOPBSPViewsBackEndAmenities');

            /*
             * Set calendars view classes.
             */
            $this->views[] = array('key'  => 'backend_calendars',
                                   'name' => 'DOPBSPViewsBackEndCalendars');

            /*
             * Set coupons view classes.
             */
            $this->views[] = array('key'  => 'backend_coupons',
                                   'name' => 'DOPBSPViewsBackEndCoupons');
            $this->views[] = array('key'  => 'backend_coupon',
                                   'name' => 'DOPBSPViewsBackEndCoupon');

            /*
             * Set dashboard view classes.
             */
            $this->views[] = array('key'  => 'backend_dashboard',
                                   'name' => 'DOPBSPViewsBackEndDashboard');
            $this->views[] = array('key'  => 'backend_dashboard_api',
                                   'name' => 'DOPBSPViewsBackEndDashboardAPI');
            $this->views[] = array('key'  => 'backend_dashboard_server',
                                   'name' => 'DOPBSPViewsBackEndDashboardServer');
            $this->views[] = array('key'  => 'backend_dashboard_start',
                                   'name' => 'DOPBSPViewsBackEndDashboardStart');

            /*
             * Set discounts view classes.
             */
            $this->views[] = array('key'  => 'backend_discounts',
                                   'name' => 'DOPBSPViewsBackEndDiscounts');
            $this->views[] = array('key'  => 'backend_discount',
                                   'name' => 'DOPBSPViewsBackEndDiscount');
            $this->views[] = array('key'  => 'backend_discount_items',
                                   'name' => 'DOPBSPViewsBackEndDiscountItems');
            $this->views[] = array('key'  => 'backend_discount_item',
                                   'name' => 'DOPBSPViewsBackEndDiscountItem');
            $this->views[] = array('key'  => 'backend_discount_item_rule',
                                   'name' => 'DOPBSPViewsBackEndDiscountItemRule');

            /*
             * Set emails view classes.
             */
            $this->views[] = array('key'  => 'backend_emails',
                                   'name' => 'DOPBSPViewsBackEndEmails');
            $this->views[] = array('key'  => 'backend_email',
                                   'name' => 'DOPBSPViewsBackEndEmail');

            /*
             * Set extras view classes.
             */
            $this->views[] = array('key'  => 'backend_extras',
                                   'name' => 'DOPBSPViewsBackEndExtras');
            $this->views[] = array('key'  => 'backend_extra',
                                   'name' => 'DOPBSPViewsBackEndExtra');
            $this->views[] = array('key'  => 'backend_extra_groups',
                                   'name' => 'DOPBSPViewsBackEndExtraGroups');
            $this->views[] = array('key'  => 'backend_extra_group',
                                   'name' => 'DOPBSPViewsBackEndExtraGroup');
            $this->views[] = array('key'  => 'backend_extra_group_item',
                                   'name' => 'DOPBSPViewsBackEndExtraGroupItem');

            /*
             * Set fees view classes.
             */
            $this->views[] = array('key'  => 'backend_fees',
                                   'name' => 'DOPBSPViewsBackEndFees');
            $this->views[] = array('key'  => 'backend_fee',
                                   'name' => 'DOPBSPViewsBackEndFee');

            /*
             * Set forms view classes.
             */
            $this->views[] = array('key'  => 'backend_forms',
                                   'name' => 'DOPBSPViewsBackEndForms');
            $this->views[] = array('key'  => 'backend_form',
                                   'name' => 'DOPBSPViewsBackEndForm');
            $this->views[] = array('key'  => 'backend_form_fields',
                                   'name' => 'DOPBSPViewsBackEndFormFields');
            $this->views[] = array('key'  => 'backend_form_field',
                                   'name' => 'DOPBSPViewsBackEndFormField');
            $this->views[] = array('key'  => 'backend_form_field_select_option',
                                   'name' => 'DOPBSPViewsBackEndFormFieldSelectOption');

            /*
             * Set languages view classes.
             */
            $this->views[] = array('key'  => 'backend_languages',
                                   'name' => 'DOPBSPViewsBackEndLanguages');

            /*
             * Set locations view classes.
             */
            $this->views[] = array('key'  => 'backend_locations',
                                   'name' => 'DOPBSPViewsBackEndLocations');
            $this->views[] = array('key'  => 'backend_location',
                                   'name' => 'DOPBSPViewsBackEndLocation');

            /*
             * Set models view classes.
             */
            $this->views[] = array('key'  => 'backend_models',
                                   'name' => 'DOPBSPViewsBackEndModels');
            $this->views[] = array('key'  => 'backend_model',
                                   'name' => 'DOPBSPViewsBackEndModel');

            /*
             * Set reservations view classes.
             */
            $this->views[] = array('key'  => 'backend_reservations',
                                   'name' => 'DOPBSPViewsBackEndReservations');
            $this->views[] = array('key'  => 'backend_reservations_list',
                                   'name' => 'DOPBSPViewsBackEndReservationsList');
            $this->views[] = array('key'  => 'backend_reservation',
                                   'name' => 'DOPBSPViewsBackEndReservation');
            $this->views[] = array('key'  => 'backend_reservation_address',
                                   'name' => 'DOPBSPViewsBackEndReservationAddress');
            $this->views[] = array('key'  => 'backend_reservation_coupon',
                                   'name' => 'DOPBSPViewsBackEndReservationCoupon');
            $this->views[] = array('key'  => 'backend_reservation_details',
                                   'name' => 'DOPBSPViewsBackEndReservationDetails');
            $this->views[] = array('key'  => 'backend_reservation_discount',
                                   'name' => 'DOPBSPViewsBackEndReservationDiscount');
            $this->views[] = array('key'  => 'backend_reservation_extras',
                                   'name' => 'DOPBSPViewsBackEndReservationExtras');
            $this->views[] = array('key'  => 'backend_reservation_fees',
                                   'name' => 'DOPBSPViewsBackEndReservationFees');
            $this->views[] = array('key'  => 'backend_reservation_form',
                                   'name' => 'DOPBSPViewsBackEndReservationForm');

            /*
             * Set reviews view classes.
             */
            $this->views[] = array('key'  => 'backend_reviews',
                                   'name' => 'DOPBSPViewsBackEndReviews');

            /*
             * Set rules view classes.
             */
            $this->views[] = array('key'  => 'backend_rules',
                                   'name' => 'DOPBSPViewsBackEndRules');
            $this->views[] = array('key'  => 'backend_rule',
                                   'name' => 'DOPBSPViewsBackEndRule');

            /*
             * Set search view classes.
             */
            $this->views[] = array('key'  => 'backend_searches',
                                   'name' => 'DOPBSPViewsBackEndSearches');
            $this->views[] = array('key'  => 'backend_search',
                                   'name' => 'DOPBSPViewsBackEndSearch');
            $this->views[] = array('key'  => 'frontend_search',
                                   'name' => 'DOPBSPViewsFrontEndSearch');
            $this->views[] = array('key'  => 'frontend_search_results',
                                   'name' => 'DOPBSPViewsFrontEndSearchResults');
            $this->views[] = array('key'  => 'frontend_search_results_list',
                                   'name' => 'DOPBSPViewsFrontEndSearchResultsList');
            $this->views[] = array('key'  => 'frontend_search_results_grid',
                                   'name' => 'DOPBSPViewsFrontEndSearchResultsGrid');
            $this->views[] = array('key'  => 'frontend_search_sidebar',
                                   'name' => 'DOPBSPViewsFrontEndSearchSidebar');
            $this->views[] = array('key'  => 'frontend_search_sort',
                                   'name' => 'DOPBSPViewsFrontEndSearchSort');
            $this->views[] = array('key'  => 'frontend_search_view',
                                   'name' => 'DOPBSPViewsFrontEndSearchView');

            /*
             * Set settings view classes.
             */
            $this->views[] = array('key'  => 'backend_settings',
                                   'name' => 'DOPBSPViewsBackEndSettings');
            $this->views[] = array('key'  => 'backend_settings_general',
                                   'name' => 'DOPBSPViewsBackEndSettingsGeneral');
            $this->views[] = array('key'  => 'backend_settings_calendar',
                                   'name' => 'DOPBSPViewsBackEndSettingsCalendar');
            $this->views[] = array('key'  => 'backend_settings_licences',
                                   'name' => 'DOPBSPViewsBackEndSettingsLicences');
            $this->views[] = array('key'  => 'backend_settings_notifications',
                                   'name' => 'DOPBSPViewsBackEndSettingsNotifications');
            $this->views[] = array('key'  => 'backend_settings_payment_gateways',
                                   'name' => 'DOPBSPViewsBackEndSettingsPaymentGateways');
            $this->views[] = array('key'  => 'backend_settings_search',
                                   'name' => 'DOPBSPViewsBackEndSettingsSearch');
            $this->views[] = array('key'  => 'backend_settings_users',
                                   'name' => 'DOPBSPViewsBackEndSettingsUsers');

            /*
             * Set SMSes view classes.
             */
            $this->views[] = array('key'  => 'backend_smses',
                                   'name' => 'DOPBSPViewsBackEndSmses');
            $this->views[] = array('key'  => 'backend_sms',
                                   'name' => 'DOPBSPViewsBackEndSms');

            /*
             * Set templates view classes.
             */
            $this->views[] = array('key'  => 'backend_templates',
                                   'name' => 'DOPBSPViewsBackEndTemplates');

            /*
             * Set themes view classes.
             */
            $this->views[] = array('key'  => 'backend_themes',
                                   'name' => 'DOPBSPViewsBackEndThemes');
            $this->views[] = array('key'  => 'backend_themes_filters',
                                   'name' => 'DOPBSPViewsBackEndThemesFilters');
            $this->views[] = array('key'  => 'backend_themes_list',
                                   'name' => 'DOPBSPViewsBackEndThemesList');

            /*
             * Set tools view classes.
             */
            $this->views[] = array('key'  => 'backend_tools',
                                   'name' => 'DOPBSPViewsBackEndTools');
            $this->views[] = array('key'  => 'backend_tools_repair_calendars_settings',
                                   'name' => 'DOPBSPViewsBackEndToolsRepairCalendarsSettings');
            $this->views[] = array('key'  => 'backend_tools_repair_search_settings',
                                   'name' => 'DOPBSPViewsBackEndToolsRepairSearchSettings');

            /*
             * Set translation view classes.
             */
            $this->views[] = array('key'  => 'backend_translation',
                                   'name' => 'DOPBSPViewsBackEndTranslation');
        }
    }
}