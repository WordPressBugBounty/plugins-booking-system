<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.8
* File                    : views/views-backend.php
* File Version            : 1.2.0
* Created / Last Modified : 15 March 2016
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end views class.
*/

if (!class_exists('DOPBSPViewsBackEnd')){
    class DOPBSPViewsBackEnd{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Display default page header.
         *
         * @param title (string): page title
         *
         * @return default page header HTML
         */
        function displayHeader($title = '',
                               $subtitle = ''){
            global $DOPBSP;
            global $DOT;

            if (isset($DOPBSP->vars->view_pro)
                    && $DOPBSP->vars->view_pro
            && false){
                ?>
                <!--
                    PRO tips box.
                -->
                <div id="DOPBSP-pro-remove" class="updated notice dopbsp-notice is-dismissible">
                    <p>
                        <?php $DOT->echo($DOPBSP->text('MESSAGES_PRO_REMOVE_TEXT1')); ?>
                    </p>
                </div>
                <?php
            }
            ?>
            <h2></h2>
            <div class="dopbsp-header">
                <h3>
                    <span class="dopbsp-phone-hidden"><?php $DOT->echo($title); ?> -</span>
                    <?php $DOT->echo($subtitle); ?>
                </h3>
                <?php
                $DOT->echo($this->getLanguages(),
                           'content',
                           $DOT->models->allowed_html->select());

                if (DOPBSP_CONFIG_VIEW_DOCUMENTATION){
                    ?>
                    <a href="<?php $DOT->echo(DOPBSP_CONFIG_HELP_DOCUMENTATION_URL,
                                              'url'); ?>" target="_blank" class="dopbsp-tablet-hidden dopbsp-phone-hidden"><?php $DOT->echo($DOPBSP->text('HELP_DOCUMENTATION')); ?></a>
                    <?php
                }
                ?>
                <br class="dopbsp-clear" />
            </div>
            <?php $this->displayBoxes(); ?>
            <?php
        }

        /*
         * Display messages, confirmation & go to top boxes.
         *
         * @return boxes HTML
         */
        function displayBoxes(){
            global $DOPBSP;
            global $DOT;
            ?>
            <div id="DOPBSP-messages-background"></div>

            <!--
                Messages box.
            -->
            <div id="DOPBSP-messages-box">
                <a href="javascript:DOPBSPBackEnd.toggleMessages()" class="dopbsp-close"></a>
                <div class="dopbsp-icon-active"></div>
                <div class="dopbsp-icon-success"></div>
                <div class="dopbsp-icon-error"></div>
                <div class="dopbsp-message"></div>
            </div>

            <!--
                Confirmation box.
            -->
            <div id="DOPBSP-confirmation-box">
                <div class="dopbsp-icon"></div>
                <div class="dopbsp-message"></div>
                <div class="dopbsp-buttons">
                    <a href="javascript:void(0)" class="dopbsp-button-yes"><?php $DOT->echo($DOPBSP->text('MESSAGES_CONFIRMATION_YES')); ?></a>
                    <a href="javascript:void(0)" class="dopbsp-button-no"><?php $DOT->echo($DOPBSP->text('MESSAGES_CONFIRMATION_NO')); ?></a>
                </div>
            </div>

            <!--
                Go to top button.
            -->
            <a href="javascript:DOPPrototypes.scrollToY(0)" id="DOPBSP-go-top"></a>
            <?php
        }

        /*
         * Add translation to JavaScript for AJAX usage.
         */
        function getTranslation(){
            global $DOT;
            global $wpdb;
            global $DOPBSP;

            if ($DOT->get('page')){
                $current_page = $DOT->get('page');

                $DOPBSP_curr_page = match ($current_page) {
                    'dopbsp-calendars'    => 'Calendars',
                    'dopbsp-coupons'      => 'Coupons',
                    'dopbsp-discounts'    => 'Discounts',
                    'dopbsp-emails'       => 'Emails',
                    'dopbsp-extras'       => 'Extras',
                    'dopbsp-fees'         => 'Fees',
                    'dopbsp-forms'        => 'Forms',
                    'dopbsp-locations'    => 'Locations',
                    'dopbsp-pro'          => 'PRO',
                    'dopbsp-reservations' => 'Reservations',
                    'dopbsp-rules'        => 'Rules',
                    'dopbsp-search'       => 'Search',
                    'dopbsp-settings'     => 'Settings',
                    'dopbsp-smses'        => 'Smses',
                    'dopbsp-tools'        => 'Tools',
                    'dopbsp-translation'  => 'Translation',
                    default               => 'Dashboard',
                };
            }
            else{
                if ($DOT->get('action') == 'edit'){
                    $DOPBSP_curr_page = 'Calendars';
                }
                else{
                    $DOPBSP_curr_page = 'None';
                }
            }

            if (!is_super_admin()){
                $user_roles = array_values(wp_get_current_user()->roles);
                $DOPBSP_user_role = $user_roles[0];
            }
            else{
                $DOPBSP_user_role = 'administrator';
            }

            $settings_general = $DOPBSP->classes->backend_settings->values(0,
                                                                           'general');
            ?>
            <script type="text/JavaScript">
                let dopbspGoogleAPIkey                   = '<?php $DOT->echo($settings_general->google_map_api_key,
                                                                             'js'); ?>',
                    DOPBSP_CONFIG_HELP_DOCUMENTATION_URL = '<?php $DOT->echo(DOPBSP_CONFIG_HELP_DOCUMENTATION_URL,
                                                                             'url'); ?>',
                    DOPBSP_curr_page                     = '<?php $DOT->echo($DOPBSP_curr_page,
                                                                             'js'); ?>',
                    DOPBSP_user_nonce                    = '<?php $DOT->echo(wp_create_nonce('dopbsp_user_nonce'),
                                                                             'js'); ?>',
                    DOPBSP_user_ID                       = <?php $DOT->echo(wp_get_current_user()->ID,
                                                                            'js'); ?>,
                    DOPBSP_user_role                     = '<?php $DOT->echo($DOPBSP_user_role,
                                                                             'js'); ?>',
                    DOPBSP_plugin_url                    = '<?php $DOT->echo($DOPBSP->paths->url,
                                                                             'url'); ?>',
                    DOPBSP_translation_text              = [],
                    DOPBSP_view_pro                      = false;

                <?php
                $language = $DOPBSP->classes->backend_language->get();
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $translation = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i',
                                                                 $DOPBSP->tables->translation.'_'.$language));

                foreach ($translation as $item){
                $text = stripslashes($item->translation);
                $text = str_replace('<<single-quote>>',
                                    "\'",
                                    $text);
                $text = str_replace('<script>',
                                    "",
                                    $text);
                $text = str_replace('</script>',
                                    "",
                                    $text);
                ?>
                DOPBSP_translation_text['<?php $DOT->echo($item->key_data); ?>'] = '<?php $DOT->echo($text); ?>';
                <?php
                }
                ?>
            </script>
            <?php
        }

        /*
         * Get languages drop down.
         *
         * @param id (string): drop down ID
         * @param function (string): onchange function
         * @param class (string): drop down class
         *
         * @return drop down HTML
         */
        function getLanguages($id = 'DOPBSP-admin-language',
                              $function = 'DOPBSPBackEndLanguage.change()',
                              $selected_language = '',
                              $class = ''){
            global $wpdb;
            global $DOPBSP;
            global $DOT;

            $HTML = array();

            $languages = $DOPBSP->classes->languages->languages;
            $selected_language = $selected_language == ''
                    ? $DOPBSP->classes->backend_language->get()
                    : $selected_language;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $enabled_languages = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE enabled="true"',
                                                                   $DOPBSP->tables->languages));

            $HTML[] = '<select name="'.$DOT->escape($id,
                                                    'attr').'" id="'.$DOT->escape($id,
                                                                                  'attr').'"'.($class == ''
                            ? ''
                            : ' class="'.$DOT->escape($class,
                                                      'attr').'"').' onchange="'.$DOT->escape($function,
                                                                                              'js').'">';

            foreach ($enabled_languages as $enabled_language){
                for ($i = 0; $i<count($languages); $i++){
                    if ($enabled_language->code == $languages[$i]['code']){
                        $HTML[] = '<option value="'.$DOT->escape($languages[$i]['code'],
                                                                 'attr').'"'.($selected_language == $languages[$i]['code']
                                        ? ' selected="selected"'
                                        : '').'>'.$DOT->escape($languages[$i]['name']).'</option>';
                        break;
                    }
                }
            }
            $HTML[] = '</select>';
            $HTML[] = '<script>jQuery(\'#'.$DOT->escape($id,
                                                        'attr').'\').DOPSelect();</script>';

            return implode('',
                           $HTML);
        }
    }
}