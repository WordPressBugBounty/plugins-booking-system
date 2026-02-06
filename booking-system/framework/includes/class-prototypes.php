<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-prototypes.php
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Prototypes PHP class.
 */

if (!class_exists('DOTPrototypes')){
    class DOTPrototypes{
        /*
         * Constructor
         *
         * @usage
         *      The constructor is called when a class instance is created.
         *
         * @params
         *      -
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      -
         *
         * @globals
         *      -
         *
         * @functions
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      -
         *
         * @return_details
         *      -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        function __construct(){
        }

        /*
         * Date & time.
         */

        /*
         * Returns "time ago" of a date.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->ago
         *      In FILE search for function call in hooks: array(&$this, 'ago')
         *      In PROJECT search for function call: $DOT->prototypes->ago
         *
         * @params
         *      date (string): the date, in format YYYY-MM-DD HH:MM:SS
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      -
         *
         * @globals
         *      dot_text (array): a list with language's text
         *
         * @functions
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      "Time ago" date.
         *
         * @return_details
         *      -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param string $date
         *
         * @return string
         */
        function ago($date){
            global $dot_text;

            /*
             * Set time estimate.
             */
            $time_estimate = time()-strtotime($date);

            /*
             * Set period intervals.
             */
            $time_intervals = array('year'   => 12*30*24*60*60,
                                    'month'  => 30*24*60*60,
                                    'week'   => 7*24*60*60,
                                    'day'    => 24*60*60,
                                    'hour'   => 60*60,
                                    'minute' => 60,
                                    'second' => 1);

            /*
             * Set labels.
             */
            $labels = array('ago'     => $dot_text['TIME_AGO'] ?? 'ago',
                            'year'    => $dot_text['TIME_AGO_YEAR'] ?? 'year',
                            'years'   => $dot_text['TIME_AGO_YEARS'] ?? 'years',
                            'month'   => $dot_text['TIME_AGO_MONTH'] ?? 'month',
                            'months'  => $dot_text['TIME_AGO_MONTHS'] ?? 'months',
                            'week'    => $dot_text['TIME_AGO_WEEK'] ?? 'week',
                            'weeks'   => $dot_text['TIME_AGO_WEEKS'] ?? 'weeks',
                            'day'     => $dot_text['TIME_AGO_DAY'] ?? 'day',
                            'days'    => $dot_text['TIME_AGO_DAYS'] ?? 'days',
                            'hour'    => $dot_text['TIME_AGO_HOUR'] ?? 'hour',
                            'hours'   => $dot_text['TIME_AGO_HOURS'] ?? 'hours',
                            'minute'  => $dot_text['TIME_AGO_MINUTE'] ?? 'minute',
                            'minutes' => $dot_text['TIME_AGO_MINUTES'] ?? 'minutes',
                            'second'  => $dot_text['TIME_AGO_SECOND'] ?? 'second',
                            'seconds' => $dot_text['TIME_AGO_SECONDS'] ?? 'seconds');

            /*
             * Return the first interval that is lower or equal with time estimate.
             */
            foreach ($time_intervals as $label => $seconds){
                $time_ago = $time_estimate/$seconds;

                if ($time_ago>=1){
                    $time_ago = round($time_ago);

                    return $time_ago.' '.($time_ago>1
                                    ? $labels[$label.'s']
                                    : $labels[$label]).' '.$labels['ago'];
                }
            }

            /*
             * Return if time is lower than 1 second.
             */
            return '1 '.$labels['second'].' '.$labels['ago'];
        }

        /*
         * Returns date in requested pattern.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->date
         *      In FILE search for function call in hooks: array(&$this, 'date')
         *      In PROJECT search for function call: $DOT->prototypes->date
         *
         * @params
         *      date (string): the date that will be returned, in format YYYY-MM-DD
         *      pattern (string): the pattern of the new date; the pattern contains some constants to display the date:
         *                        [DD] : day with leading zeros
         *                        [D] : day without leading zeros
         *                        [MM] : month with leading zeros
         *                        [M] : month without leading zeros
         *                        [mm] : month name
         *                        [m] : short month name
         *                        [YYYY] : the year
         *                        [YY] : short year
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      -
         *
         * @globals
         *      dot_text (array): a list with language's text
         *
         * @functions
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      The date after pattern.
         *
         * @return_details
         *      Month names are set in application translation with prefixes [MONTH_] and [MONTH_SHORT_].
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param string $date
         * @param string $pattern
         *
         * @return string
         */
        function date($date,
                      $pattern = '[DD] [mm] [YYYY]'){
            global $dot_text;

            /*
             * Default months names.
             */
            $month_names = array($dot_text['MONTH_JANUARY_JS'] ?? 'January',
                                 $dot_text['MONTH_FEBRUARY_JS'] ?? 'February',
                                 $dot_text['MONTH_MARCH_JS'] ?? 'March',
                                 $dot_text['MONTH_APRIL_JS'] ?? 'April',
                                 $dot_text['MONTH_MAY_JS'] ?? 'May',
                                 $dot_text['MONTH_JUNE_JS'] ?? 'June',
                                 $dot_text['MONTH_JULY_JS'] ?? 'July',
                                 $dot_text['MONTH_AUGUST_JS'] ?? 'August',
                                 $dot_text['MONTH_SEPTEMBER_JS'] ?? 'September',
                                 $dot_text['MONTH_OCTOBER_JS'] ?? 'October',
                                 $dot_text['MONTH_NOVEMBER_JS'] ?? 'November',
                                 $dot_text['MONTH_DECEMBER_JS'] ?? 'December');
            $month_short_names = array($dot_text['MONTH_SHORT_JANUARY_JS'] ?? 'Jan',
                                       $dot_text['MONTH_SHORT_FEBRUARY_JS'] ?? 'Feb',
                                       $dot_text['MONTH_SHORT_MARCH_JS'] ?? 'Mar',
                                       $dot_text['MONTH_SHORT_APRIL_JS'] ?? 'Apr',
                                       $dot_text['MONTH_SHORT_MAY_JS'] ?? 'May',
                                       $dot_text['MONTH_SHORT_JUNE_JS'] ?? 'Jun',
                                       $dot_text['MONTH_SHORT_JULY_JS'] ?? 'Jul',
                                       $dot_text['MONTH_SHORT_AUGUST_JS'] ?? 'Aug',
                                       $dot_text['MONTH_SHORT_SEPTEMBER_JS'] ?? 'Sep',
                                       $dot_text['MONTH_SHORT_OCTOBER_JS'] ?? 'Oct',
                                       $dot_text['MONTH_SHORT_NOVEMBER_JS'] ?? 'Nov',
                                       $dot_text['MONTH_SHORT_DECEMBER_JS'] ?? 'Dec');

            /*
             * Get date pieces.
             */
            $date_pieces = explode('-',
                                   $date);
            $day = $date_pieces[2] ?? '01';
            $month = $date_pieces[1];
            $year = $date_pieces[0];

            /*
             * Set day.
             * DD, D
             */
            $pattern = str_replace('[DD]',
                                   $day,
                                   $pattern);
            $pattern = str_replace('[D]',
                                   (int)$day,
                                   $pattern);

            /*
             * Set month.
             * MM, M, mm, m
             */
            $pattern = str_replace('[MM]',
                                   $month,
                                   $pattern);
            $pattern = str_replace('[M]',
                                   (int)$month,
                                   $pattern);
            $pattern = str_replace('[mm]',
                                   $month_names[(int)$month-1],
                                   $pattern);
            $pattern = str_replace('[m]',
                                   $month_short_names[(int)$month-1],
                                   $pattern);

            /*
             * Set year.
             * YYYY, YY
             */
            $pattern = str_replace('[YYYY]',
                                   $year,
                                   $pattern);

            return str_replace('[YY]',
                               substr($year,
                                      -2),
                               $pattern);
        }

        /*
         * Returns hour in requested pattern.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->hour
         *      In FILE search for function call in hooks: array(&$this, 'hour')
         *      In PROJECT search for function call: $DOT->prototypes->hour
         *
         * @params
         *      hour (String): the hour that will be returned, in format HH:MM
         *      pattern (String): the pattern of the new hour; the pattern contains some constants to display the date:
         *                        [HH] : hour with leading zero
         *                        [H] : hour without leading zeros
         *                        [MM] : minute with leading zeros
         *                        [M] : minute without leading zeros
         *                        [hh] : hour in AM/PM format with leading zero
         *                        [h] : hour in AM/PM format without leading zeros
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      -
         *
         * @globals
         *      -
         *
         * @functions
         *      this : leading0() // Adds a leading 0 if number smaller than 10.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      The hour after pattern.
         *
         * @return_details
         *      -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param string $hour
         * @param string $pattern
         *
         * @returns string
         */
        function hour($hour,
                      $pattern = '[HH]:[MM]'){
            $ext = '';

            /*
             * Get hour pieces.
             */
            $hour_pieces = explode(':',
                                   $hour);
            $hr = $hour_pieces[0];
            $hr_int = intval($hr);
            $min = $hour_pieces[1];
            $min_int = intval($min);

            /*
             * Set hour.
             * HH, H
             */
            $pattern = str_replace('[HH]',
                                   $hr,
                                   $pattern);
            $pattern = str_replace('[H]',
                                   $hr_int,
                                   $pattern);

            /*
             * Set minute.
             * MM, M
             */
            $pattern = str_replace('[MM]',
                                   $min,
                                   $pattern);
            $pattern = str_replace('[M]',
                                   $min_int,
                                   $pattern);

            /*
             * Set AM/PM hour.
             * hh, h
             */
            if (str_contains($pattern,
                             '[hh]')
                    || str_contains($pattern,
                                    '[h]')){
                $ext = $hr_int<12 || $hr_int == 24
                        ? 'AM'
                        : 'PM';

                if ($hr_int === 24){
                    $hr = '00';
                    $hr_int = 0;
                }
                elseif ($hr_int>12){
                    $hr_int = $hr_int-12;
                    $hr = $this->leading0($hr_int);
                }

                $pattern = str_replace('[hh]',
                                       $hr,
                                       $pattern);
                $pattern = str_replace('[h]',
                                       $hr_int,
                                       $pattern);
            }

            return $pattern.($ext !== ''
                            ? ' '.$ext
                            : '');
        }

        /*
         * Miscellaneous
         */

        /*
         * Get user IP.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->ip
         *      In FILE search for function call in hooks: array(&$this, 'ip')
         *      In PROJECT search for function call: $DOT->prototypes->ip
         *
         * @params
         *      -
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      -
         *
         * @globals
         *      -
         *
         * @functions
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      The user IP.
         *
         * @return_details
         *      -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @return string
         */
        function ip(){
            if (!empty($_SERVER['HTTP_CLIENT_IP'])){
                /*
                 * Get IP from internet.
                 */
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                /*
                 * Get IP from proxy.
                 */
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            elseif (!empty($_SERVER['REMOTE_ADDR'])){
                /*
                 * Get other IP.
                 */
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            else{
                /*
                 * No IP found.
                 */
                $ip = '';
            }

            return $ip;
        }

        /*
         * String & numbers.
         */

        /*
         * Parses a code type text to be displayed correctly.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->code
         *      In FILE search for function call in hooks: array(&$this, 'code')
         *      In PROJECT search for function call: $DOT->prototypes->code
         *
         * @params
         *      code (string): the text
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      -
         *
         * @globals
         *      -
         *
         * @functions
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      The parsed text.
         *
         * @return_details
         *      -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param string $code
         *
         * @return string
         */
        function code($code){
            return nl2br(str_replace(' ',
                                     '&nbsp;',
                                     htmlspecialchars($code)));
        }

        /*
         * Encode cURL url.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->curlEncode
         *      In FILE search for function call in hooks: array(&$this, 'curlEncode')
         *      In PROJECT search for function call: $DOT->prototypes->curlEncode
         *
         * @params
         *      url (string): current URL
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      -
         *
         * @globals
         *      -
         *
         * @functions
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Encoded URL.
         *
         * @return_details
         *      -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param string $url
         *
         * @return string
         */
        function curlEncode($url){
            /*
             * Split URL.
             */
            if (str_contains($url,
                             '?')){
                $url_get = explode('?',
                                   $url);
                $url = $url_get[0];
                $get = $url_get[1];
            }
            else{
                $get = '';
            }

            $url = explode('/',
                           $url);

            /*
             * Encode each part of the URL.
             */
            for ($i = 1; $i<count($url); $i++){
                $url[$i] = urlencode($url[$i]);
            }

            return implode('/',
                           $url)
                    .($get == ''
                            ? ''
                            : '?'.$get);
        }

        /*
         * Decrypt value.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->decrypt
         *      In FILE search for function call in hooks: array(&$this, 'decrypt')
         *      In PROJECT search for function call: $DOT->prototypes->decrypt
         *
         * @params
         *      value (mixed): value to be decrypted
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      DOT_SECURITY_CIPHER (string): Security encryption cipher.
         *      DOT_SECURITY_KEY (string): Security encryption key.
         *      DOT_SECURITY_IV (string): Security encryption initialization vector.
         *
         * @globals
         *      -
         *
         * @functions
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Decrypted value if cipher, key and initialization vector are valid, or the value otherwise.
         *
         * @return_details
         *      -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param mixed $value
         *
         * @return string
         */
        function decrypt($value){
            /*
             * Validation.
             */
            if (DOT_SECURITY_CIPHER == ''
                    || !in_array(DOT_SECURITY_CIPHER,
                                 openssl_get_cipher_methods())
                    || DOT_SECURITY_KEY == ''
                    || DOT_SECURITY_IV == ''){
                return $value;
            }

            /*
             * Decrypt value.
             */
            return openssl_decrypt($value,
                                   DOT_SECURITY_CIPHER,
                                   DOT_SECURITY_KEY,
                                   0,
                                   DOT_SECURITY_IV);
        }

        /*
         * Encrypt value.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->encrypt
         *      In FILE search for function call in hooks: array(&$this, 'encrypt')
         *      In PROJECT search for function call: $DOT->prototypes->encrypt
         *
         * @params
         *      value (mixed): value to be encrypted
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      DOT_SECURITY_CIPHER (string): Security encryption cipher.
         *      DOT_SECURITY_KEY (string): Security encryption key.
         *      DOT_SECURITY_IV (string): Security encryption initialization vector.
         *
         * @globals
         *      -
         *
         * @functions
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Encrypted value if cipher, key and initialization vector are valid, or the value otherwise.
         *
         * @return_details
         *      -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param mixed $value
         *
         * @return string
         */
        function encrypt($value){
            /*
             * Validation.
             */
            if (DOT_SECURITY_CIPHER == ''
                    || !in_array(DOT_SECURITY_CIPHER,
                                 openssl_get_cipher_methods())
                    || DOT_SECURITY_KEY == ''
                    || DOT_SECURITY_IV == ''){
                return $value;
            }

            /*
             * Encrypt value.
             */
            return openssl_encrypt($value,
                                   DOT_SECURITY_CIPHER,
                                   DOT_SECURITY_KEY,
                                   0,
                                   DOT_SECURITY_IV);
        }

        /*
         * Email validation.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->email
         *      In FILE search for function call in hooks: array(&$this, 'email')
         *      In PROJECT search for function call: $DOT->prototypes->email
         *
         * @params
         *      email (string): email to be checked
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      -
         *
         * @globals
         *      -
         *
         * @functions
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      If the email is valid "true" is returned, "false" if it's not.
         *
         * @return_details
         *      -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param string $email
         *
         * @return boolean
         */
        function email($email){
            if (preg_match("/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/i",
                           $email)){
                return true;
            }
            else{
                return false;
            }
        }

        /*
         * Adds a leading 0 if number smaller than 10.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->leading0
         *      In FILE search for function call in hooks: array(&$this, 'leading0')
         *      In PROJECT search for function call: $DOT->prototypes->leading0
         *
         * @params
         *      no (integer|string): the number
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      -
         *
         * @globals
         *      -
         *
         * @functions
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      The number with leading 0, if needed.
         *
         * @return_details
         *      -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param integer|string $no
         *
         * @returns string
         */
        function leading0($no){
            $no = (int)$no;

            return $no<10
                    ? '0'.$no
                    : (string)$no;
        }

        /*
         * Create a permalink from a string.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->permalink
         *      In FILE search for function call in hooks: array(&$this, 'permalink')
         *      In PROJECT search for function call: $DOT->prototypes->permalink
         *
         * @params
         *      string (string): the string
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      -
         *
         * @globals
         *      -
         *
         * @functions
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      The permalink slug.
         *
         * @return_details
         *      All non-alphanumeric characters are deleted; spaces [ ] and underscore [_] characters are replaced with hyphens [-].
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param string $string
         *
         * @return string
         */
        function permalink($string){
            $string = preg_replace('/[~`!¡@#$%^&*()+={}«»\[\]|\\:;"\'<,>.?\/€]/u',
                                   '',
                                   $string);
            $string = preg_replace('/ /u',
                                   '-',
                                   $string);
            $string = strtolower(preg_replace('/_/u',
                                              '-',
                                              $string));

            return strtolower($string);
        }

        /*
         * Use printf with parameters in an array.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->printfArray
         *      In FILE search for function call in hooks: array(&$this, 'printfArray')
         *      In PROJECT search for function call: $DOT->prototypes->printfArray
         *
         * @params
         *      string (string): the string to be formatted
         *      parameters (array): parameters list
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      -
         *
         * @globals
         *      -
         *
         * @functions
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      The formatted string.
         *
         * @return_details
         *      -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param string $string
         * @param array $parameters
         *
         * @return string
         */
        function printfArray($string,
                             $parameters){
            return call_user_func_array('sprintf',
                                        array_merge((array)$string,
                                                    $parameters));
        }

        /*
         * Creates a string with random characters.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->random
         *      In FILE search for function call in hooks: array(&$this, 'random')
         *      In PROJECT search for function call: $DOT->prototypes->random
         *
         * @params
         *      length (integer): the length of the returned string
         *      allowed_characters (string): the string of allowed characters; by default only alphanumeric characters are allowed
         *
         * @post
         *      -
         *
         * @get
         *      -
         *
         * @sessions
         *      -
         *
         * @cookies
         *      -
         *
         * @constants
         *      -
         *
         * @globals
         *      -
         *
         * @functions
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Random string.
         *
         * @return_details
         *      -
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param integer $length
         * @param string $allowed_characters
         *
         * @return string
         */
        function random($length,
                        $allowed_characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz'){
            $random_string = '';

            for ($i = 0; $i<$length; $i++){
                $character_position = mt_rand(1,
                                              strlen($allowed_characters))-1;
                $random_string .= $allowed_characters[$character_position];
            }

            return $random_string;
        }
    }
}