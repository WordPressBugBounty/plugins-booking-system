<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.2
* File                    : views/forms/views-backend-form-field-select-option.php
* File Version            : 1.0.5
* Created / Last Modified : 11 October 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end form field select option views class.
*/

if (!class_exists('DOPBSPViewsBackEndFormFieldSelectOption')){
    class DOPBSPViewsBackEndFormFieldSelectOption extends DOPBSPViewsBackEndFormField{
        /*
         * Returns select field option template.
         *
         * @param args (array): function arguments
         *                      * select_option (integer): select data
         *                      * language (string): field language
         *
         * @return select field HTML
         */
        function template($args = array()){
            global $DOPBSP;
            global $DOT;

            $select_option = $args['select_option'];
            $language = isset($args['language']) && $args['language'] != ''
                    ? $args['language']
                    : $DOPBSP->classes->backend_language->get();
            ?>
            <li id="<?php $DOT->echo('DOPBSP-form-field-select-option-'.$select_option->id,
                                     'attr'); ?>">
                <div class="dopbsp-input-wrapper">
                    <input type="text" name="<?php $DOT->echo('DOPBSP-form-field-select-option-label-'.$select_option->id,
                                                              'attr'); ?>" id="<?php $DOT->echo('DOPBSP-form-field-select-option-label-'.$select_option->id,
                                                                                                'attr'); ?>" value="<?php $DOT->echo($DOPBSP->classes->translation->decodeJSON($select_option->translation,
                                                                                                                                                                               $language)); ?>" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndFormFieldSelectOption.edit(<?php $DOT->echo($select_option->id,
                                                                                                                                                                                                                                                                                                          'js'); ?>, 'text', 'label', this.value);}" onpaste="DOPBSPBackEndFormFieldSelectOption.edit(<?php $DOT->echo($select_option->id,
                                                                                                                                                                                                                                                                                                                                                                                                                       'js'); ?>, 'text', 'label', this.value)" onblur="DOPBSPBackEndFormFieldSelectOption.edit(<?php $DOT->echo($select_option->id,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 'js'); ?>, 'text', 'label', this.value, true)" />
                    <a href="javascript:DOPBSPBackEnd.confirmation('FORMS_FORM_FIELD_SELECT_DELETE_OPTION_CONFIRMATION', 'DOPBSPBackEndFormFieldSelectOption.delete(<?php $DOT->echo($select_option->id,
                                                                                                                                                                                     'js'); ?>)')" class="dopbsp-button dopbsp-small dopbsp-delete">
                        <span class="dopbsp-info"><?php $DOT->echo($DOPBSP->text('FORMS_FORM_FIELD_SELECT_DELETE_OPTION_SUBMIT')); ?></span>
                    </a>
                    <a href="javascript:void(0)" class="dopbsp-button dopbsp-small dopbsp-handle">
                        <span class="dopbsp-info"><?php $DOT->echo($DOPBSP->text('FORMS_FORM_FIELD_SELECT_OPTION_SORT')); ?></span>
                    </a>
                </div>
            </li>
            <?php
        }
    }
}