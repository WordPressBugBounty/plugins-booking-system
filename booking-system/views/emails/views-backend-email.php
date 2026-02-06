<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.2
* File                    : views/emails/views-backend-email.php
* File Version            : 1.0.8
* Created / Last Modified : 11 October 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end email views class.
*/

if (!class_exists('DOPBSPViewsBackEndEmail')){
    class DOPBSPViewsBackEndEmail extends DOPBSPViewsBackEndEmails{
        /*
         * Returns email template.
         *
         * @param args (array): function arguments
         *                      * id (integer): email ID
         *                      * language (string): email language
         *                      * template (string): email template
         *
         * @return email HTML
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
            $email = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE id=%d',
                                                   $DOPBSP->tables->emails,
                                                   $id));
            $email->name = esc_js($email->name);
            $template_data = $DOPBSP->classes->backend_email->get($id,
                                                                  $template);
            ?>
            <div class="dopbsp-inputs-wrapper dopbsp-last">
                <?php
                /*
                 * Name
                 */
                $this->displayTextInput(array('id'       => 'name',
                                              'label'    => $DOPBSP->text('EMAILS_EMAIL_NAME'),
                                              'value'    => $email->name,
                                              'email_id' => $email->id,
                                              'template' => '',
                                              'help'     => $DOPBSP->text('EMAILS_EMAIL_NAME_HELP')));
                ?>

                <!--
                    Language
                -->
                <div class="dopbsp-input-wrapper">
                    <label for="DOPBSP-email-language"><?php $DOT->echo($DOPBSP->text('EMAILS_EMAIL_LANGUAGE')); ?></label>
                    <?php
                    $DOT->echo($this->getLanguages('DOPBSP-email-language',
                                                   'DOPBSPBackEndEmail.display('.$email->id.', undefined, undefined, false)',
                                                   $language,
                                                   'dopbsp-left'),
                               'content',
                               $DOT->models->allowed_html->select());
                    ?>
                    <a href="javascript:void()" class="dopbsp-button dopbsp-help">
                        <span class="dopbsp-info dopbsp-help"><?php $DOT->echo($DOPBSP->text('EMAILS_EMAIL_LANGUAGE_HELP')); ?></span>
                    </a>
                </div>

                <!--
                    Select template.
                -->
                <div class="dopbsp-input-wrapper">
                    <label for="DOPBSP-email-select-template"><?php $DOT->echo($DOPBSP->text('EMAILS_EMAIL_TEMPLATE_SELECT')); ?></label>
                    <select name="DOPBSP-email-select-template" id="DOPBSP-email-select-template" class="dopbsp-left" onchange="DOPBSPBackEndEmail.display(<?php $DOT->echo($email->id,
                                                                                                                                                                            'js'); ?>, undefined, this.value, false)">
                        <option value="book_admin"<?php $DOT->echo($template == 'book_admin'
                                                                           ? ' selected="selected"'
                                                                           : '',
                                                                   'attr'); ?>><?php $DOT->echo($DOPBSP->text('EMAILS_EMAIL_TEMPLATE_SELECT_BOOK_ADMIN')); ?></option>
                        <option value="book_user"<?php $DOT->echo($template == 'book_user'
                                                                          ? ' selected="selected"'
                                                                          : '',
                                                                  'attr'); ?>><?php $DOT->echo($DOPBSP->text('EMAILS_EMAIL_TEMPLATE_SELECT_BOOK_USER')); ?></option>
                        <option value="book_with_approval_admin"<?php $DOT->echo($template == 'book_with_approval_admin'
                                                                                         ? ' selected="selected"'
                                                                                         : '',
                                                                                 'attr'); ?>><?php $DOT->echo($DOPBSP->text('EMAILS_EMAIL_TEMPLATE_SELECT_BOOK_WITH_APPROVAL_ADMIN')); ?></option>
                        <option value="book_with_approval_user"<?php $DOT->echo($template == 'book_with_approval_user'
                                                                                        ? ' selected="selected"'
                                                                                        : '',
                                                                                'attr'); ?>><?php $DOT->echo($DOPBSP->text('EMAILS_EMAIL_TEMPLATE_SELECT_BOOK_WITH_APPROVAL_USER')); ?></option>
                        <option value="approved"<?php $DOT->echo($template == 'approved'
                                                                         ? ' selected="selected"'
                                                                         : '',
                                                                 'attr'); ?>><?php $DOT->echo($DOPBSP->text('EMAILS_EMAIL_TEMPLATE_SELECT_APPROVED')); ?></option>
                        <option value="canceled"<?php $DOT->echo($template == 'canceled'
                                                                         ? ' selected="selected"'
                                                                         : '',
                                                                 'attr'); ?>><?php $DOT->echo($DOPBSP->text('EMAILS_EMAIL_TEMPLATE_SELECT_CANCELED')); ?></option>
                        <option value="rejected"<?php $DOT->echo($template == 'rejected'
                                                                         ? ' selected="selected"'
                                                                         : '',
                                                                 'attr'); ?>><?php $DOT->echo($DOPBSP->text('EMAILS_EMAIL_TEMPLATE_SELECT_REJECTED')); ?></option>
                        <?php
                        $pg_list = $DOPBSP->classes->payment_gateways->get();

                        for ($i = 0; $i<count($pg_list); $i++){
                            $pg_id = $pg_list[$i];

                            $DOT->echo('<option value="'.$pg_id.'_admin"'.($template == $pg_id.'_admin'
                                               ? ' selected="selected"'
                                               : '').'>'.$DOPBSP->text('EMAILS_EMAIL_TEMPLATE_SELECT_'.strtoupper($pg_id).'_ADMIN').'</option>',
                                       'content',
                                       $DOT->models->allowed_html->select());
                            $DOT->echo('<option value="'.$pg_id.'_user"'.($template == $pg_id.'_user'
                                               ? ' selected="selected"'
                                               : '').'>'.$DOPBSP->text('EMAILS_EMAIL_TEMPLATE_SELECT_'.strtoupper($pg_id).'_USER').'</option>',
                                       'content',
                                       $DOT->models->allowed_html->select());
                        }
                        ?>
                    </select>
                    <script type="text/JavaScript">jQuery('#DOPBSP-email-select-template')
                        .DOPSelect();</script>
                    <a href="javascript:void()" class="dopbsp-button dopbsp-help">
                        <span class="dopbsp-info dopbsp-help"><?php $DOT->echo($DOPBSP->text('EMAILS_EMAIL_TEMPLATE_SELECT_HELP')); ?></span>
                    </a>
                </div>
                <?php
                $this->displayTextInput(array('id'              => 'subject',
                                              'label'           => $DOPBSP->text('EMAILS_EMAIL_SUBJECT'),
                                              'value'           => $DOPBSP->classes->translation->decodeJSON($template_data->subject,
                                                                                                             $language),
                                              'email_id'        => $email->id,
                                              'template'        => $template,
                                              'help'            => '',
                                              'container_class' => '',
                                              'input_class'     => 'dopbsp-subject'));
                $this->displayTextarea(array('id'              => 'message',
                                             'label'           => $DOPBSP->text('EMAILS_EMAIL_MESSAGE'),
                                             'value'           => $DOPBSP->classes->translation->decodeJSON($template_data->message,
                                                                                                            $language),
                                             'email_id'        => $email->id,
                                             'template'        => $template,
                                             'container_class' => 'dopbsp-last',
                                             'input_class'     => 'dopbsp-message'));
                ?>
            </div>
            <?php
        }

        /*
         * Inputs.
         */
        /*
         * Create a text input for email.
         *
         * @param args (array): function arguments
         *                      * id (integer): email field ID
         *                      * label (string): email label
         *                      * value (string): email current value
         *                      * email_id (integer): email ID
         *                      * template (integer): email template
         *                      * help (string): email help
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
            $email_id = $args['email_id'];
            $template = $args['template'];
            $help = $args['help'] ?? '';
            $container_class = $args['container_class'] ?? '';
            $input_class = $args['input_class'] ?? '';

            $html = array();

            $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
            $html[] = '     <label for="DOPBSP-email-'.$id.'">'.$label.'</label>';
            $html[] = '     <input type="text" name="DOPBSP-email-'.$id.'" id="DOPBSP-email-'.$id.'" class="'.$input_class.'" value="'.$value.'" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndEmail.edit('.$email_id.', \''.$template.'\', \'text\', \''.$id.'\', this.value);}" onpaste="DOPBSPBackEndEmail.edit('.$email_id.', \''.$template.'\', \'text\', \''.$id.'\', this.value)" onblur="DOPBSPBackEndEmail.edit('.$email_id.', \''.$template.'\', \'text\', \''.$id.'\', this.value, true)" />';

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
         * Create a textarea input for email.
         *
         * @param args (array): function arguments
         *                      * id (integer): email field ID
         *                      * label (string): email label
         *                      * value (string): email current value
         *                      * email_id (integer): email ID
         *                      * template (integer): email template
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
            $email_id = $args['email_id'];
            $template = $args['template'];
            $container_class = $args['container_class'] ?? '';
            $input_class = $args['input_class'] ?? '';

            $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
            $html[] = '     <label for="DOPBSP-email-'.$id.'">'.$label.'</label>';
            $html[] = '     <textarea name="DOPBSP-email-'.$id.'" id="DOPBSP-email-'.$id.'" cols="" rows="12" class="'.$input_class.'" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndEmail.edit('.$email_id.', \''.$template.'\', \'text\', \''.$id.'\', this.value)}" onpaste="DOPBSPBackEndEmail.edit('.$email_id.', \''.$template.'\', \'text\', \''.$id.'\', this.value)" onblur="DOPBSPBackEndEmail.edit('.$email_id.', \''.$template.'\', \'text\', \''.$id.'\', this.value, true)">'.$value.'</textarea>';
            $html[] = ' </div>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->textarea());
        }
    }
}