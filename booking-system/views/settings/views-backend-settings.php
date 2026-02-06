<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.3
* File                    : views/settings/views-backend-settings.php
* File Version            : 1.1.9
* Created / Last Modified : 14 December 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end settings views class.
*/

if (!class_exists('DOPBSPViewsBackEndSettings')){
    class DOPBSPViewsBackEndSettings extends DOPBSPViewsBackEnd{
        /*
         * Returns settings template.
         *
         * @param args (array): function arguments
         *
         * @return settings HTML page
         */
        function template($args = array()){
            global $DOPBSP;
            global $DOT;

            $this->getTranslation();
            ?>
            <div class="wrap DOPBSP-admin">

                <!--
                    Header
                -->
                <?php $this->displayHeader($DOPBSP->text('TITLE'),
                                           $DOPBSP->text('SETTINGS_TITLE')); ?>

                <!--
                    Content
                -->
                <div class="dopbsp-main">
                    <table class="dopbsp-content-wrapper">
                        <colgroup>
                            <col id="DOPBSP-col-column1" class="dopbsp-column1" />
                            <col id="DOPBSP-col-column-separator1" class="dopbsp-separator" />
                            <col id="DOPBSP-col-column2" class="dopbsp-column2" />
                        </colgroup>
                        <tbody>
                            <tr>
                                <td class="dopbsp-column" id="DOPBSP-column1">
                                    <div class="dopbsp-column-header">
                                        <a href="<?php $DOT->echo(DOPBSP_CONFIG_HELP_DOCUMENTATION_URL,
                                                                  'url'); ?>" target="_blank" class="dopbsp-button dopbsp-help">
                                            <span class="dopbsp-info dopbsp-help">
                                                <?php $DOT->echo($DOPBSP->text('SETTINGS_HELP')); ?>
                                                <br /><br />
                                                <?php $DOT->echo($DOPBSP->text('HELP_VIEW_DOCUMENTATION')); ?>
                                            </span>
                                        </a>
                                        <br class="dopbsp-clear" />
                                    </div>
                                    <div class="dopbsp-column-content">
                                        <ul>
                                            <li class="dopbsp-settings-item dopbsp-settings" onclick="DOPBSPBackEndSettings.displaySettings(0)">
                                                <div class="dopbsp-icon"></div>
                                                <div class="dopbsp-title"><?php $DOT->echo($DOPBSP->text('SETTINGS_GENERAL_TITLE')); ?></div>
                                            </li>
                                            <li class="dopbsp-settings-item dopbsp-users" onclick="DOPBSPBackEndSettingsUsers.display(0)">
                                                <div class="dopbsp-icon"></div>
                                                <div class="dopbsp-title"><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_TITLE')); ?></div>
                                            </li>
                                            <li class="dopbsp-settings-item dopbsp-licences" onclick="DOPBSPBackEndSettingsLicences.display(0)">
                                                <div class="dopbsp-icon"></div>
                                                <div class="dopbsp-title"><?php $DOT->echo($DOPBSP->text('SETTINGS_LICENCES_TITLE')); ?></div>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td id="DOPBSP-column-separator1" class="dopbsp-separator"></td>
                                <td id="DOPBSP-column2" class="dopbsp-column">
                                    <div class="dopbsp-column-header">&nbsp;</div>
                                    <div class="dopbsp-column-content">&nbsp;</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        }

        /*
         * Form inputs.
         */
        /*
         * Create a drop-down (select) field for settings.
         *
         * @param args (array): function arguments
         *                      * id (integer): field ID
         *                      * label (string): field label
         *                      * value (string): field current value
         *                      * settings_id (integer): calendar/search ID
         *                      * settings_type (string): settings type
         *                      * help (string): field help
         *                      * options (string): options labels
         *                      * options_values (string): options values
         *                      * container_class (string): container class
         *
         * @return drop down HTML
         */
        function displaySelectInput($args = array()){
            global $DOPBSP;
            global $DOT;

            $id = $args['id'];
            $label = $args['label'];
            $value = $args['value'];
            $settings_id = $args['settings_id'];
            $settings_type = $args['settings_type'];
            $help = $args['help'];
            $options = $args['options'];
            $options_values = $args['options_values'];
            $container_class = $args['container_class'] ?? '';

            $html = array();
            $options_data = explode(';;',
                                    $options);
            $options_values_data = explode(';;',
                                           $options_values);

            $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
            $html[] = '     <label for="DOPBSP-settings-'.$id.'">'.$label.'</label>';
            $html[] = '     <select name="DOPBSP-settings-'.$id.'" id="DOPBSP-settings-'.$id.'" class="dopbsp-left" onchange="DOPBSPBackEndSettings.set('.$settings_id.', \''.$settings_type.'\', \'select\', \''.$id.'\')">';

            for ($i = 0; $i<count($options_data); $i++){
                if ($value == $options_values_data[$i]){
                    $html[] = '     <option value="'.$options_values_data[$i].'" selected="selected">'.$options_data[$i].'</option>';
                }
                else{
                    $html[] = '     <option value="'.$options_values_data[$i].'">'.$options_data[$i].'</option>';
                }
            }
            $html[] = '     </select>';
            $html[] = '     <script type="text/JavaScript">jQuery(\'#DOPBSP-settings-'.$id.'\').DOPSelect();</script>';
            $html[] = '     <a href="'.DOPBSP_CONFIG_HELP_DOCUMENTATION_URL.'" target="_blank" class="dopbsp-button dopbsp-help"><span class="dopbsp-info dopbsp-help">'.$help.'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION').'</span></a>';
            $html[] = ' </div>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->select());
        }

        /*
         * Create a drop-down (select) field for settings.
         *
         * @param args (array): function arguments
         *                      * id (integer): field ID
         *                      * label (string): field label
         *                      * value (string): field current value
         *                      * settings_id (integer): calendar/search ID
         *                      * settings_type (string): settings type
         *                      * help (string): field help
         *                      * options (string): options labels
         *                      * options_values (string): options values
         *                      * container_class (string): container class
         *
         * @return drop down HTML
         */
        function displayPhones($args = array()){
            global $DOPBSP;
            global $DOT;

            $id = $args['id'];
            $label = $args['label'];
            $value = $args['value'];
            $settings_id = $args['settings_id'];
            $settings_type = $args['settings_type'];
            $help = $args['help'];
            $options = $args['options'];
            $options_values = $args['options_values'];
            $container_class = $args['container_class'] ?? '';

            $html = array();
            $options_data = explode(';;',
                                    $options);
            $options_values_data = explode(';;',
                                           $options_values);

            if ($value != ''){
                $value = stripslashes($value);
                $phones = json_decode($value);
                $phones = (array)$phones;
            }
            else{
                $phones = array(array('phone' => '',
                                      'code'  => ''));

                $value = json_encode($phones);
            }
            $value = str_replace('"',
                                 "'",
                                 $value);
            $html[] = '     <input id="DOPBSP-settings-'.$id.'" class="dopbsp-phones" type="hidden" value="'.$value.'"/>';
            $html[] = '     <input id="DOPBSP-settings-'.$id.'-options" type="hidden" value="'.$options.'"/>';
            $html[] = '     <input id="DOPBSP-settings-'.$id.'-options_values" class="dopbsp-phones" type="hidden" value="'.$options_values.'"/>';
            $html[] = '     <input id="DOPBSP-settings-'.$id.'-help" type="hidden" value="'.$help.'"/>';

            $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
            $html[] = '     <label for="DOPBSP-settings-'.$id.'">'.$label.'</label>';
            $html[] = '         <div class="dopbsp-phone-wrapper">';
            foreach ($phones as $key => $phone){
                $phones[$key] = (array)$phone;
                $html[] = '     <div class="dopbsp-phone-wrapper">';
                $html[] = '         <select name="DOPBSP-settings-'.$id.'-'.$key.'" id="DOPBSP-settings-'.$id.'-'.$key.'" class="dopbsp-phone dopbsp-left" onchange="DOPBSPBackEndSettings.set('.$settings_id.', \''.$settings_type.'\', \'select\', \''.$id.'-'.$key.'\')">';

                for ($i = 0; $i<count($options_data); $i++){
                    if ($phones[$key]['code'] == $options_values_data[$i]){
                        $html[] = '     <option value="'.$options_values_data[$i].'" selected="selected">'.$options_data[$i].'</option>';
                    }
                    else{
                        $html[] = '     <option value="'.$options_values_data[$i].'">'.$options_data[$i].'</option>';
                    }
                }
                $html[] = '         </select>';
                $html[] = '         <input type="text" name="DOPBSP-settings-'.$id.'-'.$key.'" id="DOPBSP-settings-'.$id.'-'.$key.'" class="dopbsp-phone-input" value="'.$phones[$key]['phone'].'" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndSettings.set('.$settings_id.', \''.$settings_type.'\', \'text\', \''.$id.'-'.$key.'\', this.value);}" onpaste="DOPBSPBackEndSettings.set('.$settings_id.', \''.$settings_type.'\', \'text\', \''.$id.'-'.$key.'\', this.value)" onblur="DOPBSPBackEndSettings.set('.$settings_id.', \''.$settings_type.'\', \'text\', \''.$id.'-'.$key.'\', this.value, true)" />';
                $html[] = '         <script>jQuery(\'#DOPBSP-settings-'.$id.'-'.$key.'\').DOPSelect();</script>';
                $html[] = '         <a href="'.DOPBSP_CONFIG_HELP_DOCUMENTATION_URL.'" target="_blank" class="dopbsp-button dopbsp-help"><span class="dopbsp-info dopbsp-help">'.$help.'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION').'</span></a>';

                if ($key == count($phones)-1){
                    $html[] = '         <a href="javascript:DOPBSPBackEndSettingsNotifications.phoneAdd('.$key.','.$settings_id.');" id="DOPBSP-settings-'.$id.'-add-'.$key.'-'.$settings_id.'" class="dopbsp-button dopbsp-help dopbsp-phone dopbsp-phone-add dopbsp-add"><span class="dopbsp-info dopbsp-help">'.$DOPBSP->text('SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_ADMIN_PHONE_ADD_HELP').'</span></a>';
                }
                $html[] = '     </div>';
            }
            $html[] = '     </div>';
            $html[] = ' </div>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       array_merge($DOT->models->allowed_html->input(),
                                   $DOT->models->allowed_html->select()));
        }

        /*
         * Create a switch field for settings.
         *
         * @param args (array): function arguments
         *                      * id (integer): field ID
         *                      * label (string): field label
         *                      * value (string): field current value
         *                      * settings_id (integer): calendar/search ID
         *                      * settings_type (string): settings type
         *                      * help (string): field help
         *                      * container_class (string): container class
         *
         * @return switch HTML
         */
        function displaySwitchInput($args = array()){
            global $DOPBSP;
            global $DOT;

            $id = $args['id'];
            $label = $args['label'];
            $value = $args['value'];
            $settings_id = $args['settings_id'];
            $settings_type = $args['settings_type'];
            $help = $args['help'];
            $container_class = $args['container_class'] ?? '';

            $html = array();

            $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
            $html[] = '     <label class="dopbsp-for-switch">'.$label.'</label>';
            $html[] = '     <div class="dopbsp-switch">';
            $html[] = '         <input type="checkbox" name="DOPBSP-settings-'.$id.'" id="DOPBSP-settings-'.$id.'" class="dopbsp-switch-checkbox" onchange="DOPBSPBackEndSettings.set('.$settings_id.', \''.$settings_type.'\', \'switch\', \''.$id.'\')"'.($value == 'true'
                            ? ' checked="checked"'
                            : '').' />';
            $html[] = '         <label class="dopbsp-switch-label" for="DOPBSP-settings-'.$id.'">';
            $html[] = '             <div class="dopbsp-switch-inner"></div>';
            $html[] = '             <div class="dopbsp-switch-switch"></div>';
            $html[] = '         </label>';
            $html[] = '     </div>';
            $html[] = '     <a href="'.DOPBSP_CONFIG_HELP_DOCUMENTATION_URL.'" target="_blank" class="dopbsp-button dopbsp-help dopbsp-switch-help"><span class="dopbsp-info dopbsp-help">'.$help.'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION').'</span></a>';
            $html[] = ' </div>';
            $html[] = ' <style type="text/css">';
            $html[] = '     .DOPBSP-admin .dopbsp-input-wrapper .dopbsp-switch .dopbsp-switch-inner:before{content: "'.$DOPBSP->text('SETTINGS_ENABLED').'";}';
            $html[] = '     .DOPBSP-admin .dopbsp-input-wrapper .dopbsp-switch .dopbsp-switch-inner:after{content: "'.$DOPBSP->text('SETTINGS_DISABLED').'";}';
            $html[] = ' </style>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->input());
        }

        /*
         * Create a text input field for settings.
         *
         * @param args (array): function arguments
         *                      * id (integer): field ID
         *                      * label (string): field label
         *                      * value (string): field current value
         *                      * settings_id (integer): calendar/search ID
         *                      * settings_type (string): settings type
         *                      * help (string): field help
         *                      * container_class (string): container class
         *                      * input_class (string): input class
         *                      * is_password (boolean): set input type to password
         *
         * @return text input HTML
         */
        function displayTextInput($args = array()){
            global $DOPBSP;
            global $DOT;

            $id = $args['id'];
            $label = $args['label'];
            $value = $args['value'];
            $settings_id = $args['settings_id'];
            $settings_type = $args['settings_type'];
            $help = $args['help'];
            $container_class = $args['container_class'] ?? '';
            $input_class = $args['input_class'] ?? '';
            $is_password = $args['is_password'] ?? false;

            $html = array();

            $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
            $html[] = '     <label for="DOPBSP-settings-'.$id.'">'.$label.'</label>';

            if (str_contains($container_class,
                             'dopbsp-disabled')){
                $html[] = '     <input type="'.($is_password
                                ? 'password'
                                : 'text').'" name="DOPBSP-settings-'.$id.'" id="DOPBSP-settings-'.$id.'" class="'.$input_class.'" value="'.$value.'" readonly="true" />';
            }
            else{
                $html[] = '     <input type="'.($is_password
                                ? 'password'
                                : 'text').'" name="DOPBSP-settings-'.$id.'" id="DOPBSP-settings-'.$id.'" class="'.$input_class.'" value="'.$value.'" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndSettings.set('.$settings_id.', \''.$settings_type.'\', \'text\', \''.$id.'\', this.value);}" onpaste="DOPBSPBackEndSettings.set('.$settings_id.', \''.$settings_type.'\', \'text\', \''.$id.'\', this.value)" onblur="DOPBSPBackEndSettings.set('.$settings_id.', \''.$settings_type.'\', \'text\', \''.$id.'\', this.value, true)" />';
            }
            $html[] = '     <a href="'.DOPBSP_CONFIG_HELP_DOCUMENTATION_URL.'" target="_blank" class="dopbsp-button dopbsp-help"><span class="dopbsp-info dopbsp-help">'.$help.'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION').'</span></a>';
            $html[] = ' </div>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->input());
        }

        /*
         * Create textarea field for settings.
         *
         * @param args (array): function arguments
         *                      * id (integer): field ID
         *                      * label (string): field label
         *                      * value (string): field current value
         *                      * settings_id (integer): calendar/search ID
         *                      * settings_type (string): settings type
         *                      * help (string): field help
         *                      * container_class (string): container class
         *
         * @return textarea HTML
         */
        function displayTextarea($args = array()){
            global $DOPBSP;
            global $DOT;

            $id = $args['id'];
            $label = $args['label'];
            $value = $args['value'];
            $settings_id = $args['settings_id'];
            $settings_type = $args['settings_type'];
            $help = $args['help'];
            $container_class = $args['container_class'] ?? '';

            $html = array();

            $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
            $html[] = '     <label for="DOPBSP-settings-'.$id.'">'.$label.'</label>';
            $html[] = '     <textarea name="DOPBSP-settings-'.$id.'" id="DOPBSP-settings-'.$id.'" rows="5" cols="" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndSettings.set('.$settings_id.', \''.$settings_type.'\', \'textarea\', \''.$id.'\', this.value)}" onpaste="DOPBSPBackEndSettings.set('.$settings_id.', \''.$settings_type.'\', \'textarea\', \''.$id.'\', this.value)" onblur="DOPBSPBackEndSettings.set('.$settings_id.', \''.$settings_type.'\', \'textarea\', \''.$id.'\', this.value, true)">'.$value.'</textarea>';
            $html[] = '     <a href="'.DOPBSP_CONFIG_HELP_DOCUMENTATION_URL.'" target="_blank" class="dopbsp-button dopbsp-help"><span class="dopbsp-info dopbsp-help">'.$help.'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION').'</span></a>';
            $html[] = ' </div>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->textarea());
        }

        /*
         * Single lists.
         */

        /*
         * Get coupons list.
         *
         * @param type (string): type of list to be displayed (ids or labels)
         *
         * @return a string with the coupons
         */
        function listCoupons($type = 'ids'){
            global $wpdb;
            global $DOPBSP;

            $result = array();

            if ($type == 'ids'){
                $result[] = '0';
            }
            else{
                $result[] = $DOPBSP->text('SETTINGS_CALENDAR_COUPONS_NONE');
            }

            if ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                     'view-all-calendars')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $coupons = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id ASC',
                                                             $DOPBSP->tables->coupon));
            }
            elseif ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                         'use-booking-system')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $coupons = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id ASC',
                                                             $DOPBSP->tables->coupons,
                                                             wp_get_current_user()->ID));
            }

            if ($wpdb->num_rows != 0){
                foreach ($coupons as $coupon){
                    if ($type == 'ids'){
                        $result[] = $coupon->id;
                    }
                    else{
                        $result[] = $coupon->id.': '.$coupon->name;
                    }
                }
            }

            return implode(';;',
                           $result);
        }

        /*
         * Get currencies list.
         *
         * @param type (string): type of list to be displayed (ids or labels)
         *
         * @return a string with the currencies
         */
        function listCurrencies($type = 'ids'){
            global $DOPBSP;

            $currencies = $DOPBSP->classes->currencies->currencies;
            $result = array();

            for ($i = 0; $i<count($currencies); $i++){
                if ($type == 'ids'){
                    $result[] = $currencies[$i]['code'];
                }
                else{
                    $result[] = $currencies[$i]['name'].' ('.$currencies[$i]['sign'].', '.$currencies[$i]['code'].')';
                }
            }

            return implode(';;',
                           $result);
        }

        /*
         * Get discounts list.
         *
         * @param type (string): type of list to be displayed (ids or labels)
         *
         * @return a string with the discounts
         */
        function listDiscounts($type = 'ids'){
            global $wpdb;
            global $DOPBSP;

            $result = array();

            if ($type == 'ids'){
                $result[] = '0';
            }
            else{
                $result[] = $DOPBSP->text('SETTINGS_CALENDAR_DISCOUNTS_NONE');
            }

            if ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                     'view-all-calendars')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $discounts = $wpdb->get_results($wpdb->prepare('SELECT * FROM  %i ORDER BY id ASC',
                                                               $DOPBSP->tables->discounts));
            }
            elseif ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                         'use-booking-system')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $discounts = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id ASC',
                                                               $DOPBSP->tables->discounts,
                                                               wp_get_current_user()->ID));
            }

            if ($wpdb->num_rows != 0){
                foreach ($discounts as $discount){
                    if ($type == 'ids'){
                        $result[] = $discount->id;
                    }
                    else{
                        $result[] = $discount->id.': '.$discount->name;
                    }
                }
            }

            return implode(';;',
                           $result);
        }

        /*
         * Get emails list.
         *
         * @param type (string): type of list to be displayed (ids or labels)
         *
         * @return a string with the emails
         */
        function listEmails($type = 'ids'){
            global $wpdb;
            global $DOPBSP;

            $result = array();

            if ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                     'view-all-calendars')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $emails = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id ASC',
                                                            $DOPBSP->tables->emails));
            }
            elseif ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                         'use-booking-system')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $emails = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id ASC',
                                                            $DOPBSP->tables->emails,
                                                            wp_get_current_user()->ID));
            }

            if ($wpdb->num_rows != 0){
                foreach ($emails as $email){
                    if ($type == 'ids'){
                        $result[] = $email->id;
                    }
                    else{
                        $result[] = $email->id.': '.$email->name;
                    }
                }
                return implode(';;',
                               $result);
            }
            else{
                return '';
            }
        }

        /*
        * Get SMS list.
        *
        * @param type (string): type of list to be displayed (ids or labels)
        *
        * @return a string with the SMSes
        */
        function listSMSes($type = 'ids'){
            global $wpdb;
            global $DOPBSP;

            $result = array();

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $smses = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id ASC',
                                                       $DOPBSP->tables->smses));

            if ($wpdb->num_rows != 0){
                foreach ($smses as $sms){
                    if ($type == 'ids'){
                        $result[] = $sms->id;
                    }
                    else{
                        $result[] = $sms->id.': '.$sms->name;
                    }
                }
                return implode(';;',
                               $result);
            }
            else{
                return '';
            }
        }

        /*
         * Get extras list.
         *
         * @param type (string): type of list to be displayed (ids or labels)
         *
         * @return HTML with the extras
         */
        function listExtras($type = 'ids'){
            global $wpdb;
            global $DOPBSP;

            $result = array();

            if ($type == 'ids'){
                $result[] = '0';
            }
            else{
                $result[] = $DOPBSP->text('SETTINGS_CALENDAR_EXTRAS_NONE');
            }

            if ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                     'view-all-calendars')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $extras = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id ASC',
                                                            $DOPBSP->tables->extras));
            }
            elseif ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                         'use-booking-system')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $extras = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id ASC',
                                                            $DOPBSP->tables->extras,
                                                            wp_get_current_user()->ID));
            }

            if ($wpdb->num_rows != 0){
                foreach ($extras as $extra){
                    if ($type == 'ids'){
                        $result[] = $extra->id;
                    }
                    else{
                        $result[] = $extra->id.': '.$extra->name;
                    }
                }
                return implode(';;',
                               $result);
            }
            else{
                return '';
            }
        }

        /*
         * Get forms list.
         *
         * @param type (string): type of list to be displayed (ids or labels)
         *
         * @return a string with the forms
         */
        function listForms($type = 'ids'){
            global $wpdb;
            global $DOPBSP;

            $result = array();

            if ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                     'view-all-calendars')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $forms = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id ASC',
                                                           $DOPBSP->tables->forms));
            }
            elseif ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                         'use-booking-system')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $forms = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id ASC',
                                                           $DOPBSP->tables->forms,
                                                           wp_get_current_user()->ID));
            }

            if ($wpdb->num_rows != 0){
                foreach ($forms as $form){
                    if ($type == 'ids'){
                        $result[] = $form->id;
                    }
                    else{
                        $result[] = $form->id.': '.$form->name;
                    }
                }
            }

            return implode(';;',
                           $result);
        }

        /*
         * Get rules list.
         *
         * @param type (string): type of list to be displayed (ids or labels)
         *
         * @return HTML with the extras
         */
        function listRules($type = 'ids'){
            global $wpdb;
            global $DOPBSP;

            $result = array();

            if ($type == 'ids'){
                $result[] = '0';
            }
            else{
                $result[] = $DOPBSP->text('SETTINGS_CALENDAR_RULES_NONE');
            }

            if ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                     'view-all-calendars')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $rules = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id ASC',
                                                           $DOPBSP->tables->rules));
            }
            elseif ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                         'use-booking-system')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $rules = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id ASC',
                                                           $DOPBSP->tables->rules,
                                                           wp_get_current_user()->ID));
            }

            if ($wpdb->num_rows != 0){
                foreach ($rules as $rule){
                    if ($type == 'ids'){
                        $result[] = $rule->id;
                    }
                    else{
                        $result[] = $rule->id.': '.$rule->name;
                    }
                }
                return implode(';;',
                               $result);
            }
            else{
                return '';
            }
        }

        /*
         * Get templates list.
         *
         * @return a string with the templates
         */
        function listTemplates(){
            global $DOPBSP;

            // Load templates from Pinpoint
            $folder = $DOPBSP->paths->abs.'templates/';
            $list = array();

            if (file_exists($folder)){
                $folderData = opendir($folder);

                while (($file = readdir($folderData)) !== false){
                    if ($file != '.'
                            && $file != '..'
                            && $file != '.DS_Store'){
                        $list[] = $file;
                    }
                }
                closedir($folderData);
            }

            $folder = WP_CONTENT_DIR.'/dopbsp-templates';

            file_exists($folder);

            if (file_exists($folder)){
                $folderData = opendir($folder);

                while (($file = readdir($folderData)) !== false){
                    if ($file != '.'
                            && $file != '..'
                            && $file != '.DS_Store'
                            && !in_array($file,
                                         $list)){
                        $list[] = $file;
                    }
                }
                closedir($folderData);
            }

            return implode(';;',
                           $list);
        }

        /*
         * Multiple lists.
         */
        /*
         * Get fees multiple list.
         *
         * @param args (array): function arguments
         *                      * label (string): field label
         *                      * value (string): field current value
         *                      * settings_id (integer): settings ID
         *                      * settings_type (string): settings type
         *                      * help (string): field help
         *                      * container_class (string): container class
         *
         * @return HTML with the fees
         */
        function multipleFees($args){
            global $wpdb;
            global $DOPBSP;

            $label = $args['label'];
            $value = $args['value'];
            $settings_id = $args['settings_id'];
            $settings_type = $args['settings_type'];
            $help = $args['help'];
            $container_class = $args['container_class'] ?? '';

            $html = array();
            $html_checkboxes = array();

            if ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                     'view-all-calendars')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $fees = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id ASC',
                                                          $DOPBSP->tables->fees));
            }
            elseif ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                         'use-booking-system')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $fees = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id ASC',
                                                          $DOPBSP->tables->fees,
                                                          wp_get_current_user()->ID));
            }

            if ($wpdb->num_rows != 0){
                $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
                $html[] = '     <label class="dopbsp-for-checkboxes">'.$label.'</label>';
                $html[] = '     <div class="dopbsp-checkboxes-wrapper" id="DOPBSP-settings-fees">';

                foreach ($fees as $fee){
                    $html_checkbox = array();
                    $html_checkbox[] = '<input type="checkbox" name="DOPBSP-settings-fee'.$fee->id.'" id="DOPBSP-settings-fee'.$fee->id.'"'.(strrpos(','.$value.',',
                                                                                                                                                     ','.$fee->id.',') === false
                                    ? ''
                                    : ' checked="checked"').' onclick="DOPBSPBackEndSettings.set(\''.$settings_id.'\', \''.$settings_type.'\', \'checkbox\', \'fees\')" />';
                    $html_checkbox[] = '<label class="dopbsp-for-checkbox" for="DOPBSP-settings-fee'.$fee->id.'">'.$fee->name.'</label>';
                    $html_checkboxes[] = implode('',
                                                 $html_checkbox);
                }
                $html[] = implode('<br class="dopbsp-clear" />',
                                  $html_checkboxes);
                $html[] = '     </div>';
                $html[] = '     <a href="'.DOPBSP_CONFIG_HELP_DOCUMENTATION_URL.'" target="_blank" class="dopbsp-button dopbsp-help"><span class="dopbsp-info dopbsp-help">'.$help.'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION').'</span></a>';
                $html[] = ' </div>';
            }

            return implode('',
                           $html);
        }

        /*
         * Get coupons multiple list.
         *
         * @param args (array): function arguments
         *                      * label (string): field label
         *                      * value (string): field current value
         *                      * settings_id (integer): settings ID
         *                      * settings_type (string): settings type
         *                      * help (string): field help
         *                      * container_class (string): container class
         *
         * @return HTML with the coupons
         */
        function multipleCoupons($args){
            global $wpdb;
            global $DOPBSP;

            $label = $args['label'];
            $value = $args['value'];
            $settings_id = $args['settings_id'];
            $settings_type = $args['settings_type'];
            $help = $args['help'];
            $container_class = $args['container_class'] ?? '';

            $html = array();
            $html_checkboxes = array();

            if ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                     'view-all-calendars')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $coupons = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id ASC',
                                                             $DOPBSP->tables->coupons));
            }
            elseif ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                         'use-booking-system')){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $coupons = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id ASC',
                                                             $DOPBSP->tables->coupons,
                                                             wp_get_current_user()->ID));
            }

            if ($wpdb->num_rows != 0){
                $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
                $html[] = '     <label class="dopbsp-for-checkboxes">'.$label.'</label>';
                $html[] = '     <div class="dopbsp-checkboxes-wrapper" id="DOPBSP-settings-coupons">';

                foreach ($coupons as $coupon){
                    $html_checkbox = array();
                    $html_checkbox[] = '<input type="checkbox" name="DOPBSP-settings-coupon'.$coupon->id.'" id="DOPBSP-settings-coupon'.$coupon->id.'"'.(strrpos(','.$value.',',
                                                                                                                                                                 ','.$coupon->id.',') === false
                                    ? ''
                                    : ' checked="checked"').' onclick="DOPBSPBackEndSettings.set(\''.$settings_id.'\', \''.$settings_type.'\', \'checkbox\', \'coupon\')" />';
                    $html_checkbox[] = '<label class="dopbsp-for-checkbox" for="DOPBSP-settings-coupon'.$coupon->id.'">'.$coupon->name.'</label>';
                    $html_checkboxes[] = implode('',
                                                 $html_checkbox);
                }
                $html[] = implode('<br class="dopbsp-clear" />',
                                  $html_checkboxes);
                $html[] = '     </div>';
                $html[] = '     <a href="'.DOPBSP_CONFIG_HELP_DOCUMENTATION_URL.'" target="_blank" class="dopbsp-button dopbsp-help"><span class="dopbsp-info dopbsp-help">'.$help.'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION').'</span></a>';
                $html[] = ' </div>';
            }

            return implode('',
                           $html);
        }
    }
}