<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.2
* File                    : views/settings/views-backend-settings-users.php
* File Version            : 1.0.6
* Created / Last Modified : 11 October 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end users settings views class.
*/

if (!class_exists('DOPBSPViewsBackEndSettingsUsers')){
    class DOPBSPViewsBackEndSettingsUsers extends DOPBSPViewsBackEndSettings{
        /*
         * Returns users settings template.
         *
         * @param args (array): function arguments
         *
         * @return users settings HTML
         */
        function template($args = array()){
            /*
             * Users roles for booking system permissions.
             */
            $this->templateDefault();

            /*
             * Users roles for custom posts permissions.
             */
            $this->templateCustomPosts();

            /*
             * Users
             */
            $this->templateUsers();
        }

        /*
         * Display users roles for booking system permissions.
         *
         * @return user roles HTML
         */
        function templateDefault(){
            global $wp_roles;
            global $DOPBSP;
            global $DOT;

            $roles = $wp_roles->get_names();
            ?>
            <div class="dopbsp-inputs-header dopbsp-display">
                <h3><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS')); ?></h3>
                <a href="javascript:DOPBSPBackEnd.toggleInputs('users-permissions')" id="DOPBSP-inputs-button-users-permissions" class="dopbsp-button"></a>
            </div>
            <div id="DOPBSP-inputs-users-permissions" class="dopbsp-inputs-wrapper dopbsp-hidden">
                <?php
                while ($data = current($roles)){
                    ?>
                    <div class="dopbsp-input-wrapper">
                        <input type="checkbox" name="<?php $DOT->echo('DOPBSP-settings-users-permissions-'.key($roles),
                                                                      'attr'); ?>" id="<?php $DOT->echo('DOPBSP-settings-users-permissions-'.key($roles),
                                                                                                        'attr'); ?>" onclick="DOPBSPBackEndSettingsUsers.set(0, '<?php $DOT->echo(key($roles),
                                                                                                                                                                                  'js'); ?>')" <?php $DOT->echo(get_option('DOPBSP_users_permissions_'.key($roles))>0
                                                                                                                                                                                                                        ? ' checked=checked'
                                                                                                                                                                                                                        : ''); ?> />
                        <label class="dopbsp-for-checkbox" for="<?php $DOT->echo('DOPBSP-settings-users-permissions-'.key($roles),
                                                                                 'attr'); ?>"><?php $DOT->echo(sprintf(key($roles) == 'administrator'
                                                                                                                               ? $DOPBSP->text('SETTINGS_USERS_PERMISSIONS_ADMINISTRATORS_LABEL')
                                                                                                                               : $DOPBSP->text('SETTINGS_USERS_PERMISSIONS_LABEL'),
                                                                                                                       '<strong>'.strtolower($data).'</strong>'),
                                                                                                               'content',
                                                                                                               ['strong' => '']); ?></label>
                    </div>
                    <?php
                    next($roles);
                }
                ?>
            </div>
            <?php
        }

        /*
         * Display users roles for custom posts permissions.
         *
         * @return user roles HTML
         */
        function templateCustomPosts(){
            global $wp_roles;
            global $DOPBSP;
            global $DOT;

            $roles = $wp_roles->get_names();
            ?>
            <div class="dopbsp-inputs-header dopbsp-display">
                <h3><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_CUSTOM_POSTS')); ?></h3>
                <a href="javascript:DOPBSPBackEnd.toggleInputs('users-permissions-custom-posts')" id="DOPBSP-inputs-button-users-permissions-custom-posts" class="dopbsp-button"></a>
            </div>
            <div id="DOPBSP-inputs-users-permissions-custom-posts" class="dopbsp-inputs-wrapper dopbsp-hidden">
                <?php
                while ($data = current($roles)){
                    ?>
                    <div class="dopbsp-input-wrapper">
                        <input type="checkbox" name="<?php $DOT->echo('DOPBSP-settings-users-permissions-custom_posts_'.key($roles),
                                                                      'attr'); ?>" id="<?php $DOT->echo('DOPBSP-settings-users-permissions-custom_posts_'.key($roles),
                                                                                                        'attr'); ?>" onclick="DOPBSPBackEndSettingsUsers.set(0, 'custom_posts_<?php $DOT->echo(key($roles)); ?>')" <?php $DOT->echo(get_option('DOPBSP_users_permissions_custom_posts_'.key($roles))>0
                                                                                                                                                                                                                                            ? ' checked=checked'
                                                                                                                                                                                                                                            : ''); ?> />
                        <label class="dopbsp-for-checkbox" for="<?php $DOT->echo('DOPBSP-settings-users-permissions-custom_posts_'.key($roles),
                                                                                 'attr'); ?>"><?php $DOT->echo(sprintf($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_CUSTOM_POSTS_LABEL'),
                                                                                                                       '<strong>'.strtolower($data).'</strong>'),
                                                                                                                       'content',
                                                                                                                       ['strong' => '']); ?></label>
                    </div>
                    <?php
                    next($roles);
                }
                ?>
            </div>
            <?php
        }

        /*
         * Display users template.
         *
         * @param calendar_id (integer): calendar ID
         *
         * @param user area HTML
         */
        function templateUsers($calendar_id = 0){
            global $wp_roles;
            global $DOPBSP;
            global $DOT;

            $roles = $wp_roles->get_names();

            if ($calendar_id == 0){
                ?>
                <div class="dopbsp-inputs-header dopbsp-last dopbsp-display">
                    <h3><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_INDIVIDUAL')); ?></h3>
                    <a href="javascript:DOPBSPBackEnd.toggleInputs('users')" id="DOPBSP-inputs-button-users" class="dopbsp-button"></a>
                </div>

                <div id="DOPBSP-inputs-users" class="dopbsp-inputs-wrapper dopbsp-last dopbsp-hidden">
                <?php
            }
            else{
                ?>

                <div class="dopbsp-inputs-wrapper dopbsp-last">
                <?php
            }
            ?>

            <!--
                Search by role.
            -->
            <div class="dopbsp-input-wrapper dopbsp-left">
                <label for="DOPBSP-settings-users-permissions-filters-role"><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_FILTERS_ROLE')); ?></label>
                <select name="DOPBSP-settings-users-permissions-filters-role" id="DOPBSP-settings-users-permissions-filters-role" onchange="DOPBSPBackEndSettingsUsers.get(<?php $DOT->echo($calendar_id,
                                                                                                                                                                                            'js'); ?>)">
                    <option value=""><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_FILTERS_ROLE_ALL')); ?></option>
                    <?php
                    while ($data = current($roles)){
                        if ($calendar_id === 0){
                            $DOT->echo('<option value="'.key($roles).'">'.$data.'</option>',
                                       'content',
                                       $DOT->models->allowed_html->select());
                        }
                        else{
                            if (key($roles) !== 'administrator'){
                                $DOT->echo('<option value="'.key($roles).'">'.$data.'</option>',
                                           'content',
                                           $DOT->models->allowed_html->select());
                            }
                        }
                        next($roles);
                    }
                    ?>
                </select>
                <script>jQuery('#DOPBSP-settings-users-permissions-filters-role')
                    .DOPSelect();</script>
            </div>

            <!--
                Order by.
            -->
            <div class="dopbsp-input-wrapper dopbsp-left">
                <label for="DOPBSP-settings-users-permissions-filters-order-by"><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_FILTERS_ORDER_BY')); ?></label>
                <select name="DOPBSP-settings-users-permissions-filters-order-by" id="DOPBSP-settings-users-permissions-filters-order-by" onchange="DOPBSPBackEndSettingsUsers.get(<?php $DOT->echo($calendar_id,
                                                                                                                                                                                                    'js'); ?>)">
                    <option value="email"><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_FILTERS_ORDER_BY_EMAIL')); ?></option>
                    <option value="ID"><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_FILTERS_ORDER_BY_ID')); ?></option>
                    <option value="login" selected="selected"><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_FILTERS_ORDER_BY_USERNAME')); ?></option>
                </select>
                <script>jQuery('#DOPBSP-settings-users-permissions-filters-order-by')
                    .DOPSelect();</script>
            </div>

            <!--
                Order
            -->
            <div class="dopbsp-input-wrapper dopbsp-left">
                <label for="DOPBSP-settings-users-permissions-filters-order"><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_FILTERS_ORDER')); ?></label>
                <select name="DOPBSP-settings-users-permissions-filters-order" id="DOPBSP-settings-users-permissions-filters-order" onchange="DOPBSPBackEndSettingsUsers.get(<?php $DOT->echo($calendar_id,
                                                                                                                                                                                              'js'); ?>)">
                    <option value="ASC"><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_FILTERS_ORDER_ASCENDING')); ?></option>
                    <option value="DESC"><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_FILTERS_ORDER_DESCENDING')); ?></option>
                </select>
                <script type="text/JavaScript">jQuery('#DOPBSP-settings-users-permissions-filters-order')
                    .DOPSelect();</script>
            </div>

            <!--
                Search by text.
            -->
            <div class="dopbsp-input-wrapper dopbsp-left">
                <label for="DOPBSP-settings-users-permissions-filters-search"><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_FILTERS_SEARCH')); ?></label>
                <input type="text" name="DOPBSP-settings-users-permissions-filters-search" id="DOPBSP-settings-users-permissions-filters-search" value="" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndSettingsUsers.get(<?php $DOT->echo($calendar_id,
                                                                                                                                                                                                                                                           'js'); ?>);}" onpaste="if ((event.keyCode||event.which) != 9){DOPBSPBackEndSettings.getUsers(<?php $DOT->echo($calendar_id,
                                                                                                                                                                                                                                                                                                                                                                         'js'); ?>);}" />
            </div>

            <!--
                Users list.
            -->
            <table class="dopbsp-users-table">
                <colgroup>
                    <!--<col class="column1" />-->
                    <col class="dopbsp-column2" />
                    <col class="dopbsp-column3" />
                    <col class="dopbsp-column4" />
                    <col class="dopbsp-column5" />
                    <col class="dopbsp-column6" />
                    <?php
                    if ($calendar_id == 0){
                        ?>
                        <col class="dopbsp-column7" />
                        <col class="dopbsp-column8" />
                        <?php
                    }
                    ?>
                </colgroup>
                <thead>
                    <tr>
                        <!--<th></th>-->
                        <th><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_LIST_ID')); ?></th>
                        <th><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_USERNAME')); ?></th>
                        <th><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_EMAIL')); ?></th>
                        <th><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_ROLE')); ?></th>
                        <?php
                        if ($calendar_id == 0){
                            ?>
                            <th><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_VIEW')); ?></th>
                            <th><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_USE')); ?></th>
                            <th><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_USE_CUSTOM_POSTS')); ?></th>
                            <?php
                        }
                        else{
                            ?>
                            <th><?php $DOT->echo($DOPBSP->text('SETTINGS_USERS_PERMISSIONS_USE_CALENDAR')); ?></th>
                            <?php
                        }
                        ?>
                    </tr>
                </thead>
                <tbody id="DOPBSP-users-list"></tbody>
            </table>
            </div>
            <?php
        }
    }
}