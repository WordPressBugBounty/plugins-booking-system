<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.2
* File                    : views/coupons/views-backend-coupon.php
* File Version            : 1.0.8
* Created / Last Modified : 11 October 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end coupon views class.
*/

if (!class_exists('DOPBSPViewsBackEndCoupon')){
    class DOPBSPViewsBackEndCoupon extends DOPBSPViewsBackEndCoupons{
        /*
         * Returns coupon template.
         *
         * @param args (array): function arguments
         *                      * id (integer): coupon ID
         *                      * language (string): coupon language
         *
         * @return coupon HTML
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
            $coupon = $wpdb->get_row($wpdb->prepare('SELECT * FROM %i WHERE id=%d',
                                                    $DOPBSP->tables->coupons,
                                                    $id));
            $hours = $DOPBSP->classes->prototypes->getHours();
            ?>
            <div class="dopbsp-inputs-wrapper dopbsp-last">
                <?php
                /*
                 * Name
                 */
                $this->displayTextInput(array('id'        => 'name',
                                              'label'     => $DOPBSP->text('COUPONS_COUPON_NAME'),
                                              'value'     => $coupon->name,
                                              'coupon_id' => $coupon->id,
                                              'help'      => $DOPBSP->text('COUPONS_COUPON_NAME_HELP')));
                ?>

                <!--
                    Language
                -->
                <div class="dopbsp-input-wrapper">
                    <label for="DOPBSP-coupon-language"><?php $DOT->echo($DOPBSP->text('COUPONS_COUPON_LANGUAGE')); ?></label>
                    <?php
                    $DOT->echo($this->getLanguages('DOPBSP-coupon-language',
                                                   'DOPBSPBackEndCoupon.display('.$coupon->id.', undefined, false)',
                                                   $language,
                                                   'dopbsp-left'),
                               'content',
                               $DOT->models->allowed_html->select());
                    ?>
                    <a href="javascript:void()" class="dopbsp-button dopbsp-help">
                        <span class="dopbsp-info dopbsp-help"><?php $DOT->echo($DOPBSP->text('COUPONS_COUPON_LANGUAGE_HELP')); ?></span>
                    </a>
                </div>
                <?php
                /*
                 * Label
                 */
                $this->displayTextInput(array('id'        => 'label',
                                              'label'     => $DOPBSP->text('COUPONS_COUPON_LABEL'),
                                              'value'     => $DOPBSP->classes->translation->decodeJSON($coupon->translation,
                                                                                                       $language),
                                              'coupon_id' => $coupon->id,
                                              'help'      => $DOPBSP->text('COUPONS_COUPON_LABEL_HELP')));
                /*
                 * Code
                 */
                $this->displayTextInput(array('id'              => 'code',
                                              'label'           => $DOPBSP->text('COUPONS_COUPON_CODE'),
                                              'value'           => $coupon->code,
                                              'coupon_id'       => $coupon->id,
                                              'help'            => $DOPBSP->text('COUPONS_COUPON_CODE_HELP'),
                                              'container_class' => '',
                                              'input_class'     => '',
                                              'code_help'       => $DOPBSP->text('COUPONS_COUPON_CODE_GENERATE')));
                /*
                 * Start date.
                 */
                $this->displayTextInput(array('id'              => 'start_date',
                                              'label'           => $DOPBSP->text('COUPONS_COUPON_START_DATE'),
                                              'value'           => $coupon->start_date,
                                              'coupon_id'       => $coupon->id,
                                              'help'            => $DOPBSP->text('COUPONS_COUPON_START_DATE_HELP'),
                                              'container_class' => '',
                                              'input_class'     => 'dopbsp-date'));
                /*
                 * End date.
                 */
                $this->displayTextInput(array('id'              => 'end_date',
                                              'label'           => $DOPBSP->text('COUPONS_COUPON_END_DATE'),
                                              'value'           => $coupon->end_date,
                                              'coupon_id'       => $coupon->id,
                                              'help'            => $DOPBSP->text('COUPONS_COUPON_END_DATE_HELP'),
                                              'container_class' => '',
                                              'input_class'     => 'dopbsp-date'));
                /*
                 * Start hour.
                 */
                $this->displaySelectInput(array('id'              => 'start_hour',
                                                'label'           => $DOPBSP->text('COUPONS_COUPON_START_HOUR'),
                                                'value'           => $coupon->start_hour,
                                                'coupon_id'       => $coupon->id,
                                                'help'            => $DOPBSP->text('COUPONS_COUPON_START_HOUR_HELP'),
                                                'options'         => ';;'.implode(';;',
                                                                                  $hours),
                                                'options_values'  => ';;'.implode(';;',
                                                                                  $hours),
                                                'container_class' => '',
                                                'input_class'     => 'dopbsp-hour'));
                /*
                 * End hour.
                 */
                $this->displaySelectInput(array('id'              => 'end_hour',
                                                'label'           => $DOPBSP->text('COUPONS_COUPON_END_HOUR'),
                                                'value'           => $coupon->end_hour,
                                                'coupon_id'       => $coupon->id,
                                                'help'            => $DOPBSP->text('COUPONS_COUPON_END_HOUR_HELP'),
                                                'options'         => ';;'.implode(';;',
                                                                                  $hours),
                                                'options_values'  => ';;'.implode(';;',
                                                                                  $hours),
                                                'container_class' => '',
                                                'input_class'     => 'dopbsp-hour'));
                /*
                 * Number of coupons.
                 */
                $this->displayTextInput(array('id'              => 'no_coupons',
                                              'label'           => $DOPBSP->text('COUPONS_COUPON_NO_COUPONS'),
                                              'value'           => $coupon->no_coupons,
                                              'coupon_id'       => $coupon->id,
                                              'help'            => $DOPBSP->text('COUPONS_COUPON_NO_COUPONS_HELP'),
                                              'container_class' => '',
                                              'input_class'     => 'dopbsp-small'));
                /*
                 * Operation
                 */
                $this->displaySelectInput(array('id'              => 'operation',
                                                'label'           => $DOPBSP->text('COUPONS_COUPON_OPERATION'),
                                                'value'           => $coupon->operation,
                                                'coupon_id'       => $coupon->id,
                                                'help'            => $DOPBSP->text('COUPONS_COUPON_OPERATION_HELP'),
                                                'options'         => '+;;-',
                                                'options_values'  => '+;;-',
                                                'container_class' => '',
                                                'input_class'     => 'dopbsp-small'));
                /*
                 * Price
                 */
                $this->displayTextInput(array('id'              => 'price',
                                              'label'           => $DOPBSP->text('COUPONS_COUPON_PRICE'),
                                              'value'           => $coupon->price,
                                              'coupon_id'       => $coupon->id,
                                              'help'            => $DOPBSP->text('COUPONS_COUPON_PRICE_HELP'),
                                              'container_class' => '',
                                              'input_class'     => 'dopbsp-small'));
                /*
                 * Price type.
                 */
                $this->displaySelectInput(array('id'              => 'price_type',
                                                'label'           => $DOPBSP->text('COUPONS_COUPON_PRICE_TYPE'),
                                                'value'           => $coupon->price_type,
                                                'coupon_id'       => $coupon->id,
                                                'help'            => $DOPBSP->text('COUPONS_COUPON_PRICE_TYPE_HELP'),
                                                'options'         => $DOPBSP->text('COUPONS_COUPON_PRICE_TYPE_FIXED').';;'.$DOPBSP->text('COUPONS_COUPON_PRICE_TYPE_PERCENT'),
                                                'options_values'  => 'fixed;;percent',
                                                'container_class' => '',
                                                'input_class'     => ''));
                /*
                 * Price by.
                 */
                $this->displaySelectInput(array('id'              => 'price_by',
                                                'label'           => $DOPBSP->text('COUPONS_COUPON_PRICE_BY'),
                                                'value'           => $coupon->price_by,
                                                'coupon_id'       => $coupon->id,
                                                'help'            => $DOPBSP->text('COUPONS_COUPON_PRICE_BY_HELP'),
                                                'options'         => $DOPBSP->text('COUPONS_COUPON_PRICE_BY_ONCE').';;'.$DOPBSP->text('COUPONS_COUPON_PRICE_BY_PERIOD'),
                                                'options_values'  => 'once;;period',
                                                'container_class' => 'dopbsp-last',
                                                'input_class'     => ''));
                ?>
            </div>
            <?php
        }

        /*
         * Inputs.
         */
        /*
         * Create a text input for coupon.
         *
         * @param args (array): function arguments
         *                      * id (integer): coupon field ID
         *                      * label (string): coupon label
         *                      * value (string): coupon current value
         *                      * coupon_id (integer): coupon ID
         *                      * help (string): coupon help
         *                      * container_class (string): container class
         *                      * input_class (string): input class
         *                      * code_help (string): code generator help
         *
         * @return text input HTML
         */
        function displayTextInput($args = array()){
            global $DOPBSP;
            global $DOT;

            $id = $DOT->escape($args['id'],
                               'attr');
            $id_full = $DOT->escape('DOPBSP-coupon-'.$args['id'],
                                    'attr');
            $label = $DOT->escape($args['label']);
            $value = $DOT->escape($args['value'],
                                  'attr');
            $coupon_id = $DOT->escape($args['coupon_id']);
            $help = $DOT->escape($args['help']);
            $container_class = $DOT->escape($args['container_class'] ?? '',
                                            'attr');
            $input_class = $DOT->escape($args['input_class'] ?? '',
                                        'attr');
            $code_help = $DOT->escape($args['code_help'] ?? '');

            $html = array();

            $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
            $html[] = '     <label for="'.$id_full.'">'.$label.'</label>';
            $html[] = '     <input type="text" name="'.$id_full.'" id="'.$id_full.'" class="'.$input_class.'" value="'.$value.'" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndCoupon.edit('.$coupon_id.', \'text\', \''.$id.'\', this.value);}" onchange="DOPBSPBackEndCoupon.edit('.$coupon_id.', \'text\', \''.$id.'\', this.value)" onpaste="DOPBSPBackEndCoupon.edit('.$coupon_id.', \'text\', \''.$id.'\', this.value)" onblur="DOPBSPBackEndCoupon.edit('.$coupon_id.', \'text\', \''.$id.'\', this.value, true)" />';

            if ($code_help != ''){
                $html[] = '     <a href="javascript:void(0)" onclick="DOPBSPBackEndCoupon.generateCode('.$coupon_id.')" target="_blank" class="dopbsp-button dopbsp-generate-code"><span class="dopbsp-info">'.$code_help.'</span></a>';
            }
            $html[] = '     <a href="'.$DOT->escape(DOPBSP_CONFIG_HELP_DOCUMENTATION_URL,
                                                    'url').'" target="_blank" class="dopbsp-button dopbsp-help"><span class="dopbsp-info dopbsp-help">'.$help.'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION').'</span></a>';

            $html[] = ' </div>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->input());
        }

        /*
         * Create a drop-down field for coupon.
         *
         * @param args (array): function arguments
         *                      * id (integer): coupon field ID
         *                      * label (string): coupon label
         *                      * value (string): coupon current value
         *                      * coupon_id (integer): coupon ID
         *                      * help (string): coupon help
         *                      * options (string): options labels
         *                      * options_values (string): options values
         *                      * container_class (string): container class
         *                      * input_class (string): input class
         *
         * @return drop down HTML
         */
        function displaySelectInput($args = array()){
            global $DOPBSP;
            global $DOT;

            $id = $DOT->escape($args['id'],
                               'attr');
            $id_full = $DOT->escape('DOPBSP-coupon-'.$args['id'],
                                    'attr');
            $label = $DOT->escape($args['label']);
            $value = $DOT->escape($args['value'],
                                  'attr');
            $coupon_id = $DOT->escape($args['coupon_id']);
            $help = $DOT->escape($args['help']);
            $options = $DOT->escape($args['options']);
            $options_values = $DOT->escape($args['options_values']);
            $container_class = $DOT->escape($args['container_class'] ?? '',
                                            'attr');
            $input_class = $DOT->escape($args['input_class'] ?? '',
                                        'attr');

            $html = array();
            $options_data = explode(';;',
                                    $options);
            $options_values_data = explode(';;',
                                           $options_values);

            $html[] = ' <div class="dopbsp-input-wrapper '.$container_class.'">';
            $html[] = '     <label for="'.$id_full.'">'.$label.'</label>';
            $html[] = '     <select name="'.$id_full.'" id="'.$id_full.'" class="dopbsp-left '.$input_class.'" onchange="DOPBSPBackEndCoupon.edit('.$coupon_id.', \'select\', \''.$id.'\', this.value)">';

            for ($i = 0; $i<count($options_data); $i++){
                if ($value == $options_values_data[$i]){
                    $html[] = '     <option value="'.$options_values_data[$i].'" selected="selected">'.$options_data[$i].'</option>';
                }
                else{
                    $html[] = '     <option value="'.$options_values_data[$i].'">'.$options_data[$i].'</option>';
                }
            }
            $html[] = '     </select>';
            $html[] = '     <script>jQuery(\'#DOPBSP-coupon-'.$id.'\').DOPSelect();</script>';
            $html[] = '     <a href="'.DOPBSP_CONFIG_HELP_DOCUMENTATION_URL.'" target="_blank" class="dopbsp-button dopbsp-help"><span class="dopbsp-info dopbsp-help">'.$help.'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION').'</span></a>';
            $html[] = ' </div>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->select());
        }
    }
}