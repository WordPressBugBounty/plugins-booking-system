<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/config/config-classes.php
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Framework classes config file.
 */

global $dot_classes;

$dot_classes = array(/*
                      * Helper - 1st class to load.
                      */
                     'helper'      => (object)array('class' => 'DOTHelper',
                                                    'file'  => 'class-helper'),
                     /*
                      * Prototypes - 2nd class to load.
                      */
                     'prototypes'  => (object)array('class' => 'DOTPrototypes',
                                                    'file'  => 'class-prototypes'),
                     /*
                      * Session - 3rd class to load.
                      */
//                     'session'     => (object)array('class' => 'DOTSession',
//                                                    'file'  => 'class-session'),
                     /*
                      * Cookie - 4th class to load.
                      */
                     'cookie'      => (object)array('class' => 'DOTCookie',
                                                    'file'  => 'class-cookie'),
                     /*
                      * Escape - 5th class to load.
                      */
                     'escape'      => (object)array('class' => 'DOTEscape',
                                                    'file'  => 'class-escape'),
                     /*
                      * Sanitize - 6th class to load.
                      */
                     'sanitize'    => (object)array('class' => 'DOTSanitize',
                                                    'file'  => 'class-sanitize'),
                     /*
                      * Permalink - 7th class to load.
                      */
                     'permalink'   => (object)array('class' => 'DOTPermalink',
                                                    'file'  => 'class-permalink'),
                     /*
                      * Hooks - 8th class to load.
                      */
                     'hooks'       => (object)array('class' => 'DOTHooks',
                                                    'file'  => 'class-hooks'),
                     /*
                      * Files - 9th class to load.
                      */
                     'files'       => (object)array('class' => 'DOTFiles',
                                                    'file'  => 'class-files'),
                     /*
                      * Database - 10th class to load.
                      */
                     'db'          => (object)array('class' => 'DOTDatabase',
                                                    'file'  => 'class-database'),
                     /*
                      * Translation - 11th class to load.
                      */
                     'translation' => (object)array('class' => 'DOTTranslation',
                                                    'file'  => 'class-translation'),
                     /*
                      * Language - 12th class to load.
                      */
//                     'language'    => (object)array('class' => 'DOTLanguage',
//                                                    'file'  => 'class-language'),
                     /*
                      * AJAX - 13th class to load.
                      */
                     'ajax'        => (object)array('class' => 'DOTAjax',
                                                    'file'  => 'class-ajax'),
                     /*
                      * Models - 14th class to load.
                      */
                     'models'      => (object)array('class' => 'DOTModels',
                                                    'file'  => 'class-models'),
                     /*
                      * View - 15th class to load.
                      */
                     'view'        => (object)array('class' => 'DOTView',
                                                    'file'  => 'class-view'),
                     /*
                      * Controllers - 16th class to load.
                      */
                     'controllers' => (object)array('class' => 'DOTControllers',
                                                    'file'  => 'class-controllers'),
                     /*
                      * Controller - 17th class to load.
                      */
                     'controller'  => (object)array('class' => 'DOTController',
                                                    'file'  => 'class-controller'),
                     /*
                      * Admin menu - 18th class to load.
                      */
//                     'menu'        => (object)array('class' => 'DOTMenu',
//                                                    'file'  => 'class-menu'),
                     /*
                      * Shortcode - 19th class to load.
                      */
//                     'shortcode'   => (object)array('class' => 'DOTShortcode',
//                                                    'file'  => 'class-shortcode'),
                     /*
                      * Email - 20th class to load.
                      */
                     'email'       => (object)array('class' => 'DOTEmail',
                                                    'file'  => 'class-email'),
                     /*
                      * Add-ons - 21st class to load.
                      */
                     'addons'      => (object)array('class' => 'DOTAddons',
                                                    'file'  => 'class-addons'));