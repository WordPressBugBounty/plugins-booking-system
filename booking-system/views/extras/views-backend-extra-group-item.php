<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.2
* File                    : views/extras/views-backend-extra-group-item.php
* File Version            : 1.0.7
* Created / Last Modified : 11 October 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end extra group item views class.
*/

if (!class_exists('DOPBSPViewsBackEndExtraGroupItem')){
    class DOPBSPViewsBackEndExtraGroupItem extends DOPBSPViewsBackEndExtraGroup{
        /*
         * Returns group item template.
         *
         * @param args (array): function arguments
         *                      * item (integer): select data
         *                      * language (string): group language
         *
         * @return select group HTML
         */
        function template($args = array()){
            global $DOPBSP;
            global $DOT;

            $item = $args['item'];
            $language = isset($args['language']) && $args['language'] != ''
                    ? $args['language']
                    : $DOPBSP->classes->backend_language->get();
            ?>
            <li id="<?php $DOT->echo('DOPBSP-extra-group-item-'.$item->id,
                                     'attr'); ?>" class="dopbsp-group-item-wrapper">
                <div class="dopbsp-input-wrapper">

                    <!--
                        Label
                    -->
                    <input type="text" name="<?php $DOT->echo('DOPBSP-extra-group-item-label-'.$item->id,
                                                              'attr'); ?>" id="<?php $DOT->echo('DOPBSP-extra-group-item-label-'.$item->id,
                                                                                                'attr'); ?>" value="<?php $DOT->echo($DOPBSP->classes->translation->decodeJSON($item->translation,
                                                                                                                                                                               $language)); ?>" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndExtraGroupItem.edit(<?php $DOT->echo($item->id,
                                                                                                                                                                                                                                                                                                   'js'); ?>, 'text', 'label', this.value);}" onpaste="DOPBSPBackEndExtraGroupItem.edit(<?php $DOT->echo($item->id,
                                                                                                                                                                                                                                                                                                                                                                                                         'js'); ?>, 'text', 'label', this.value)" onblur="DOPBSPBackEndExtraGroupItem.edit(<?php $DOT->echo($item->id,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            'js'); ?>, 'text', 'label', this.value, true)" />

                    <!--
                        Operation
                    -->
                    <select name="<?php $DOT->echo('DOPBSP-extra-group-item-operation-'.$item->id,
                                                   'attr'); ?>" id="<?php $DOT->echo('DOPBSP-extra-group-item-operation-'.$item->id,
                                                                                     'attr'); ?>" class="dopbsp-small" onchange="DOPBSPBackEndExtraGroupItem.edit(<?php $DOT->echo($item->id,
                                                                                                                                                                                   'js'); ?>, 'select', 'operation', this.value)">
                        <option value="+"<?php $DOT->echo($item->operation == '+'
                                                                  ? ' selected="selected"'
                                                                  : ''); ?>>+
                        </option>
                        <option value="-"<?php $DOT->echo($item->operation == '-'
                                                                  ? ' selected="selected"'
                                                                  : ''); ?>>-
                        </option>
                    </select>
                    <script>
                        jQuery('#DOPBSP-extra-group-item-operation-<?php $DOT->echo($item->id,
                                                                                    'js'); ?>')
                        .DOPSelect();
                    </script>

                    <!--
                        Price
                    -->
                    <input type="text" name="<?php $DOT->echo('DOPBSP-extra-group-item-price-'.$item->id,
                                                              'attr'); ?>" id="<?php $DOT->echo('DOPBSP-extra-group-item-price-'.$item->id,
                                                                                                'attr'); ?>" class="dopbsp-small DOPBSP-input-extra-group-item-price" value="<?php $DOT->echo($item->price); ?>" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndExtraGroupItem.edit(<?php $DOT->echo($item->id,
                                                                                                                                                                                                                                                                                                                    'js'); ?>, 'text', 'price', this.value);}" onpaste="DOPBSPBackEndExtraGroupItem.edit(<?php $DOT->echo($item->id,
                                                                                                                                                                                                                                                                                                                                                                                                                          'js'); ?>, 'text', 'price', this.value)" onblur="DOPBSPBackEndExtraGroupItem.edit(<?php $DOT->echo($item->id,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             'js'); ?>, 'text', 'price', this.value, true)" />

                    <!--
                        Price type
                    -->
                    <select name="<?php $DOT->echo('DOPBSP-extra-group-item-price_type-'.$item->id,
                                                   'attr'); ?>" id="<?php $DOT->echo('DOPBSP-extra-group-item-price_type-'.$item->id,
                                                                                     'attr'); ?>" class="dopbsp-small" onchange="DOPBSPBackEndExtraGroupItem.edit(<?php $DOT->echo($item->id,
                                                                                                                                                                                   'js'); ?>, 'select', 'price_type', this.value)">
                        <option value="fixed"<?php $DOT->echo($item->price_type == 'fixed'
                                                                      ? ' selected="selected"'
                                                                      : ''); ?>><?php $DOT->echo($DOPBSP->text('EXTRAS_EXTRA_GROUP_ITEMS_PRICE_TYPE_FIXED')); ?></option>
                        <option value="percent"<?php $DOT->echo($item->price_type == 'percent'
                                                                        ? ' selected="selected"'
                                                                        : ''); ?>><?php $DOT->echo($DOPBSP->text('EXTRAS_EXTRA_GROUP_ITEMS_PRICE_TYPE_PERCENT')); ?></option>
                    </select>
                    <script>
                        jQuery('#DOPBSP-extra-group-item-price_type-<?php $DOT->echo($item->id,
                                                                                     'js'); ?>')
                        .DOPSelect();
                    </script>

                    <!--
                        Price by
                    -->
                    <select name="<?php $DOT->echo('DOPBSP-extra-group-item-price_by-'.$item->id,
                                                   'attr'); ?>" id="<?php $DOT->echo('DOPBSP-extra-group-item-price_by-'.$item->id,
                                                                                     'attr'); ?>" class="dopbsp-small" onchange="DOPBSPBackEndExtraGroupItem.edit(<?php $DOT->echo($item->id,
                                                                                                                                                                                   'js'); ?>, 'select', 'price_by', this.value)">
                        <option value="once"<?php $DOT->echo($item->price_by == 'once'
                                                                     ? ' selected="selected"'
                                                                     : ''); ?>><?php $DOT->echo($DOPBSP->text('EXTRAS_EXTRA_GROUP_ITEMS_PRICE_BY_ONCE')); ?></option>
                        <option value="period"<?php $DOT->echo($item->price_by == 'period'
                                                                       ? ' selected="selected"'
                                                                       : ''); ?>><?php $DOT->echo($DOPBSP->text('EXTRAS_EXTRA_GROUP_ITEMS_PRICE_BY_PERIOD')); ?></option>
                    </select>
                    <script>
                        jQuery('#DOPBSP-extra-group-item-price_by-<?php $DOT->echo($item->id,
                                                                                   'js'); ?>')
                        .DOPSelect();
                    </script>

                    <!--
                        Default value
                    -->
                    <select name="<?php $DOT->echo('DOPBSP-extra-group-item-default_value-'.$item->id,
                                                   'attr'); ?>" id="<?php $DOT->echo('DOPBSP-extra-group-item-default_value-'.$item->id,
                                                                                     'attr'); ?>" class="dopbsp-small" onchange="DOPBSPBackEndExtraGroupItem.edit(<?php $DOT->echo($item->id,
                                                                                                                                                                                   'js'); ?>, 'select', 'default_value', this.value)">
                        <option value="no"<?php $DOT->echo($item->default_value == 'no'
                                                                   ? ' selected="selected"'
                                                                   : ''); ?>><?php $DOT->echo($DOPBSP->text('EXTRAS_EXTRA_GROUP_ITEMS_DEFAULT_NO')); ?></option>
                        <option value="yes"<?php $DOT->echo($item->default_value == 'yes'
                                                                    ? ' selected="selected"'
                                                                    : ''); ?>><?php $DOT->echo($DOPBSP->text('EXTRAS_EXTRA_GROUP_ITEMS_DEFAULT_YES')); ?></option>
                    </select>
                    <script>
                        jQuery('#DOPBSP-extra-group-item-default_value-<?php $DOT->echo($item->id,
                                                                                        'js'); ?>')
                        .DOPSelect();
                    </script>
                    <a href="javascript:DOPBSPBackEnd.confirmation('EXTRAS_EXTRA_GROUP_DELETE_ITEM_CONFIRMATION', 'DOPBSPBackEndExtraGroupItem.delete(<?php $DOT->echo($item->id,
                                                                                                                                                                       'js'); ?>)')" class="dopbsp-button dopbsp-small dopbsp-delete">
                        <span class="dopbsp-info"><?php $DOT->echo($DOPBSP->text('EXTRAS_EXTRA_GROUP_DELETE_ITEM_SUBMIT')); ?></span>
                    </a>
                    <a href="javascript:void(0)" class="dopbsp-button dopbsp-small dopbsp-handle">
                        <span class="dopbsp-info"><?php $DOT->echo($DOPBSP->text('EXTRAS_EXTRA_GROUP_ITEM_SORT')); ?></span>
                    </a>
                </div>
            </li>
            <?php
        }
    }
}