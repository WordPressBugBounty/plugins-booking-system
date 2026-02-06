<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : includes/languages/class-languages.php
* File Version            : 1.0.1
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Languages PHP class.
*/

if (!class_exists('DOPBSPLanguages')){
    class DOPBSPLanguages{
        /*
         * Languages list.
         */
        public array $languages = array();

        /*
         * Constructor
         */
        function __construct(){
            add_filter('dopbsp_filter_languages',
                       array(&$this,
                             'set'));
            add_action('init',
                       array(&$this,
                             'init'));
        }

        /*
         * Initialize languages.
         */
        function init(){
            $this->languages = apply_filters('dopbsp_filter_languages',
                                             $this->languages);
        }

        /*
         * Get language name.
         *
         * @param code (string): language code
         * @param field (string): data field
         *
         * @return field value or an error message
         */
        function get($code,
                     $field = 'name'){
            for ($i = 0; $i<count($this->languages); $i++){
                if ($this->languages[$i]['code'] == $code){
                    return $this->languages[$i][$field];
                }
            }

            return 'Invalid language code: '.$code;
        }

        /*
         * Set languages.
         *
         * @param languages (array): initial languages list
         *
         * @return languages array
         */
        function set($languages){
            $languages[] = array('code' => 'af',
                                 'name' => 'Afrikaans (Afrikaans)');
            $languages[] = array('code' => 'sq',
                                 'name' => 'Albanian (Shqiptar)');
            $languages[] = array('code' => 'ar',
                                 'name' => 'Arabic (>العربية)');
            $languages[] = array('code' => 'az',
                                 'name' => 'Azerbaijani (Azərbaycan)');
            $languages[] = array('code' => 'eu',
                                 'name' => 'Basque (Euskal)');
            $languages[] = array('code' => 'be',
                                 'name' => 'Belarusian (Беларускай)');
            $languages[] = array('code' => 'bg',
                                 'name' => 'Bulgarian (Български)');
            $languages[] = array('code' => 'ca',
                                 'name' => 'Catalan (Català)');
            $languages[] = array('code' => 'zh',
                                 'name' => 'Chinese (中国的)');
            $languages[] = array('code' => 'hr',
                                 'name' => 'Croatian (Hrvatski)');
            $languages[] = array('code' => 'cs',
                                 'name' => 'Czech (Český)');
            $languages[] = array('code' => 'da',
                                 'name' => 'Danish (Dansk)');
            $languages[] = array('code' => 'nl',
                                 'name' => 'Dutch (Nederlands)');
            $languages[] = array('code' => 'en',
                                 'name' => 'English');
            $languages[] = array('code' => 'eo',
                                 'name' => 'Esperanto (Esperanto)');
            $languages[] = array('code' => 'et',
                                 'name' => 'Estonian (Eesti)');
            $languages[] = array('code' => 'fl',
                                 'name' => 'Filipino (na Filipino)');
            $languages[] = array('code' => 'fi',
                                 'name' => 'Finnish (Suomi)');
            $languages[] = array('code' => 'fr',
                                 'name' => 'French (Français)');
            $languages[] = array('code' => 'gl',
                                 'name' => 'Galician (Galego)');
            $languages[] = array('code' => 'de',
                                 'name' => 'German (Deutsch)');
            $languages[] = array('code' => 'el',
                                 'name' => 'Greek (Ɛλληνικά)');
            $languages[] = array('code' => 'ht',
                                 'name' => 'Haitian Creole (Kreyòl Ayisyen)');
            $languages[] = array('code' => 'he',
                                 'name' => 'Hebrew (עברית)');
            $languages[] = array('code' => 'hi',
                                 'name' => 'Hindi (हिंदी)');
            $languages[] = array('code' => 'hu',
                                 'name' => 'Hungarian (Magyar)');
            $languages[] = array('code' => 'is',
                                 'name' => 'Icelandic (Íslenska)');
            $languages[] = array('code' => 'id',
                                 'name' => 'Indonesian (Indonesia)');
            $languages[] = array('code' => 'ga',
                                 'name' => 'Irish (Gaeilge)');
            $languages[] = array('code' => 'it',
                                 'name' => 'Italian (Italiano)');
            $languages[] = array('code' => 'ja',
                                 'name' => 'Japanese (日本の)');
            $languages[] = array('code' => 'ko',
                                 'name' => 'Korean (한국의)');
            $languages[] = array('code' => 'lv',
                                 'name' => 'Latvian (Latvijas)');
            $languages[] = array('code' => 'lt',
                                 'name' => 'Lithuanian (Lietuvos)');
            $languages[] = array('code' => 'mk',
                                 'name' => 'Macedonian (македонски)');
            $languages[] = array('code' => 'ms',
                                 'name' => 'Malay (Melayu)');
            $languages[] = array('code' => 'mt',
                                 'name' => 'Maltese (Maltija)');
            $languages[] = array('code' => 'no',
                                 'name' => 'Norwegian (Norske)');
            $languages[] = array('code' => 'fa',
                                 'name' => 'Persian (فارسی)');
            $languages[] = array('code' => 'pl',
                                 'name' => 'Polish (Polski)');
            $languages[] = array('code' => 'pt',
                                 'name' => 'Portuguese (Português)');
            $languages[] = array('code' => 'ro',
                                 'name' => 'Romanian (Română)');
            $languages[] = array('code' => 'ru',
                                 'name' => 'Russian (Pусский)');
            $languages[] = array('code' => 'sr',
                                 'name' => 'Serbian (Cрпски)');
            $languages[] = array('code' => 'sk',
                                 'name' => 'Slovak (Slovenských)');
            $languages[] = array('code' => 'sl',
                                 'name' => 'Slovenian (Slovenski)');
            $languages[] = array('code' => 'es',
                                 'name' => 'Spanish (Español)');
            $languages[] = array('code' => 'sw',
                                 'name' => 'Swahili (Kiswahili)');
            $languages[] = array('code' => 'sv',
                                 'name' => 'Swedish (Svenskt)');
            $languages[] = array('code' => 'th',
                                 'name' => 'Thai (ภาษาไทย)');
            $languages[] = array('code' => 'tr',
                                 'name' => 'Turkish (Türk)');
            $languages[] = array('code' => 'uk',
                                 'name' => 'Ukrainian (Український)');
            $languages[] = array('code' => 'ur',
                                 'name' => 'Urdu (اردو)');
            $languages[] = array('code' => 'vi',
                                 'name' => 'Vietnamese (Việt)');
            $languages[] = array('code' => 'cy',
                                 'name' => 'Welsh (Cymraeg)');
            $languages[] = array('code' => 'yi',
                                 'name' => 'Yiddish (ייִדיש)');

            return $languages;
        }
    }
}