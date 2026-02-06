<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* File                    : views/smses/views-backend-sms.php
* Author                  : PINPOINT.WORLD
* Copyright               : © 2018 PINPOINT.WORLD
* Website                 : http://www.pinpoint.world
* Description             : Back end SMS views class.
*/

if (!class_exists('DOPBSPViewsBackEndSms')){
    class DOPBSPViewsBackEndSms extends DOPBSPViewsBackEndSmses{
        /*
         * Returns SMS template.
         *
         * @param args (array): function arguments
         *                      * id (integer): sms ID
         *                      * language (string): sms language
         *                      * template (string): sms template
         *
         * @return sms HTML
         */
        function template($args = array()){
            global $wpdb;
            global $DOPBSP;
            global $DOT;

            $id = $args['id'];
            $language = isset($args['language']) && $args['language'] != ''
                    ? $args['language']
                    : $DOPBSP->classes->backend_language->get();
            $template = $args['template'] ?? 'book_admin';

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $sms = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE id=%d',
                                                 $DOPBSP->tables->smses,
                                                 $id));
            $sms->name = esc_js($sms->name);
            $template_data = $DOPBSP->classes->backend_sms->get($id,
                                                                $template);
            ?>
            <div class="dopbsp-inputs-wrapper dopbsp-last">
                <?php
                /*
                 * Name
                 */
                $this->displayTextInput(array('id'       => 'name',
                                              'label'    => $DOPBSP->text('SMSES_SMS_NAME'),
                                              'value'    => $sms->name,
                                              'sms_id'   => $sms->id,
                                              'template' => '',
                                              'help'     => $DOPBSP->text('SMSES_SMS_NAME_HELP')));
                ?>

                <!--
                    Language
                -->
                <div class="dopbsp-input-wrapper">
                    <label for="DOPBSP-sms-language"><?php $DOT->echo($DOPBSP->text('SMSES_SMS_LANGUAGE')); ?></label>
                    <?php
                    $DOT->echo($this->getLanguages('DOPBSP-sms-language',
                                                   'DOPBSPBackEndSms.display('.$sms->id.', undefined, undefined, false)',
                                                   $language,
                                                   'dopbsp-left'),
                               'content',
                               $DOT->models->allowed_html->select());
                    ?>
                    <a href="javascript:void()" class="dopbsp-button dopbsp-help">
                        <span class="dopbsp-info dopbsp-help"><?php $DOT->echo($DOPBSP->text('SMSES_SMS_LANGUAGE_HELP')); ?></span>
                    </a>
                </div>

                <!--
                    Select template.
                -->
                <div class="dopbsp-input-wrapper">
                    <label for="DOPBSP-sms-select-template"><?php $DOT->echo($DOPBSP->text('SMSES_SMS_TEMPLATE_SELECT')); ?></label>
                    <select name="DOPBSP-sms-select-template" id="DOPBSP-sms-select-template" class="dopbsp-left" onchange="DOPBSPBackEndSms.display(<?php $DOT->echo($sms->id,
                                                                                                                                                                      'js'); ?>, undefined, this.value, false)">
                        <option value="book_admin"<?php $DOT->echo($template == 'book_admin'
                                                                           ? ' selected="selected"'
                                                                           : ''); ?>><?php $DOT->echo($DOPBSP->text('SMSES_SMS_TEMPLATE_SELECT_BOOK_ADMIN')); ?></option>
                        <option value="book_user"<?php $DOT->echo($template == 'book_user'
                                                                          ? ' selected="selected"'
                                                                          : ''); ?>><?php $DOT->echo($DOPBSP->text('SMSES_SMS_TEMPLATE_SELECT_BOOK_USER')); ?></option>
                        <option value="book_with_approval_admin"<?php $DOT->echo($template == 'book_with_approval_admin'
                                                                                         ? ' selected="selected"'
                                                                                         : ''); ?>><?php $DOT->echo($DOPBSP->text('SMSES_SMS_TEMPLATE_SELECT_BOOK_WITH_APPROVAL_ADMIN')); ?></option>
                        <option value="book_with_approval_user"<?php $DOT->echo($template == 'book_with_approval_user'
                                                                                        ? ' selected="selected"'
                                                                                        : ''); ?>><?php $DOT->echo($DOPBSP->text('SMSES_SMS_TEMPLATE_SELECT_BOOK_WITH_APPROVAL_USER')); ?></option>
                        <option value="approved"<?php $DOT->echo($template == 'approved'
                                                                         ? ' selected="selected"'
                                                                         : ''); ?>><?php $DOT->echo($DOPBSP->text('SMSES_SMS_TEMPLATE_SELECT_APPROVED')); ?></option>
                        <option value="canceled"<?php $DOT->echo($template == 'canceled'
                                                                         ? ' selected="selected"'
                                                                         : ''); ?>><?php $DOT->echo($DOPBSP->text('SMSES_SMS_TEMPLATE_SELECT_CANCELED')); ?></option>
                        <option value="rejected"<?php $DOT->echo($template == 'rejected'
                                                                         ? ' selected="selected"'
                                                                         : ''); ?>><?php $DOT->echo($DOPBSP->text('SMSES_SMS_TEMPLATE_SELECT_REJECTED')); ?></option>
                        <?php
                        $pg_list = $DOPBSP->classes->payment_gateways->get();

                        for ($i = 0; $i<count($pg_list); $i++){
                            $pg_id = $pg_list[$i];

                            $DOT->echo('<option value="'.$pg_id.'_admin"'.($template == $pg_id.'_admin'
                                               ? ' selected="selected"'
                                               : '').'>'.$DOPBSP->text('SMSES_SMS_TEMPLATE_SELECT_'.strtoupper($pg_id).'_ADMIN').'</option>',
                                       'content',
                                       $DOT->models->allowed_html->select());
                            $DOT->echo('<option value="'.$pg_id.'_user"'.($template == $pg_id.'_user'
                                               ? ' selected="selected"'
                                               : '').'>'.$DOPBSP->text('SMSES_SMS_TEMPLATE_SELECT_'.strtoupper($pg_id).'_USER').'</option>',
                                       'content',
                                       $DOT->models->allowed_html->select());
                        }
                        ?>
                    </select>
                    <script>jQuery('#DOPBSP-sms-select-template')
                        .DOPSelect();</script>
                    <a href="javascript:void()" class="dopbsp-button dopbsp-help">
                        <span class="dopbsp-info dopbsp-help"><?php $DOT->echo($DOPBSP->text('SMSES_SMS_TEMPLATE_SELECT_HELP')); ?></span>
                    </a>
                </div>
                <?php

                $this->displayTextarea(array('id'              => 'message',
                                             'label'           => $DOPBSP->text('SMSES_SMS_MESSAGE'),
                                             'value'           => $DOPBSP->classes->translation->decodeJSON($template_data->message,
                                                                                                            $language),
                                             'sms_id'          => $sms->id,
                                             'template'        => $template,
                                             'container_class' => 'dopbsp-last',
                                             'input_class'     => 'dopbsp-sms'));
                ?>
            </div>
            <?php
        }

        /*
         * Inputs.
         */
        /*
         * Create a text input for SMS.
         *
         * @param args (array): function arguments
         *                      * id (integer): sms field ID
         *                      * label (string): sms label
         *                      * value (string): sms current value
         *                      * sms_id (integer): sms ID
         *                      * template (integer): sms template
         *                      * help (string): sms help
         *                      * container_class (string): container class
         *                      * input_class (string): input class
         *
         * @return text input HTML
         */
        function displayTextInput($args = array()){
            global $DOPBSP;
            global $DOT;

            $id = $args['id'];
            $label = $args['label'];
            $value = $args['value'];
            $sms_id = $args['sms_id'];
            $template = $args['template'];
            $help = $args['help'] ?? '';
            $container_class = $args['container_class'] ?? '';
            $input_class = $args['input_class'] ?? '';

            $html = array();

            $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
            $html[] = '     <label for="DOPBSP-sms-'.$id.'">'.$label.'</label>';
            $html[] = '     <input type="text" name="DOPBSP-sms-'.$id.'" id="DOPBSP-sms-'.$id.'" class="'.$input_class.'" value="'.$value.'" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndSms.edit('.$sms_id.', \''.$template.'\', \'text\', \''.$id.'\', this.value);}" onpaste="DOPBSPBackEndSms.edit('.$sms_id.', \''.$template.'\', \'text\', \''.$id.'\', this.value)" onblur="DOPBSPBackEndSms.edit('.$sms_id.', \''.$template.'\', \'text\', \''.$id.'\', this.value, true)" />';

            if ($help != ''){
                $html[] = '     <a href="'.DOPBSP_CONFIG_HELP_DOCUMENTATION_URL.'" target="_blank" class="dopbsp-button dopbsp-help"><span class="dopbsp-info dopbsp-help">'.$help.'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION').'</span></a>';
            }
            $html[] = ' </div>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->input());
        }

        /*
         * Create a textarea input for SMS.
         *
         * @param args (array): function arguments
         *                      * id (integer): sms field ID
         *                      * label (string): sms label
         *                      * value (string): sms current value
         *                      * sms_id (integer): sms ID
         *                      * template (integer): sms template
         *                      * container_class (string): container class
         *                      * input_class (string): input class
         *
         * @return text input HTML
         */
        function displayTextarea($args = array()){
            global $DOT;

            $html = array();

            $id = $args['id'];
            $label = $args['label'];
            $value = $args['value'];
            $sms_id = $args['sms_id'];
            $template = $args['template'];
            $container_class = $args['container_class'] ?? '';
            $input_class = $args['input_class'] ?? '';

            $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
            $html[] = '     <label for="DOPBSP-sms-'.$id.'">'.$label.'</label>';
            $html[] = '     <textarea name="DOPBSP-sms-'.$id.'" id="DOPBSP-sms-'.$id.'" cols="" rows="12" class="'.$input_class.'" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndSms.edit('.$sms_id.', \''.$template.'\', \'text\', \''.$id.'\', this.value)}" onpaste="DOPBSPBackEndSms.edit('.$sms_id.', \''.$template.'\', \'text\', \''.$id.'\', this.value)" onblur="DOPBSPBackEndSms.edit('.$sms_id.', \''.$template.'\', \'text\', \''.$id.'\', this.value, true)">'.$value.'</textarea>';
            $html[] = ' </div>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->textarea());
        }
    }
}