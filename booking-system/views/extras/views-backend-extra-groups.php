<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.2
* File                    : views/extras/views-backend-extra-groups.php
* File Version            : 1.0.6
* Created / Last Modified : 11 October 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end extra groups views class.
*/

if (!class_exists('DOPBSPViewsBackEndExtraGroups')){
    class DOPBSPViewsBackEndExtraGroups extends DOPBSPViewsBackEndExtra{
        /*
         * Returns extra groups template.
         *
         * @param args (array): function arguments
         *                      * id (integer): extra ID
         *                      * language (string): extra language
         *
         * @return extra groups HTML
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
            <div class="dopbsp-extra-groups-header">
                <a href="javascript:DOPBSPBackEndExtraGroup.add(<?php $DOT->echo($id,
                                                                                 'js'); ?>, '<?php $DOT->echo($language,
                                                                                                              'js'); ?>')" class="dopbsp-button dopbsp-add">
                    <span class="dopbsp-info"><?php $DOT->echo($DOPBSP->text('EXTRAS_EXTRA_ADD_GROUP_SUBMIT')); ?></span>
                </a>
                <h3><?php $DOT->echo($DOPBSP->text('EXTRAS_EXTRA_GROUPS')); ?></h3>
            </div>
            <ul id="DOPBSP-extra-groups" class="dopbsp-extra-groups">
                <?php
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $groups = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE extra_id=%d ORDER BY position ASC',
                                                            $DOPBSP->tables->extras_groups,
                                                            $id));

                if ($wpdb->num_rows>0){
                    foreach ($groups as $group){
                        $DOPBSP->views->backend_extra_group->template(array('group'    => $group,
                                                                            'language' => $language));
                    }
                }
                ?>
            </ul>
            <?php
        }
    }
}