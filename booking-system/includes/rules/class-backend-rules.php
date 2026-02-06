<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.2.4
* File                    : includes/rules/class-backend-rules.php
* File Version            : 1.0.7
* Created / Last Modified : 04 May 2016
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end rules PHP class.
*/

if (!class_exists('DOPBSPBackEndRules')){
    class DOPBSPBackEndRules{
        /*
         * Constructor
         */
        function __construct(){
        }

        /*
         * Prints out the rules page.
         *
         * @return HTML page
         */
        function view(){
            global $DOPBSP;

            $DOPBSP->views->backend_rules->template();
        }

        /*
         * Display rules list.
         *
         * @return rules list HTML
         */
        function display(){
            global $wpdb;
            global $DOPBSP;
            global $DOT;

            /*
             * Verify nonce.
             */
            $nonce = $DOT->post('nonce');

            if (!wp_verify_nonce($nonce,
                                 'dopbsp_user_nonce')){
                return false;
            }
            /*
             * End verify nonce.
             */

            $html = array();
            $user_roles = array_values(wp_get_current_user()->roles);

            if ($user_roles[0] == 'administrator'){
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $rules = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id DESC',
                                                           $DOPBSP->tables->rules));
            }
            else{
                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                $rules = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d OR user_id=0 ORDER BY id DESC',
                                                           $DOPBSP->tables->rules,
                                                           wp_get_current_user()->ID));
            }

            /*
             * Create rules list HTML.
             */
            $html[] = '<ul>';

            if ($wpdb->num_rows != 0){
                if ($rules){
                    foreach ($rules as $rule){
                        $html[] = $this->listItem($rule);
                    }
                }
            }
            else{
                $html[] = '<li class="dopbsp-no-data">'.$DOPBSP->text('RULES_NO_RULES').'</li>';
            }
            $html[] = '</ul>';

            $DOT->echo(implode('',
                               $html),
                       'content',
                       $DOT->models->allowed_html->items());

            die();
        }

        /*
         * Returns rules list item HTML.
         *
         * @param rule (object): rule data
         *
         * @return rule list item HTML
         */
        function listItem($rule){
            global $DOPBSP;

            $html = array();
            $user = get_userdata($rule->user_id); // Get data about the user who created the rules.

            $html[] = '<li class="dopbsp-item" id="DOPBSP-rule-ID-'.$rule->id.'" onclick="DOPBSPBackEndRule.display('.$rule->id.')">';
            $html[] = ' <div class="dopbsp-header">';

            /*
             * Display rule ID.
             */
            $html[] = '     <span class="dopbsp-id">ID: '.$rule->id.'</span>';

            /*
             * Display data about the user who created the rule.
             */
            if ($rule->user_id>0){
                $html[] = '     <span class="dopbsp-header-item dopbsp-avatar">'.get_avatar($rule->user_id,
                                                                                            17);
                $html[] = '         <span class="dopbsp-info">'.$DOPBSP->text('RULES_CREATED_BY').': '.$user->data->display_name.'</span>';
                $html[] = '         <br class="dopbsp-clear" />';
                $html[] = '     </span>';
            }
            $html[] = '     <br class="dopbsp-clear" />';
            $html[] = ' </div>';
            $html[] = ' <div class="dopbsp-name">'.($rule->name == ''
                            ? '&nbsp;'
                            : $rule->name).'</div>';
            $html[] = '</li>';

            return implode('',
                           $html);
        }
    }
}