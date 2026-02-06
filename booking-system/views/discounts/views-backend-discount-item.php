<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.2
* File                    : views/discounts/views-backend-discount-item.php
* File Version            : 1.0.8
* Created / Last Modified : 11 October 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end discount item views class.
*/

if (!class_exists('DOPBSPViewsBackEndDiscountItem')){
    class DOPBSPViewsBackEndDiscountItem extends DOPBSPViewsBackEndDiscountItems{
        /*
         * Returns item template.
         *
         * @param args (array): function arguments
         *                      * item (integer): item data
         *                      * language (string): item language
         *
         * @return item HTML
         */
        function template($args = array()){
            global $wpdb;
            global $DOPBSP;
            global $DOT;

            $item = $args['item'];
            $language = isset($args['language']) && $args['language'] != ''
                    ? $args['language']
                    : $DOPBSP->classes->backend_language->get();

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $rules = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE discount_item_id=%d ORDER BY position ASC',
                                                       $DOPBSP->tables->discounts_items_rules,
                                                       $item->id));
            ?>
            <li id="<?php $DOT->echo('DOPBSP-discount-item-'.$item->id,
                                     'attr'); ?>" class="dopbsp-item-wrapper">
                <?php
                /*
                 * Preview
                 */
                $this->displayPreview(array('item'     => $item,
                                            'language' => $language));
                ?>
                <div class="dopbsp-settings-wrapper">
                    <?php

                    /*
                     * Label
                     */
                    $this->displayTextInput(array('id'               => 'label',
                                                  'label'            => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_LABEL_LABEL'),
                                                  'value'            => $DOPBSP->classes->translation->decodeJSON($item->translation,
                                                                                                                  $language),
                                                  'discount_item_id' => $item->id,
                                                  'help'             => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_LABEL_HELP')));
                    /*
                     * Start time lapse.
                     */
                    $this->displayTextInput(array('id'               => 'start_time_lapse',
                                                  'label'            => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_START_TIME_LAPSE_LABEL'),
                                                  'value'            => $item->start_time_lapse,
                                                  'discount_item_id' => $item->id,
                                                  'help'             => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_START_TIME_LAPSE_HELP'),
                                                  'container_class'  => '',
                                                  'input_class'      => 'dopbsp-time-lapse DOPBSP-input-discount-item-time-lapse'));
                    /*
                     * End time lapse.
                     */
                    $this->displayTextInput(array('id'               => 'end_time_lapse',
                                                  'label'            => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_END_TIME_LAPSE_LABEL'),
                                                  'value'            => $item->end_time_lapse,
                                                  'discount_item_id' => $item->id,
                                                  'help'             => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_END_TIME_LAPSE_HELP'),
                                                  'container_class'  => '',
                                                  'input_class'      => 'dopbsp-time-lapse DOPBSP-input-discount-item-time-lapse'));
                    /*
                     * Operation
                     */
                    $this->displaySelectInput(array('id'               => 'operation',
                                                    'label'            => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_OPERATION_LABEL'),
                                                    'value'            => $item->operation,
                                                    'discount_item_id' => $item->id,
                                                    'help'             => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_OPERATION_HELP'),
                                                    'options'          => '+;;-',
                                                    'options_values'   => '+;;-',
                                                    'container_class'  => '',
                                                    'input_class'      => 'dopbsp-small'));
                    /*
                     * Price
                     */
                    $this->displayTextInput(array('id'               => 'price',
                                                  'label'            => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_PRICE_LABEL'),
                                                  'value'            => $item->price,
                                                  'discount_item_id' => $item->id,
                                                  'help'             => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_PRICE_HELP'),
                                                  'container_class'  => '',
                                                  'input_class'      => 'dopbsp-small DOPBSP-input-discount-item-price'));
                    /*
                     * Price type.
                     */
                    $this->displaySelectInput(array('id'               => 'price_type',
                                                    'label'            => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_PRICE_TYPE_LABEL'),
                                                    'value'            => $item->price_type,
                                                    'discount_item_id' => $item->id,
                                                    'help'             => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_PRICE_TYPE_HELP'),
                                                    'options'          => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_RULES_PRICE_TYPE_FIXED').';;'.$DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_RULES_PRICE_TYPE_PERCENT'),
                                                    'options_values'   => 'fixed;;percent'));
                    /*
                     * Price by.
                     */
                    $this->displaySelectInput(array('id'               => 'price_by',
                                                    'label'            => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_PRICE_BY_LABEL'),
                                                    'value'            => $item->price_by,
                                                    'discount_item_id' => $item->id,
                                                    'help'             => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_PRICE_BY_HELP'),
                                                    'options'          => $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_RULES_PRICE_BY_ONCE').';;'.$DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_RULES_PRICE_BY_PERIOD'),
                                                    'options_values'   => 'once;;period'));
                    ?>
                    <div class="dopbsp-input-wrapper dopbsp-last">
                        <label><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_RULES_LABEL')); ?></label>
                        <div class="dopbsp-rules-wrapper">
                            <div class="dopbsp-buttons">
                                <a href="javascript:DOPBSPBackEndDiscountItemRule.add(<?php $DOT->echo($item->id,
                                                                                                       'js'); ?>, '<?php $DOT->echo($language,
                                                                                                                                    'js'); ?>')" class="dopbsp-button dopbsp-small dopbsp-add">
                                    <span class="dopbsp-info"><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_ADD_RULE_SUBMIT')); ?></span>
                                </a>
                                <a href="<?php $DOT->echo(DOPBSP_CONFIG_HELP_DOCUMENTATION_URL,
                                                          'url'); ?>" target="_blank" class="dopbsp-button dopbsp-small dopbsp-help">
                                    <span class="dopbsp-info dopbsp-help">
                                        <?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_RULES_HELP')); ?>
                                        <br /><br />
                                        <?php $DOT->echo($DOPBSP->text('HELP_VIEW_DOCUMENTATION')); ?>
                                    </span>
                                </a>
                            </div>
                            <ul class="dopbsp-rules" id="<?php $DOT->echo('DOPBSP-discount-item-rules-'.$item->id,
                                                                          'attr'); ?>">
                                <?php
                                foreach ($rules as $rule){
                                    $DOPBSP->views->backend_discount_item_rule->template(array('rule'     => $rule,
                                                                                               'language' => $language));
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <?php
        }

        /*
         * Default templates.
         */
        /*
         * Create a discount item preview.
         *
         * @param args (array): function arguments
         *                      * item (integer): item data
         *                      * language (string): item language
         *
         * @return discount item preview HTML
         */
        function displayPreview($args = array()){
            global $DOPBSP;
            global $DOT;

            $item = $args['item'];
            $language = isset($args['language']) && $args['language'] != ''
                    ? $args['language']
                    : $DOPBSP->classes->backend_language->get();
            ?>
            <div class="dopbsp-preview-wrapper">
                <div class="dopbsp-preview dopbsp-input-wrapper">
                    <label id="<?php $DOT->echo('DOPBSP-discount-item-label-preview-'.$item->id,
                                                'attr'); ?>" for="<?php $DOT->echo('DOPBSP-discount-item-preview-'.$item->id,
                                                                                   'attr'); ?>"><?php $DOT->echo($DOPBSP->classes->translation->decodeJSON($item->translation,
                                                                                                                                                           $language)); ?> </label>
                </div>
                <div class="dopbsp-buttons-wrapper">
                    <a href="javascript:DOPBSPBackEndDiscountItem.toggle(<?php $DOT->echo($item->id,
                                                                                          'js'); ?>)" class="dopbsp-button dopbsp-toggle">
                        <span class="dopbsp-info"><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_SHOW_SETTINGS')); ?></span>
                    </a>
                    <a href="javascript:DOPBSPBackEnd.confirmation('DISCOUNTS_DISCOUNT_DELETE_ITEM_CONFIRMATION', 'DOPBSPBackEndDiscountItem.delete(<?php $DOT->echo($item->id,
                                                                                                                                                                     'js'); ?>)')" class="dopbsp-button dopbsp-delete">
                        <span class="dopbsp-info"><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_DELETE_ITEM_SUBMIT')); ?></span>
                    </a>
                    <a href="javascript:void(0)" class="dopbsp-button dopbsp-handle">
                        <span class="dopbsp-info"><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_SORT')); ?></span>
                    </a>
                </div>
                <br class="dopbsp-clear" />
            </div>
            <?php
        }

        /*
         * Inputs.
         */

        /*
         * Create a text input item for discount items.
         *
         * @param args (array): function arguments
         *                      * id (integer): item ID
         *                      * label (string): item label
         *                      * value (string): item current value
         *                      * discount_item_id (integer): discount item ID
         *                      * help (string): item help
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
            $discount_item_id = $args['discount_item_id'];
            $help = $args['help'];
            $container_class = $args['container_class'] ?? '';
            $input_class = $args['input_class'] ?? '';

            $html = array();

            $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
            $html[] = '     <label for="DOPBSP-discount-item-'.$id.'-'.$discount_item_id.'">'.$label.'</label>';
            $html[] = '     <input type="text" name="DOPBSP-discount-item-'.$id.'-'.$discount_item_id.'"  class="dopbsp-left '.$input_class.'" id="DOPBSP-discount-item-'.$id.'-'.$discount_item_id.'" value="'.$value.'" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndDiscountItem.edit('.$discount_item_id.', \'text\', \''.$id.'\', this.value);}" onpaste="DOPBSPBackEndDiscountItem.edit('.$discount_item_id.', \'text\', \''.$id.'\', this.value)" onblur="DOPBSPBackEndDiscountItem.edit('.$discount_item_id.', \'text\', \''.$id.'\', this.value, true)" />';
            $html[] = '     <a href="'.DOPBSP_CONFIG_HELP_DOCUMENTATION_URL.'" target="_blank" class="dopbsp-button dopbsp-help"><span class="dopbsp-info dopbsp-help">'.$help.'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION').'</span></a>';
            $html[] = ' </div>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->input());
        }

        /*
         * Create a select item for discount items.
         *
         * @param args (array): function arguments
         *                      * id (integer): item ID
         *                      * label (string): item label
         *                      * value (string): item current value
         *                      * discount_item_id (integer): discount rule ID
         *                      * help (string): item help
         *                      * options (string): options
         *                      * options_values (string): options_values class
         *                      * container_class (string): container class
         *                      * input_class (string): input_class class
         *
         * @return text input HTML
         */
        function displaySelectInput($args = array()){
            global $DOPBSP;
            global $DOT;

            $id = $args['id'];
            $label = $args['label'];
            $value = $args['value'];
            $discount_item_id = $args['discount_item_id'];
            $help = $args['help'];
            $options = $args['options'];
            $options_values = $args['options_values'];
            $container_class = $args['container_class'] ?? '';
            $input_class = $args['input_class'] ?? '';

            $html = array();
            $options_data = explode(';;',
                                    $options);
            $options_values_data = explode(';;',
                                           $options_values);

            $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
            $html[] = '     <label for="DOPBSP-discount-item-'.$id.'-'.$discount_item_id.'">'.$label.'</label>';
            $html[] = '     <select type="text" name="DOPBSP-discount-item-'.$id.'-'.$discount_item_id.'" class="dopbsp-left '.$input_class.'" id="DOPBSP-discount-item-'.$id.'-'.$discount_item_id.'" value="'.$value.'" onchange="DOPBSPBackEndDiscountItem.edit('.$discount_item_id.', \'select\', \''.$id.'\', this.value);" >';

            for ($i = 0; $i<count($options_data); $i++){
                if ($value == $options_values_data[$i]){
                    $html[] = '     <option value="'.$options_values_data[$i].'" selected="selected">'.$options_data[$i].'</option>';
                }
                else{
                    $html[] = '     <option value="'.$options_values_data[$i].'">'.$options_data[$i].'</option>';
                }
            }
            $html[] = '     </select>';
            $html[] = '     <script>';
            $html[] = '         jQuery("#DOPBSP-discount-item-'.$id.'-'.$discount_item_id.'").DOPSelect();';
            $html[] = '     </script>';
            $html[] = '     <a href="'.DOPBSP_CONFIG_HELP_DOCUMENTATION_URL.'" target="_blank" class="dopbsp-button dopbsp-help"><span class="dopbsp-info dopbsp-help">'.$help.'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION').'</span></a>';
            $html[] = ' </div>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->select());
        }

        /*
         * Create a switch item for discount items.
         *
         * @param args (array): function arguments
         *                      * id (integer): item ID
         *                      * label (string): item label
         *                      * value (string): item current value
         *                      * discount_item_id (integer): discount item ID
         *                      * help (string): item help
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
            $discount_item_id = $args['discount_item_id'];
            $help = $args['help'];
            $container_class = $args['container_class'] ?? '';

            $html = array();

            $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
            $html[] = '     <label class="dopbsp-for-switch">'.$label.'</label>';
            $html[] = '     <div class="dopbsp-switch">';
            $html[] = '         <input type="checkbox" name="DOPBSP-discount-item-'.$id.'-'.$discount_item_id.'" id="DOPBSP-discount-item-'.$id.'-'.$discount_item_id.'" class="dopbsp-switch-checkbox" onchange="DOPBSPBackEndDiscountItem.edit('.$discount_item_id.', \'switch\', \''.$id.'\')"'.($value == 'true'
                            ? ' checked="checked"'
                            : '').' />';
            $html[] = '         <label class="dopbsp-switch-label" for="DOPBSP-discount-item-'.$id.'-'.$discount_item_id.'">';
            $html[] = '             <div class="dopbsp-switch-inner"></div>';
            $html[] = '             <div class="dopbsp-switch-switch"></div>';
            $html[] = '         </label>';
            $html[] = '     </div>';
            $html[] = '     <a href="'.DOPBSP_CONFIG_HELP_DOCUMENTATION_URL.'" target="_blank" class="dopbsp-button dopbsp-help dopbsp-switch-help"><span class="dopbsp-info dopbsp-help">'.$help.'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION').'</span></a>';
            $html[] = ' </div>';
            $html[] = ' <style>';
            $html[] = '     .DOPBSP-admin .dopbsp-input-wrapper .dopbsp-switch .dopbsp-switch-inner:before{content: "'.$DOPBSP->text('SETTINGS_ENABLED').'";}';
            $html[] = '     .DOPBSP-admin .dopbsp-input-wrapper .dopbsp-switch .dopbsp-switch-inner:after{content: "'.$DOPBSP->text('SETTINGS_DISABLED').'";}';
            $html[] = ' </style>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->input());
        }
    }
}