<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/config/config.php
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Framework configuration file.
 */

/*
 * Define the paths.
 */
!defined('DOT_ABS_PATH')
        ? define('DOT_ABS_PATH',
                 str_replace('/framework/config/',
                             '',
                             str_replace('\\',
                                         '/',
                                         dirname(rtrim(__FILE__,
                                                       '/\\')).'/')))
        : null; // Application/framework absolute path.
!defined('DOT_URL')
        ? define('DOT_URL',
                 str_replace('/framework/config/',
                             '',
                             plugin_dir_url(__FILE__)))
        : null; // Application URL.

/*
 * Include main configuration first.
 */
include_once DOT_ABS_PATH.'/config.php';

/*
 * Define configuration before other configuration files.
 */

/*
 * Main configuration.
 */
!defined('DOT_ID')
        ? define('DOT_ID',
                 'dot')
        : null; // Unique application ID.
!defined('DOT_PLATFORM')
        ? define('DOT_PLATFORM',
                 '')
        : null; // Application platform.
!defined('DOT_STATUS')
        ? define('DOT_STATUS',
                 'beta')
        : null; // Application status (beta, live, maintenance).
!defined('DOT_VERSION')
        ? define('DOT_VERSION',
                 '1.0')
        : null; // Application version.

/*
 * AJAX configuration.
 */
!defined('DOT_AJAX_VAR')
        ? define('DOT_AJAX_VAR',
                 'ajax')
        : null; // AJAX request variable.

/*
 * Cookie configuration.
 */
!defined('DOT_COOKIE_EXPIRE')
        ? define('DOT_COOKIE_EXPIRE',
                 0)
        : null; // Default cookie expiration time in seconds.
!defined('DOT_COOKIE_PATH')
        ? define('DOT_COOKIE_PATH',
                 '/')
        : null; // Default cookie path.
!defined('DOT_COOKIE_DOMAIN')
        ? define('DOT_COOKIE_DOMAIN',
                 '')
        : null; // Default cookie (sub)domain.
!defined('DOT_COOKIE_SECURE')
        ? define('DOT_COOKIE_SECURE',
                 false)
        : null; // Default cookie security.
!defined('DOT_COOKIE_HTTP')
        ? define('DOT_COOKIE_HTTP',
                 false)
        : null; // Default cookie HTTP access.

/*
 * Database configuration.
 */
!defined('DOT_DATABASE_TABLES_PREFIX')
        ? define('DOT_DATABASE_TABLES_PREFIX',
                 '')
        : null; // Table names prefix from the database.
!defined('DOT_DATABASE_TABLES_WP_PREFIX')
        ? define('DOT_DATABASE_TABLES_WP_PREFIX',
                 true)
        : null; // User WordPress tables names prefix from the database.
!defined('DOT_DATABASE_VERSION')
        ? define('DOT_DATABASE_VERSION',
                 1.0)
        : null; // Database version.
!defined('DOT_DATABASE_UPDATE')
        ? define('DOT_DATABASE_UPDATE',
                 false)
        : null; // Update database.

/*
 * Languages configuration.
 */
!defined('DOT_LANGUAGE_DEFAULT')
        ? define('DOT_LANGUAGE_DEFAULT',
                 'en')
        : null; // Default language.

/*
 * Security configuration.
 */
!defined('DOT_SECURITY_CIPHER')
        ? define('DOT_SECURITY_CIPHER',
                 'aes-256-ctr')
        : null; // Security encryption cipher.
!defined('DOT_SECURITY_KEY')
        ? define('DOT_SECURITY_KEY',
                 '')
        : null; // Security encryption key.
!defined('DOT_SECURITY_IV')
        ? define('DOT_SECURITY_IV',
                 '')
        : null; // Security encryption initialization vector.

/*
 * Session configuration.
 */
!defined('DOT_SESSION_COOKIE')
        ? define('DOT_SESSION_COOKIE',
                 '')
        : null; // Session cookie name. If it is blank a cookie is not going to be used.
!defined('DOT_SESSION_COOKIE_SECURE')
        ? define('DOT_SESSION_COOKIE_SECURE',
                 false)
        : null; // Session cookie security.
!defined('DOT_SESSION_COOKIE_HTTP')
        ? define('DOT_SESSION_COOKIE_HTTP',
                 false)
        : null; // Session cookie HTTP access.

/*
 * Uninstall
 */
!defined('DOT_UNINSTALL_DELETE_DATA')
        ? define('DOT_UNINSTALL_DELETE_DATA',
                 true)
        : null; // Delete all data when plugin is uninstalled.

/*
 * Upload paths.
 */
!defined('DOT_UPLOAD_PATH_IMAGES')
        ? define('DOT_UPLOAD_PATH_IMAGES',
                 'pinpoint-booking-system/images')
        : null; // Images upload folder path.

/*
 * Include the rest of the configuration files.
 */
include_once DOT_ABS_PATH.'/framework/config/config-classes.php';

include_once DOT_ABS_PATH.'/application/config/config-database.php';
include_once DOT_ABS_PATH.'/application/config/config-languages.php';
include_once DOT_ABS_PATH.'/application/config/config-views.php';