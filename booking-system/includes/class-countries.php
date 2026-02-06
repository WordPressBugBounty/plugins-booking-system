<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.1
* File                    : includes/class-countries.php
* File Version            : 1.0.1
* Created / Last Modified : 25 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Countries PHP class.
*/

if (!class_exists('DOPBSPCountries')){
    class DOPBSPCountries{
        /*
         * Countries list.
         */
        public array $countries = array();

        /*
         * Constructor
         */
        function __construct(){
            add_filter('dopbsp_filter_countries',
                       array(&$this,
                             'set'));
            add_action('init',
                       array(&$this,
                             'init'));
        }

        /*
         * Initialize countries.
         */
        function init(){
            $this->countries = apply_filters('dopbsp_filter_countries',
                                             $this->countries);
        }

        /*
         * Get country.
         *
         * @param code (string): country alpha 3 code
         * @param field (string): country field
         *
         * @return country field value
         */
        function get($code = 'USA',
                     $field = 'name'){
            $field_value = 'United States';

            for ($i = 0; $i<count($this->countries); $i++){
                if ($this->countries[$i]['code3'] == $code){
                    $field_value = $this->countries[$i][$field];
                    break;
                }
            }

            return $field_value;
        }

        /*
         * Set countries.
         *
         * @param countries (array): initial countries list
         *
         * @return countries array
         */
        function set($countries){
            $countries[] = array('code2' => 'AF',
                                 'code3' => 'AFG',
                                 'name'  => 'Afghanistan');
            $countries[] = array('code2' => 'AL',
                                 'code3' => 'ALB',
                                 'name'  => 'Albania');
            $countries[] = array('code2' => 'DZ',
                                 'code3' => 'DZA',
                                 'name'  => 'Algeria');
            $countries[] = array('code2' => 'AS',
                                 'code3' => 'ASM',
                                 'name'  => 'American Samoa');
            $countries[] = array('code2' => 'AD',
                                 'code3' => 'AND',
                                 'name'  => 'Andorra');
            $countries[] = array('code2' => 'AO',
                                 'code3' => 'AGO',
                                 'name'  => 'Angola');
            $countries[] = array('code2' => 'AI',
                                 'code3' => 'AIA',
                                 'name'  => 'Anguilla');
            $countries[] = array('code2' => 'AQ',
                                 'code3' => 'ATA',
                                 'name'  => 'Antarctica');
            $countries[] = array('code2' => 'AG',
                                 'code3' => 'ATG',
                                 'name'  => 'Antigua and Barbuda');
            $countries[] = array('code2' => 'AR',
                                 'code3' => 'ARG',
                                 'name'  => 'Argentina');
            $countries[] = array('code2' => 'AM',
                                 'code3' => 'ARM',
                                 'name'  => 'Armenia');
            $countries[] = array('code2' => 'AW',
                                 'code3' => 'ABW',
                                 'name'  => 'Aruba');
            $countries[] = array('code2' => 'AU',
                                 'code3' => 'AUS',
                                 'name'  => 'Australia');
            $countries[] = array('code2' => 'AT',
                                 'code3' => 'AUT',
                                 'name'  => 'Austria');
            $countries[] = array('code2' => 'AZ',
                                 'code3' => 'AZE',
                                 'name'  => 'Azerbaijan');
            $countries[] = array('code2' => 'BS',
                                 'code3' => 'BHS',
                                 'name'  => 'Bahamas');
            $countries[] = array('code2' => 'BH',
                                 'code3' => 'BHR',
                                 'name'  => 'Bahrain');
            $countries[] = array('code2' => 'BD',
                                 'code3' => 'BGD',
                                 'name'  => 'Bangladesh');
            $countries[] = array('code2' => 'BB',
                                 'code3' => 'BRB',
                                 'name'  => 'Barbados');
            $countries[] = array('code2' => 'BY',
                                 'code3' => 'BLR',
                                 'name'  => 'Belarus');
            $countries[] = array('code2' => 'BE',
                                 'code3' => 'BEL',
                                 'name'  => 'Belgium');
            $countries[] = array('code2' => 'BZ',
                                 'code3' => 'BLZ',
                                 'name'  => 'Belize');
            $countries[] = array('code2' => 'BJ',
                                 'code3' => 'BEN',
                                 'name'  => 'Benin');
            $countries[] = array('code2' => 'BM',
                                 'code3' => 'BMU',
                                 'name'  => 'Bermuda');
            $countries[] = array('code2' => 'BT',
                                 'code3' => 'BTN',
                                 'name'  => 'Bhutan');
            $countries[] = array('code2' => 'BO',
                                 'code3' => 'BOL',
                                 'name'  => 'Bolivia');
            $countries[] = array('code2' => 'BA',
                                 'code3' => 'BIH',
                                 'name'  => 'Bosnia and Herzegovina');
            $countries[] = array('code2' => 'BW',
                                 'code3' => 'BWA',
                                 'name'  => 'Botswana');
            $countries[] = array('code2' => 'BR',
                                 'code3' => 'BRA',
                                 'name'  => 'Brazil');
            $countries[] = array('code2' => 'IO',
                                 'code3' => 'IOT',
                                 'name'  => 'British Indian Ocean Territory');
            $countries[] = array('code2' => 'VG',
                                 'code3' => 'VGB',
                                 'name'  => 'British Virgin Islands');
            $countries[] = array('code2' => 'BN',
                                 'code3' => 'BRN',
                                 'name'  => 'Brunei');
            $countries[] = array('code2' => 'BG',
                                 'code3' => 'BGR',
                                 'name'  => 'Bulgaria');
            $countries[] = array('code2' => 'BF',
                                 'code3' => 'BFA',
                                 'name'  => 'Burkina Faso');
            $countries[] = array('code2' => 'MM',
                                 'code3' => 'MMR',
                                 'name'  => 'Burma (Myanmar)');
            $countries[] = array('code2' => 'BI',
                                 'code3' => 'BDI',
                                 'name'  => 'Burundi');
            $countries[] = array('code2' => 'KH',
                                 'code3' => 'KHM',
                                 'name'  => 'Cambodia');
            $countries[] = array('code2' => 'CM',
                                 'code3' => 'CMR',
                                 'name'  => 'Cameroon');
            $countries[] = array('code2' => 'CA',
                                 'code3' => 'CAN',
                                 'name'  => 'Canada');
            $countries[] = array('code2' => 'CV',
                                 'code3' => 'CPV',
                                 'name'  => 'Cape Verde');
            $countries[] = array('code2' => 'KY',
                                 'code3' => 'CYM',
                                 'name'  => 'Cayman Islands');
            $countries[] = array('code2' => 'CF',
                                 'code3' => 'CAF',
                                 'name'  => 'Central African Republic');
            $countries[] = array('code2' => 'TD',
                                 'code3' => 'TCD',
                                 'name'  => 'Chad');
            $countries[] = array('code2' => 'CL',
                                 'code3' => 'CHL',
                                 'name'  => 'Chile');
            $countries[] = array('code2' => 'CN',
                                 'code3' => 'CHN',
                                 'name'  => 'China');
            $countries[] = array('code2' => 'CX',
                                 'code3' => 'CXR',
                                 'name'  => 'Christmas Island');
            $countries[] = array('code2' => 'CC',
                                 'code3' => 'CCk',
                                 'name'  => 'Cocos (Keeling) Islands');
            $countries[] = array('code2' => 'CO',
                                 'code3' => 'COL',
                                 'name'  => 'Colombia');
            $countries[] = array('code2' => 'KM',
                                 'code3' => 'COM',
                                 'name'  => 'Comoros');
            $countries[] = array('code2' => 'CK',
                                 'code3' => 'COK',
                                 'name'  => 'Cook Islands');
            $countries[] = array('code2' => 'CR',
                                 'code3' => 'CRC',
                                 'name'  => 'Costa Rica');
            $countries[] = array('code2' => 'HR',
                                 'code3' => 'HRV',
                                 'name'  => 'Croatia');
            $countries[] = array('code2' => 'CU',
                                 'code3' => 'CUB',
                                 'name'  => 'Cuba');
            $countries[] = array('code2' => 'CY',
                                 'code3' => 'CYP',
                                 'name'  => 'Cyprus');
            $countries[] = array('code2' => 'CZ',
                                 'code3' => 'CZE',
                                 'name'  => 'Czech Republic');
            $countries[] = array('code2' => 'CD',
                                 'code3' => 'COD',
                                 'name'  => 'Democratic Republic of the Congo');
            $countries[] = array('code2' => 'DK',
                                 'code3' => 'DNK',
                                 'name'  => 'Denmark');
            $countries[] = array('code2' => 'DJ',
                                 'code3' => 'DJI',
                                 'name'  => 'Djibouti');
            $countries[] = array('code2' => 'DM',
                                 'code3' => 'DMA',
                                 'name'  => 'Dominica');
            $countries[] = array('code2' => 'DO',
                                 'code3' => 'DOM',
                                 'name'  => 'Dominican Republic');
            $countries[] = array('code2' => 'EC',
                                 'code3' => 'ECU',
                                 'name'  => 'Ecuador');
            $countries[] = array('code2' => 'EG',
                                 'code3' => 'EGY',
                                 'name'  => 'Egypt');
            $countries[] = array('code2' => 'SV',
                                 'code3' => 'SLV',
                                 'name'  => 'El Salvador');
            $countries[] = array('code2' => 'GQ',
                                 'code3' => 'GNQ',
                                 'name'  => 'Equatorial Guinea');
            $countries[] = array('code2' => 'ER',
                                 'code3' => 'ERI',
                                 'name'  => 'Eritrea');
            $countries[] = array('code2' => 'EE',
                                 'code3' => 'EST',
                                 'name'  => 'Estonia');
            $countries[] = array('code2' => 'ET',
                                 'code3' => 'ETH',
                                 'name'  => 'Ethiopia');
            $countries[] = array('code2' => 'FK',
                                 'code3' => 'FLK',
                                 'name'  => 'Falkland Islands');
            $countries[] = array('code2' => 'FO',
                                 'code3' => 'FRO',
                                 'name'  => 'Faroe Islands');
            $countries[] = array('code2' => 'FJ',
                                 'code3' => 'FJI',
                                 'name'  => 'Fiji');
            $countries[] = array('code2' => 'FI',
                                 'code3' => 'FIN',
                                 'name'  => 'Finland');
            $countries[] = array('code2' => 'FR',
                                 'code3' => 'FRA',
                                 'name'  => 'France');
            $countries[] = array('code2' => 'PF',
                                 'code3' => 'PYF',
                                 'name'  => 'French Polynesia');
            $countries[] = array('code2' => 'GA',
                                 'code3' => 'GAB',
                                 'name'  => 'Gabon');
            $countries[] = array('code2' => 'GM',
                                 'code3' => 'GMB',
                                 'name'  => 'Gambia');
            $countries[] = array('code2' => 'GE',
                                 'code3' => 'GEO',
                                 'name'  => 'Georgia');
            $countries[] = array('code2' => 'DE',
                                 'code3' => 'DEU',
                                 'name'  => 'Germany');
            $countries[] = array('code2' => 'GH',
                                 'code3' => 'GHA',
                                 'name'  => 'Ghana');
            $countries[] = array('code2' => 'GI',
                                 'code3' => 'GIB',
                                 'name'  => 'Gibraltar');
            $countries[] = array('code2' => 'GR',
                                 'code3' => 'GRC',
                                 'name'  => 'Greece');
            $countries[] = array('code2' => 'GL',
                                 'code3' => 'GRL',
                                 'name'  => 'Greenland');
            $countries[] = array('code2' => 'GD',
                                 'code3' => 'GRD',
                                 'name'  => 'Grenada');
            $countries[] = array('code2' => 'GU',
                                 'code3' => 'GUM',
                                 'name'  => 'Guam');
            $countries[] = array('code2' => 'GT',
                                 'code3' => 'GTM',
                                 'name'  => 'Guatemala');
            $countries[] = array('code2' => 'GN',
                                 'code3' => 'GIN',
                                 'name'  => 'Guinea');
            $countries[] = array('code2' => 'GW',
                                 'code3' => 'GNB',
                                 'name'  => 'Guinea-Bissau');
            $countries[] = array('code2' => 'GY',
                                 'code3' => 'GUY',
                                 'name'  => 'Guyana');
            $countries[] = array('code2' => 'HT',
                                 'code3' => 'HTI',
                                 'name'  => 'Haiti');
            $countries[] = array('code2' => 'VA',
                                 'code3' => 'VAT',
                                 'name'  => 'Holy See (Vatican City)');
            $countries[] = array('code2' => 'HN',
                                 'code3' => 'HND',
                                 'name'  => 'Honduras');
            $countries[] = array('code2' => 'HK',
                                 'code3' => 'HKG',
                                 'name'  => 'Hong Kong');
            $countries[] = array('code2' => 'HU',
                                 'code3' => 'HUN',
                                 'name'  => 'Hungary');
            $countries[] = array('code2' => 'IS',
                                 'code3' => 'ISL',
                                 'name'  => 'Iceland');
            $countries[] = array('code2' => 'IN',
                                 'code3' => 'IND',
                                 'name'  => 'India');
            $countries[] = array('code2' => 'ID',
                                 'code3' => 'IDN',
                                 'name'  => 'Indonesia');
            $countries[] = array('code2' => 'IR',
                                 'code3' => 'IRN',
                                 'name'  => 'Iran');
            $countries[] = array('code2' => 'IQ',
                                 'code3' => 'IRQ',
                                 'name'  => 'Iraq');
            $countries[] = array('code2' => 'IE',
                                 'code3' => 'IRL',
                                 'name'  => 'Ireland');
            $countries[] = array('code2' => 'IM',
                                 'code3' => 'IMN',
                                 'name'  => 'Isle of Man');
            $countries[] = array('code2' => 'IL',
                                 'code3' => 'ISR',
                                 'name'  => 'Israel');
            $countries[] = array('code2' => 'IT',
                                 'code3' => 'ITA',
                                 'name'  => 'Italy');
            $countries[] = array('code2' => 'CI',
                                 'code3' => 'CIV',
                                 'name'  => 'Ivory Coast');
            $countries[] = array('code2' => 'JM',
                                 'code3' => 'JAM',
                                 'name'  => 'Jamaica');
            $countries[] = array('code2' => 'JP',
                                 'code3' => 'JPN',
                                 'name'  => 'Japan');
            $countries[] = array('code2' => 'JE',
                                 'code3' => 'JEY',
                                 'name'  => 'Jersey');
            $countries[] = array('code2' => 'JO',
                                 'code3' => 'JOR',
                                 'name'  => 'Jordan');
            $countries[] = array('code2' => 'KZ',
                                 'code3' => 'KAZ',
                                 'name'  => 'Kazakhstan');
            $countries[] = array('code2' => 'KE',
                                 'code3' => 'KEN',
                                 'name'  => 'Kenya');
            $countries[] = array('code2' => 'KI',
                                 'code3' => 'KIR',
                                 'name'  => 'Kiribati');
            $countries[] = array('code2' => 'KW',
                                 'code3' => 'KWT',
                                 'name'  => 'Kuwait');
            $countries[] = array('code2' => 'KG',
                                 'code3' => 'KGZ',
                                 'name'  => 'Kyrgyzstan');
            $countries[] = array('code2' => 'LA',
                                 'code3' => 'LAO',
                                 'name'  => 'Laos');
            $countries[] = array('code2' => 'LV',
                                 'code3' => 'LVA',
                                 'name'  => 'Latvia');
            $countries[] = array('code2' => 'LB',
                                 'code3' => 'LBN',
                                 'name'  => 'Lebanon');
            $countries[] = array('code2' => 'LS',
                                 'code3' => 'LSO',
                                 'name'  => 'Lesotho');
            $countries[] = array('code2' => 'LR',
                                 'code3' => 'LBR',
                                 'name'  => 'Liberia');
            $countries[] = array('code2' => 'LY',
                                 'code3' => 'LBY',
                                 'name'  => 'Libya');
            $countries[] = array('code2' => 'LI',
                                 'code3' => 'LIE',
                                 'name'  => 'Liechtenstein');
            $countries[] = array('code2' => 'LT',
                                 'code3' => 'LTU',
                                 'name'  => 'Lithuania');
            $countries[] = array('code2' => 'LU',
                                 'code3' => 'LUX',
                                 'name'  => 'Luxembourg');
            $countries[] = array('code2' => 'MO',
                                 'code3' => 'MAC',
                                 'name'  => 'Macau');
            $countries[] = array('code2' => 'MK',
                                 'code3' => 'MKD',
                                 'name'  => 'Macedonia');
            $countries[] = array('code2' => 'MG',
                                 'code3' => 'MDG',
                                 'name'  => 'Madagascar');
            $countries[] = array('code2' => 'MW',
                                 'code3' => 'MWI',
                                 'name'  => 'Malawi');
            $countries[] = array('code2' => 'MY',
                                 'code3' => 'MYS',
                                 'name'  => 'Malaysia');
            $countries[] = array('code2' => 'MV',
                                 'code3' => 'MDV',
                                 'name'  => 'Maldives');
            $countries[] = array('code2' => 'ML',
                                 'code3' => 'MLI',
                                 'name'  => 'Mali');
            $countries[] = array('code2' => 'MT',
                                 'code3' => 'MLT',
                                 'name'  => 'Malta');
            $countries[] = array('code2' => 'MH',
                                 'code3' => 'MHL',
                                 'name'  => 'Marshall Islands');
            $countries[] = array('code2' => 'MR',
                                 'code3' => 'MRT',
                                 'name'  => 'Mauritania');
            $countries[] = array('code2' => 'MU',
                                 'code3' => 'MUS',
                                 'name'  => 'Mauritius');
            $countries[] = array('code2' => 'YT',
                                 'code3' => 'MYT',
                                 'name'  => 'Mayotte');
            $countries[] = array('code2' => 'MX',
                                 'code3' => 'MEX',
                                 'name'  => 'Mexico');
            $countries[] = array('code2' => 'FM',
                                 'code3' => 'FSM',
                                 'name'  => 'Micronesia');
            $countries[] = array('code2' => 'MD',
                                 'code3' => 'MDA',
                                 'name'  => 'Moldova');
            $countries[] = array('code2' => 'MC',
                                 'code3' => 'MCO',
                                 'name'  => 'Monaco');
            $countries[] = array('code2' => 'MN',
                                 'code3' => 'MNG',
                                 'name'  => 'Mongolia');
            $countries[] = array('code2' => 'ME',
                                 'code3' => 'MNE',
                                 'name'  => 'Montenegro');
            $countries[] = array('code2' => 'MS',
                                 'code3' => 'MSR',
                                 'name'  => 'Montserrat');
            $countries[] = array('code2' => 'MA',
                                 'code3' => 'MAR',
                                 'name'  => 'Morocco');
            $countries[] = array('code2' => 'MZ',
                                 'code3' => 'MOZ',
                                 'name'  => 'Mozambique');
            $countries[] = array('code2' => 'NA',
                                 'code3' => 'NAM',
                                 'name'  => 'Namibia');
            $countries[] = array('code2' => 'NR',
                                 'code3' => 'NRU',
                                 'name'  => 'Nauru');
            $countries[] = array('code2' => 'NP',
                                 'code3' => 'NPL',
                                 'name'  => 'Nepal');
            $countries[] = array('code2' => 'NL',
                                 'code3' => 'NLD',
                                 'name'  => 'Netherlands');
            $countries[] = array('code2' => 'AN',
                                 'code3' => 'ANT',
                                 'name'  => 'Netherlands Antilles');
            $countries[] = array('code2' => 'NC',
                                 'code3' => 'NCL',
                                 'name'  => 'New Caledonia');
            $countries[] = array('code2' => 'NZ',
                                 'code3' => 'NZL',
                                 'name'  => 'New Zealand');
            $countries[] = array('code2' => 'NI',
                                 'code3' => 'NIC',
                                 'name'  => 'Nicaragua');
            $countries[] = array('code2' => 'NE',
                                 'code3' => 'NER',
                                 'name'  => 'Niger');
            $countries[] = array('code2' => 'NG',
                                 'code3' => 'NGA',
                                 'name'  => 'Nigeria');
            $countries[] = array('code2' => 'NU',
                                 'code3' => 'NIU',
                                 'name'  => 'Niue');
            $countries[] = array('code2' => 'NF',
                                 'code3' => 'NFK',
                                 'name'  => 'Norfolk Island');
            $countries[] = array('code2' => 'KP',
                                 'code3' => 'PRK',
                                 'name'  => 'North Korea');
            $countries[] = array('code2' => 'MP',
                                 'code3' => 'MNP',
                                 'name'  => 'Northern Mariana Islands');
            $countries[] = array('code2' => 'NO',
                                 'code3' => 'NOR',
                                 'name'  => 'Norway');
            $countries[] = array('code2' => 'OM',
                                 'code3' => 'OMN',
                                 'name'  => 'Oman');
            $countries[] = array('code2' => 'PK',
                                 'code3' => 'PAK',
                                 'name'  => 'Pakistan');
            $countries[] = array('code2' => 'PW',
                                 'code3' => 'PLW',
                                 'name'  => 'Palau');
            $countries[] = array('code2' => 'PA',
                                 'code3' => 'PAN',
                                 'name'  => 'Panama');
            $countries[] = array('code2' => 'PG',
                                 'code3' => 'PNG',
                                 'name'  => 'Papua New Guinea');
            $countries[] = array('code2' => 'PY',
                                 'code3' => 'PRY',
                                 'name'  => 'Paraguay');
            $countries[] = array('code2' => 'PE',
                                 'code3' => 'PER',
                                 'name'  => 'Peru');
            $countries[] = array('code2' => 'PH',
                                 'code3' => 'PHL',
                                 'name'  => 'Philippines');
            $countries[] = array('code2' => 'PN',
                                 'code3' => 'PCN',
                                 'name'  => 'Pitcairn Islands');
            $countries[] = array('code2' => 'PL',
                                 'code3' => 'POL',
                                 'name'  => 'Poland');
            $countries[] = array('code2' => 'PT',
                                 'code3' => 'PRT',
                                 'name'  => 'Portugal');
            $countries[] = array('code2' => 'PR',
                                 'code3' => 'PRI',
                                 'name'  => 'Puerto Rico');
            $countries[] = array('code2' => 'QA',
                                 'code3' => 'QAT',
                                 'name'  => 'Qatar');
            $countries[] = array('code2' => 'CG',
                                 'code3' => 'COG',
                                 'name'  => 'Republic of the Congo');
            $countries[] = array('code2' => 'RO',
                                 'code3' => 'ROU',
                                 'name'  => 'Romania');
            $countries[] = array('code2' => 'RU',
                                 'code3' => 'RUS',
                                 'name'  => 'Russia');
            $countries[] = array('code2' => 'RW',
                                 'code3' => 'RWA',
                                 'name'  => 'Rwanda');
            $countries[] = array('code2' => 'BL',
                                 'code3' => 'BLM',
                                 'name'  => 'Saint Bartholemy');
            $countries[] = array('code2' => 'SH',
                                 'code3' => 'SHN',
                                 'name'  => 'Saint Helena');
            $countries[] = array('code2' => 'KN',
                                 'code3' => 'KNA',
                                 'name'  => 'Saint Kitts and Nevis');
            $countries[] = array('code2' => 'LC',
                                 'code3' => 'LCA',
                                 'name'  => 'Saint Lucia');
            $countries[] = array('code2' => 'MF',
                                 'code3' => 'MAF',
                                 'name'  => 'Saint Martin');
            $countries[] = array('code2' => 'PM',
                                 'code3' => 'SPM',
                                 'name'  => 'Saint Pierre and Miquelon');
            $countries[] = array('code2' => 'VC',
                                 'code3' => 'VCT',
                                 'name'  => 'Saint Vincent and the Grenadines');
            $countries[] = array('code2' => 'WS',
                                 'code3' => 'WSM',
                                 'name'  => 'Samoa');
            $countries[] = array('code2' => 'SM',
                                 'code3' => 'SMR',
                                 'name'  => 'San Marino');
            $countries[] = array('code2' => 'ST',
                                 'code3' => 'STP',
                                 'name'  => 'Sao Tome and Principe');
            $countries[] = array('code2' => 'SA',
                                 'code3' => 'SAU',
                                 'name'  => 'Saudi Arabia');
            $countries[] = array('code2' => 'SN',
                                 'code3' => 'SEN',
                                 'name'  => 'Senegal');
            $countries[] = array('code2' => 'RS',
                                 'code3' => 'SRB',
                                 'name'  => 'Serbia');
            $countries[] = array('code2' => 'SC',
                                 'code3' => 'SYC',
                                 'name'  => 'Seychelles');
            $countries[] = array('code2' => 'SL',
                                 'code3' => 'SLE',
                                 'name'  => 'Sierra Leone');
            $countries[] = array('code2' => 'SG',
                                 'code3' => 'SGP',
                                 'name'  => 'Singapore');
            $countries[] = array('code2' => 'SK',
                                 'code3' => 'SVK',
                                 'name'  => 'Slovakia');
            $countries[] = array('code2' => 'SI',
                                 'code3' => 'SVN',
                                 'name'  => 'Slovenia');
            $countries[] = array('code2' => 'SB',
                                 'code3' => 'SLB',
                                 'name'  => 'Solomon Islands');
            $countries[] = array('code2' => 'SO',
                                 'code3' => 'SOM',
                                 'name'  => 'Somalia');
            $countries[] = array('code2' => 'ZA',
                                 'code3' => 'ZAF',
                                 'name'  => 'South Africa');
            $countries[] = array('code2' => 'KR',
                                 'code3' => 'KOR',
                                 'name'  => 'South Korea');
            $countries[] = array('code2' => 'ES',
                                 'code3' => 'ESP',
                                 'name'  => 'Spain');
            $countries[] = array('code2' => 'LK',
                                 'code3' => 'LKA',
                                 'name'  => 'Sri Lanka');
            $countries[] = array('code2' => 'SD',
                                 'code3' => 'SDN',
                                 'name'  => 'Sudan');
            $countries[] = array('code2' => 'SR',
                                 'code3' => 'SUR',
                                 'name'  => 'Suriname');
            $countries[] = array('code2' => 'SJ',
                                 'code3' => 'SJM',
                                 'name'  => 'Svalbard');
            $countries[] = array('code2' => 'SZ',
                                 'code3' => 'SWZ',
                                 'name'  => 'Swaziland');
            $countries[] = array('code2' => 'SE',
                                 'code3' => 'SWE',
                                 'name'  => 'Sweden');
            $countries[] = array('code2' => 'CH',
                                 'code3' => 'CHE',
                                 'name'  => 'Switzerland');
            $countries[] = array('code2' => 'SY',
                                 'code3' => 'SYR',
                                 'name'  => 'Syria');
            $countries[] = array('code2' => 'TW',
                                 'code3' => 'TWN',
                                 'name'  => 'Taiwan');
            $countries[] = array('code2' => 'TJ',
                                 'code3' => 'TJK',
                                 'name'  => 'Tajikistan');
            $countries[] = array('code2' => 'TZ',
                                 'code3' => 'TZA',
                                 'name'  => 'Tanzania');
            $countries[] = array('code2' => 'TH',
                                 'code3' => 'THA',
                                 'name'  => 'Thailand');
            $countries[] = array('code2' => 'TL',
                                 'code3' => 'TLS',
                                 'name'  => 'Timor-Leste');
            $countries[] = array('code2' => 'TG',
                                 'code3' => 'TGO',
                                 'name'  => 'Togo');
            $countries[] = array('code2' => 'TK',
                                 'code3' => 'TKL',
                                 'name'  => 'Tokelau');
            $countries[] = array('code2' => 'TO',
                                 'code3' => 'TON',
                                 'name'  => 'Tonga');
            $countries[] = array('code2' => 'TT',
                                 'code3' => 'TTO',
                                 'name'  => 'Trinidad and Tobago');
            $countries[] = array('code2' => 'TN',
                                 'code3' => 'TUN',
                                 'name'  => 'Tunisia');
            $countries[] = array('code2' => 'TR',
                                 'code3' => 'TUR',
                                 'name'  => 'Turkey');
            $countries[] = array('code2' => 'TM',
                                 'code3' => 'TKM',
                                 'name'  => 'Turkmenistan');
            $countries[] = array('code2' => 'TC',
                                 'code3' => 'TCA',
                                 'name'  => 'Turks and Caicos Islands');
            $countries[] = array('code2' => 'TV',
                                 'code3' => 'TUV',
                                 'name'  => 'Tuvalu');
            $countries[] = array('code2' => 'UG',
                                 'code3' => 'UGA',
                                 'name'  => 'Uganda');
            $countries[] = array('code2' => 'UA',
                                 'code3' => 'UKR',
                                 'name'  => 'Ukraine');
            $countries[] = array('code2' => 'AE',
                                 'code3' => 'ARE',
                                 'name'  => 'United Arab Emirates');
            $countries[] = array('code2' => 'GB',
                                 'code3' => 'GBR',
                                 'name'  => 'United Kingdom');
            $countries[] = array('code2' => 'US',
                                 'code3' => 'USA',
                                 'name'  => 'United States');
            $countries[] = array('code2' => 'UY',
                                 'code3' => 'URY',
                                 'name'  => 'Uruguay');
            $countries[] = array('code2' => 'VI',
                                 'code3' => 'VIR',
                                 'name'  => 'US Virgin Islands');
            $countries[] = array('code2' => 'UZ',
                                 'code3' => 'UZB',
                                 'name'  => 'Uzbekistan');
            $countries[] = array('code2' => 'VU',
                                 'code3' => 'VUT',
                                 'name'  => 'Vanuatu');
            $countries[] = array('code2' => 'VE',
                                 'code3' => 'VEN',
                                 'name'  => 'Venezuela');
            $countries[] = array('code2' => 'VN',
                                 'code3' => 'VNM',
                                 'name'  => 'Vietnam');
            $countries[] = array('code2' => 'WF',
                                 'code3' => 'WLF',
                                 'name'  => 'Wallis and Futuna');
            $countries[] = array('code2' => 'EH',
                                 'code3' => 'ESH',
                                 'name'  => 'Western Sahara');
            $countries[] = array('code2' => 'YE',
                                 'code3' => 'YEM',
                                 'name'  => 'Yemen');
            $countries[] = array('code2' => 'ZM',
                                 'code3' => 'ZMB',
                                 'name'  => 'Zambia');
            $countries[] = array('code2' => 'ZW',
                                 'code3' => 'ZWE',
                                 'name'  => 'Zimbabwe');

            return $countries;
        }
    }
}