<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.2
* File                    : views/forms/views-backend-form.php
* File Version            : 1.0.7
* Created / Last Modified : 11 October 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end form views class.
*/

if (!class_exists('DOPBSPViewsBackEndForm')){
    class DOPBSPViewsBackEndForm extends DOPBSPViewsBackEndForms{
        /*
         * Returns form template.
         *
         * @param args (array): function arguments
         *                      * id (integer): form ID
         *                      * language (string): form language
         *
         * @return form HTML
         */
        function template($args = array()){
            global $wpdb;
            global $DOPBSP;
            global $DOT;

            $id = $args['id'];
            $language = isset($args['language']) && $args['language'] != ''
                    ? $args['language']
                    : $DOPBSP->classes->backend_language->get();

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $form = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE id=%d',
                                                  $DOPBSP->tables->forms,
                                                  $id));
            ?>
            <div class="dopbsp-inputs-wrapper">
                <?php
                /*
                 * Name
                 */
                $this->displayTextInput(array('id'      => 'name',
                                              'label'   => $DOPBSP->text('FORMS_FORM_NAME'),
                                              'value'   => $form->name,
                                              'form_id' => $form->id,
                                              'help'    => $DOPBSP->text('FORMS_FORM_NAME_HELP')));
                ?>

                <!--
                    Language
                -->
                <div class="dopbsp-input-wrapper dopbsp-last">
                    <label for="DOPBSP-form-language"><?php $DOT->echo($DOPBSP->text('FORMS_FORM_LANGUAGE')); ?></label>
                    <?php
                    $DOT->echo($this->getLanguages('DOPBSP-form-language',
                                                   'DOPBSPBackEndForm.display('.$form->id.', undefined, false)',
                                                   $language,
                                                   'dopbsp-left'),
                               'content',
                               $DOT->models->allowed_html->select());
                    ?>
                    <a href="javascript:void()" class="dopbsp-button dopbsp-help">
                        <span class="dopbsp-info dopbsp-help"><?php $DOT->echo($DOPBSP->text('FORMS_FORM_LANGUAGE_HELP')); ?></span>
                    </a>
                </div>
            </div>
            <?php
        }

        /*
         * Inputs.
         */
        /*
         * Create a text input field for forms.
         *
         * @param args (array): function arguments
         *                      * id (integer): field ID
         *                      * label (string): field label
         *                      * value (string): field current value
         *                      * form_id (integer): form ID
         *                      * help (string): field help
         *                      * container_class (string): container class
         *
         * @return text input HTML
         */
        function displayTextInput($args = array()){
            global $DOPBSP;
            global $DOT;

            $id = $args['id'];
            $label = $args['label'];
            $value = $args['value'];
            $form_id = $args['form_id'];
            $help = $args['help'];
            $container_class = $args['container_class'] ?? '';

            $html = array();

            $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
            $html[] = '     <label for="DOPBSP-form-'.$id.'">'.$label.'</label>';
            $html[] = '     <input type="text" name="DOPBSP-form-'.$id.'" id="DOPBSP-form-'.$id.'" value="'.$value.'" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndForm.edit('.$form_id.', \'text\', \''.$id.'\', this.value);}" onpaste="DOPBSPBackEndForm.edit('.$form_id.', \'text\', \''.$id.'\', this.value)" onblur="DOPBSPBackEndForm.edit('.$form_id.', \'text\', \''.$id.'\', this.value, true)" />';
            $html[] = '     <a href="'.DOPBSP_CONFIG_HELP_DOCUMENTATION_URL.'" target="_blank" class="dopbsp-button dopbsp-help"><span class="dopbsp-info dopbsp-help">'.$help.'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION').'</span></a>';
            $html[] = ' </div>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->input());
        }
    }
}