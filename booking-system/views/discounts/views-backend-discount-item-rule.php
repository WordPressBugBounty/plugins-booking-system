<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.2
* File                    : views/discounts/views-backend-discount-item-rule.php
* File Version            : 1.0.4
* Created / Last Modified : 11 October 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end discount item rule views class.
*/

if (!class_exists('DOPBSPViewsBackEndDiscountItemRule')){
    class DOPBSPViewsBackEndDiscountItemRule extends DOPBSPViewsBackEndDiscountItem{
        /*
         * Returns item rule template.
         *
         * @param args (array): function arguments
         *                      * rule (integer): select data
         *                      * language (string): item language
         *
         * @return select item HTML
         */
        function template($args = array()){
            global $DOPBSP;
            global $DOT;

            $rule = $args['rule'];

            $hours = $DOPBSP->classes->prototypes->getHours();
            ?>
            <li id="<?php $DOT->echo('DOPBSP-discount-item-rule-'.$rule->id,
                                     'attr'); ?>" class="dopbsp-item-rule-wrapper">
                <div class="dopbsp-input-wrapper">
                    <!--
                        Buttons
                    -->
                    <a href="javascript:void(0)" class="dopbsp-button dopbsp-small dopbsp-handle">
                        <span class="dopbsp-info"><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_RULE_SORT')); ?></span>
                    </a>
                    <a href="javascript:DOPBSPBackEnd.confirmation('DISCOUNTS_DISCOUNT_ITEM_DELETE_RULE_CONFIRMATION', 'DOPBSPBackEndDiscountItemRule.delete(<?php $DOT->echo($rule->id,
                                                                                                                                                                              'js'); ?>)')" class="dopbsp-button dopbsp-small dopbsp-delete">
                        <span class="dopbsp-info"><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_DELETE_RULE_SUBMIT')); ?></span>
                    </a>

                    <!--
                        Start date
                    -->
                    <input type="text" name="<?php $DOT->echo('DOPBSP-discount-item-rule-start-date-'.$rule->id,
                                                              'attr'); ?>" id="<?php $DOT->echo('DOPBSP-discount-item-rule-start-date-'.$rule->id,
                                                                                                'attr'); ?>" class="DOPBSP-discount-item-rule-start-date dopbsp-date" value="<?php $DOT->echo($rule->start_date); ?>" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                                                                                                                                                           'js'); ?>, 'text', 'start_date', this.value); DOPBSPBackEndDiscountItemRule.init();}" onchange="DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                               'js'); ?>, 'text', 'start_date', this.value); DOPBSPBackEndDiscountItemRule.init()" onpaste="DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                'js'); ?>, 'text', 'start_date', this.value); DOPBSPBackEndDiscountItemRule.init()" onblur="DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                'js'); ?>, 'text', 'start_date', this.value, true); DOPBSPBackEndDiscountItemRule.init()" />

                    <!--
                        End date
                    -->
                    <input type="text" name="<?php $DOT->echo('DOPBSP-discount-item-rule-end-date-'.$rule->id,
                                                              'attr'); ?>" id="<?php $DOT->echo('DOPBSP-discount-item-rule-end-date-'.$rule->id,
                                                                                                'attr'); ?>" class="DOPBSP-discount-item-rule-end-date dopbsp-date" value="<?php $DOT->echo($rule->end_date); ?>" style="margin-left:5px;" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                                                                                                                                                                                'js'); ?>, 'text', 'end_date', this.value);}" onchange="DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                                                                                                                                                                                                                                                                                            'js'); ?>, 'text', 'end_date', this.value)" onpaste="DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     'js'); ?>, 'text', 'end_date', this.value)" onblur="DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             'js'); ?>, 'text', 'end_date', this.value, true)" />
                    <br class="dopbsp-clear" />

                    <!--
                        Start Hour
                    -->
                    <select name="<?php $DOT->echo('DOPBSP-discount-item-rule-start-hour-'.$rule->id,
                                                   'attr'); ?>" id="<?php $DOT->echo('DOPBSP-discount-item-rule-start-hour-'.$rule->id,
                                                                                     'attr'); ?>" class="dopbsp-no-margin dopbsp-hour" onchange="DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                                     'js'); ?>, 'select', 'start_hour', this.value)">
                        <option value=""></option>
                        <?php
                        for ($i = 0; $i<count($hours); $i++){
                            ?>
                            <option value="<?php $DOT->echo($hours[$i]); ?>"<?php $DOT->echo($rule->start_hour == $hours[$i]
                                                                                                     ? ' selected="selected"'
                                                                                                     : ''); ?>><?php $DOT->echo($hours[$i]); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <script>
                        jQuery('#DOPBSP-discount-item-rule-start-hour-<?php $DOT->echo($rule->id,
                                                                                       'attr'); ?>')
                        .DOPSelect();
                    </script>

                    <!--
                        End Hour
                    -->
                    <select name="<?php $DOT->echo('DOPBSP-discount-item-rule-end-hour-'.$rule->id,
                                                   'attr'); ?>" id="<?php $DOT->echo('DOPBSP-discount-item-rule-end-hour-'.$rule->id,
                                                                                     'attr'); ?>" class="dopbsp-hour" onchange="DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                    'js'); ?>, 'select', 'end_hour', this.value)">
                        <option value=""></option>
                        <?php
                        for ($i = 0; $i<count($hours); $i++){
                            ?>
                            <option value="<?php $DOT->echo($hours[$i]); ?>"<?php $DOT->echo($rule->end_hour == $hours[$i]
                                                                                                     ? ' selected="selected"'
                                                                                                     : ''); ?>><?php $DOT->echo($hours[$i]); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <script>
                        jQuery('#DOPBSP-discount-item-rule-end-hour-<?php $DOT->echo($rule->id,
                                                                                     'attr'); ?>')
                        .DOPSelect();
                    </script>

                    <br class="dopbsp-clear" />

                    <!--
                        Operation
                    -->
                    <label for="<?php $DOT->echo('DOPBSP-discount-item-rule-operation-'.$rule->id,
                                                 'attr'); ?>" class="dopbsp-no-margin"><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_RULES_LABELS_OPERATION')); ?></label>
                    <select name="<?php $DOT->echo('DOPBSP-discount-item-rule-operation-'.$rule->id,
                                                   'attr'); ?>" id="<?php $DOT->echo('DOPBSP-discount-item-rule-operation-'.$rule->id,
                                                                                     'attr'); ?>" class="dopbsp-small" onchange="DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                     'attr'); ?>, 'select', 'operation', this.value)">
                        <option value="+"<?php $DOT->echo($rule->operation == '+'
                                                                  ? ' selected="selected"'
                                                                  : ''); ?>>+
                        </option>
                        <option value="-"<?php $DOT->echo($rule->operation == '-'
                                                                  ? ' selected="selected"'
                                                                  : ''); ?>>-
                        </option>
                    </select>
                    <script>
                        jQuery('#DOPBSP-discount-item-rule-operation-<?php $DOT->echo($rule->id,
                                                                                      'attr'); ?>')
                        .DOPSelect();
                    </script>

                    <!--
                        Price
                    -->
                    <label for="<?php $DOT->echo('DOPBSP-discount-item-rule-price-'.$rule->id,
                                                 'attr'); ?>"><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_RULES_LABELS_PRICE')); ?></label>
                    <input type="text" name="<?php $DOT->echo('DOPBSP-discount-item-rule-price-'.$rule->id,
                                                              'attr'); ?>" id="<?php $DOT->echo('DOPBSP-discount-item-rule-price-'.$rule->id,
                                                                                                'attr'); ?>" class="dopbsp-small DOPBSP-input-discount-item-rule-price" value="<?php $DOT->echo($rule->price); ?>" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                                                                                                                                                        'js'); ?>, 'text', 'price', this.value);}" onpaste="DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                                                                                                                                                                                                                                                                'js'); ?>, 'text', 'price', this.value)" onblur="DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     'js'); ?>, 'text', 'price', this.value, true)" />

                    <!--
                        Price type
                    -->
                    <label for="<?php $DOT->echo('DOPBSP-discount-item-rule-price_type-'.$rule->id); ?>"><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_RULES_LABELS_PRICE_TYPE')); ?></label>
                    <select name="<?php $DOT->echo('DOPBSP-discount-item-rule-price_type-'.$rule->id); ?>" id="<?php $DOT->echo('DOPBSP-discount-item-rule-price_type-'.$rule->id); ?>" class="dopbsp-small" onchange="DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                                                                                                           'js'); ?>, 'select', 'price_type', this.value)">
                        <option value="fixed"<?php $DOT->echo($rule->price_type == 'fixed'
                                                                      ? ' selected="selected"'
                                                                      : ''); ?>><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_RULES_PRICE_TYPE_FIXED')); ?></option>
                        <option value="percent"<?php $DOT->echo($rule->price_type == 'percent'
                                                                        ? ' selected="selected"'
                                                                        : ''); ?>><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_RULES_PRICE_TYPE_PERCENT')); ?></option>
                    </select>
                    <script>
                        jQuery('#DOPBSP-discount-item-rule-price_type-<?php $DOT->echo($rule->id,
                                                                                       'js'); ?>')
                        .DOPSelect();
                    </script>

                    <!--
                        Price by
                    -->
                    <label for="<?php $DOT->echo('DOPBSP-discount-item-rule-price_by-'.$rule->id,
                                                 'attr'); ?>"><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_RULES_LABELS_PRICE_BY')); ?></label>
                    <select name="<?php $DOT->echo('DOPBSP-discount-item-rule-price_by-'.$rule->id,
                                                   'attr'); ?>" id="<?php $DOT->echo('DOPBSP-discount-item-rule-price_by-'.$rule->id,
                                                                                     'attr'); ?>" class="dopbsp-small" onchange="DOPBSPBackEndDiscountItemRule.edit(<?php $DOT->echo($rule->id,
                                                                                                                                                                                     'js'); ?>, 'select', 'price_by', this.value)">
                        <option value="once"<?php $DOT->echo($rule->price_by == 'once'
                                                                     ? ' selected="selected"'
                                                                     : ''); ?>><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_RULES_PRICE_BY_ONCE')); ?></option>
                        <option value="period"<?php $DOT->echo($rule->price_by == 'period'
                                                                       ? ' selected="selected"'
                                                                       : ''); ?>><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEM_RULES_PRICE_BY_PERIOD')); ?></option>
                    </select>
                    <script>
                        jQuery('#DOPBSP-discount-item-rule-price_by-<?php $DOT->echo($rule->id,
                                                                                     'attr'); ?>')
                        .DOPSelect();
                    </script>
                </div>
            </li>
            <?php
        }
    }
}