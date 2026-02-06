<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.2
* File                    : views/discounts/views-backend-discount-items.php
* File Version            : 1.0.6
* Created / Last Modified : 11 October 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end discount items views class.
*/

if (!class_exists('DOPBSPViewsBackEndDiscountItems')){
    class DOPBSPViewsBackEndDiscountItems extends DOPBSPViewsBackEndDiscount{
        /*
         * Returns discount items template.
         *
         * @param args (array): function arguments
         *                      * id (integer): discount ID
         *                      * language (string): discount language
         *
         * @return discount items HTML
         */
        function template($args = array()){
            global $wpdb;
            global $DOPBSP;
            global $DOT;

            $id = $args['id'];
            $language = isset($args['language']) && $args['language'] != ''
                    ? $args['language']
                    : $DOPBSP->classes->backend_language->get();
            ?>
            <div class="dopbsp-discount-items-header">
                <a href="javascript:DOPBSPBackEndDiscountItem.add(<?php $DOT->echo($id,
                                                                                   'js'); ?>, '<?php $DOT->echo($language,
                                                                                                                'js'); ?>')" class="dopbsp-button dopbsp-add">
                    <span class="dopbsp-info"><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ADD_ITEM_SUBMIT')); ?></span>
                </a>
                <h3><?php $DOT->echo($DOPBSP->text('DISCOUNTS_DISCOUNT_ITEMS')); ?></h3>
            </div>
            <ul id="DOPBSP-discount-items" class="dopbsp-discount-items">
                <?php
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $items = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE discount_id=%d ORDER BY position ASC',
                                                           $DOPBSP->tables->discounts_items,
                                                           $id));

                if ($wpdb->num_rows>0){
                    foreach ($items as $item){
                        $DOPBSP->views->backend_discount_item->template(array('item'     => $item,
                                                                              'language' => $language));
                    }
                }
                ?>
            </ul>
            <?php
        }
    }
}