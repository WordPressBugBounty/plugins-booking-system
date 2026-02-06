<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.8
* File                    : views/dashboard/views-backend-dashboard-start.php
* File Version            : 1.0.9
* Created / Last Modified : 15 March 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end dashboard views class.
*/

if (!class_exists('DOPBSPViewsBackEndDashboardStart')){
    class DOPBSPViewsBackEndDashboardStart extends DOPBSPViewsBackEndDashboard{
        /*
         * Returns dashboard start template.
         *
         * @param args (array): function arguments
         *
         * @return dashboard start HTML template
         */
        function template($args = array()){
            global $DOPBSP;
            global $DOT;
            ?>
            <section class="dopbsp-content-wrapper">
                <h3><?php $DOT->echo($DOPBSP->text('DASHBOARD_SUBTITLE')); ?></h3>
                <p><?php $DOT->echo($DOPBSP->text('DASHBOARD_TEXT')); ?></p>

                <div id="DOPBSP-get-started" class="dopbsp-left">
                    <h4><?php $DOT->echo($DOPBSP->text('DASHBOARD_GET_STARTED')); ?></h4>
                    <ul>
                        <li>
                            <a href="<?php $DOT->echo(admin_url('admin.php?page=dopbsp-calendars')); ?>">
                                <span class="dopbsp-icon dopbsp-calendars"></span>
                                <?php $DOT->echo($DOPBSP->text('DASHBOARD_GET_STARTED_CALENDARS')); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php $DOT->echo(admin_url('admin.php?page=dopbsp-locations'),
                                                      'url'); ?>">
                                <span class="dopbsp-icon dopbsp-locations"></span>
                                <?php $DOT->echo($DOPBSP->text('DASHBOARD_GET_STARTED_LOCATIONS')); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php $DOT->echo(admin_url('admin.php?page=dopbsp-reservations'),
                                                      'url'); ?>">
                                <span class="dopbsp-icon dopbsp-reservations"></span>
                                <?php $DOT->echo($DOPBSP->text('DASHBOARD_GET_STARTED_RESERVATIONS')); ?>
                            </a>
                        </li>
                    </ul>
                </div>

                <div id="DOPBSP-more-actions" class="dopbsp-left">
                    <h4><?php $DOT->echo($DOPBSP->text('DASHBOARD_MORE_ACTIONS')); ?></h4>
                    <ul>
                        <li>
                            <a href="<?php $DOT->echo(admin_url('admin.php?page=dopbsp-coupons'),
                                                      'url'); ?>">
                                <span class="dopbsp-icon dopbsp-coupons"></span>
                                <?php $DOT->echo($DOPBSP->text('DASHBOARD_MORE_ACTIONS_COUPONS')); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php $DOT->echo(admin_url('admin.php?page=dopbsp-discounts'),
                                                      'url'); ?>">
                                <span class="dopbsp-icon dopbsp-discounts"></span>
                                <?php $DOT->echo($DOPBSP->text('DASHBOARD_MORE_ACTIONS_DISCOUNTS')); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php $DOT->echo(admin_url('admin.php?page=dopbsp-emails'),
                                                      'url'); ?>">
                                <span class="dopbsp-icon dopbsp-emails"></span>
                                <?php $DOT->echo($DOPBSP->text('DASHBOARD_MORE_ACTIONS_EMAILS')); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php $DOT->echo(admin_url('admin.php?page=dopbsp-extras'),
                                                      'url'); ?>">
                                <span class="dopbsp-icon dopbsp-extras"></span>
                                <?php $DOT->echo($DOPBSP->text('DASHBOARD_MORE_ACTIONS_EXTRAS')); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php $DOT->echo(admin_url('admin.php?page=dopbsp-forms'),
                                                      'url'); ?>">
                                <span class="dopbsp-icon dopbsp-forms"></span>
                                <?php $DOT->echo($DOPBSP->text('DASHBOARD_MORE_ACTIONS_FORMS')); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php $DOT->echo(admin_url('admin.php?page=dopbsp-rules'),
                                                      'url'); ?>">
                                <span class="dopbsp-icon dopbsp-rules"></span>
                                <?php $DOT->echo($DOPBSP->text('DASHBOARD_MORE_ACTIONS_RULES')); ?>
                            </a>
                        </li>
                        <!--
                        <li>
                            <a href="<?php $DOT->echo(admin_url('admin.php?page=dopbsp-search'),
                                                      'url'); ?>">
                                <span class="dopbsp-icon dopbsp-search"></span>
                                <?php $DOT->echo($DOPBSP->text('DASHBOARD_MORE_ACTIONS_SEARCH')); ?>
                            </a>
                        </li>
                        -->
                        <li>
                            <a href="<?php $DOT->echo(admin_url('admin.php?page=dopbsp-fees'),
                                                      'url'); ?>">
                                <span class="dopbsp-icon dopbsp-fees"></span>
                                <?php $DOT->echo($DOPBSP->text('DASHBOARD_MORE_ACTIONS_FEES')); ?>
                            </a>
                        </li>
                        <?php
                        if ($DOPBSP->vars->role_action == 'manage_options'){
                            ?>
                            <li>
                                <a href="<?php $DOT->echo(admin_url('admin.php?page=dopbsp-settings'),
                                                          'url'); ?>">
                                    <span class="dopbsp-icon dopbsp-settings"></span>
                                    <?php $DOT->echo($DOPBSP->text('DASHBOARD_MORE_ACTIONS_SETTINGS')); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php $DOT->echo(admin_url('admin.php?page=dopbsp-translation'),
                                                          'url'); ?>">
                                    <span class="dopbsp-icon dopbsp-translation"></span>
                                    <?php $DOT->echo($DOPBSP->text('DASHBOARD_MORE_ACTIONS_TRANSLATION')); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php $DOT->echo(admin_url('admin.php?page=dopbsp-tools'),
                                                          'url'); ?>">
                                    <span class="dopbsp-icon dopbsp-tools"></span>
                                    <?php $DOT->echo($DOPBSP->text('DASHBOARD_MORE_ACTIONS_TOOLS')); ?>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </section>
            <?php
        }
    }
}