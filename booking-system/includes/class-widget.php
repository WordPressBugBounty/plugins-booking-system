<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.2.3
* File                    : includes/class-widget.php
* File Version            : 1.0.6
* Created / Last Modified : 21 April 2016
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Widget PHP class.
*/

class DOPBSPWidget extends WP_Widget{
    /*
     * Constructor
     */
    function __construct(){
        global $wpdb;
        global $DOPBSP;

        if (is_admin()){
            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $tables = $wpdb->get_results('SHOW TABLES');

            foreach ($tables as $table){
                $object_name = 'Tables_in_'.DB_NAME;
                $table_name = $table->$object_name;

                if (strrpos($table_name,
                            'dopbsp_translation') !== false){
                    if (is_admin()){
                        $DOPBSP->classes->translation->set();
                        break;
                    }
                }
            }
        }

        $widget_ops = array('classname'   => 'DOPBSPWidget',
                            'description' => $DOPBSP->text('WIDGET_DESCRIPTION'));
        parent::__construct('DOPBSPWidget',
                            $DOPBSP->text('WIDGET_TITLE'),
                            $widget_ops);
    }

    function form($instance){
        global $wpdb;
        global $DOPBSP;

        $instance = wp_parse_args((array)$instance,
                                  array('title'     => '',
                                        'selection' => 'calendar',
                                        'id'        => '0',
                                        'lang'      => DOPBSP_CONFIG_TRANSLATION_DEFAULT_LANGUAGE));
        $title = $instance['title'];
        $selection = $instance['selection'];
        $id = $instance['id'];
        $lang = $instance['lang'];
        ?>
        <!--
            Title field.
        -->
        <p>
            <label for="<?php $DOT->echo($this->get_field_id('title'),
                                         'attr'); ?>"><?php $DOT->echo($DOPBSP->text('WIDGET_TITLE_LABEL')); ?></label>
            <input class="widefat" id="<?php $DOT->echo($this->get_field_id('title'),
                                                        'attr'); ?>" name="<?php $DOT->echo($this->get_field_name('title'),
                                                                                            'attr'); ?>" type="text" value="<?php $DOT->echo(esc_attr($title),
                                                                                                                                             'attr'); ?>" />
        </p>

        <!--
            Action field.
        -->
        <p>
            <label for="<?php $DOT->echo($this->get_field_id('selection'),
                                         'attr'); ?>"><?php $DOT->echo($DOPBSP->text('WIDGET_SELECTION_LABEL')); ?></label>
            <select class="widefat" id="<?php $DOT->echo($this->get_field_id('selection'),
                                                         'attr'); ?>" name="<?php $DOT->echo($this->get_field_name('selection'),
                                                                                             'attr'); ?>" onchange="DOPBSPBackEndWidgets.display('<?php $DOT->echo($this->get_field_id('selection'),
                                                                                                                                                                   'js'); ?>', this.value)">
                <option value="calendar"<?php $DOT->echo(esc_attr($selection) == 'calendar'
                                                                 ? ' selected="selected"'
                                                                 : ''); ?>><?php $DOT->echo($DOPBSP->text('WIDGET_SELECTION_ADD_CALENDAR')); ?></option>
                <option value="sidebar"<?php $DOT->echo(esc_attr($selection) == 'sidebar'
                                                                ? ' selected="selected"'
                                                                : '') ?>><?php $DOT->echo($DOPBSP->text('WIDGET_SELECTION_ADD_SIDEBAR')); ?></option>
            </select>
        </p>

        <!--
            ID field.
        -->
        <p id="DOPBSP-widget-id-<?php $DOT->echo($this->get_field_id('selection'),
                                                 'attr'); ?>">
            <label for="<?php $DOT->echo($this->get_field_id('id'),
                                         'attr'); ?>"><?php $DOT->echo($DOPBSP->text('WIDGET_ID_LABEL')); ?></label>
            <select class="widefat" id="<?php $DOT->echo($this->get_field_id('id'),
                                                         'attr'); ?>" name="<?php $DOT->echo($this->get_field_name('id'),
                                                                                             'attr'); ?>">
                <?php
                if ($DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID,
                                                                         'use-booking-system')){
                    //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                    $calendars = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ORDER BY id DESC',
                                                                   $DOPBSP->tables->calendars));
                }
                else{
                    //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                    $calendars = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE user_id=%d ORDER BY id DESC',
                                                                   $DOPBSP->tables->calendars,
                                                                   wp_get_current_user()->ID));
                }

                if ($wpdb->num_rows != 0){
                    foreach ($calendars as $calendar){
                        if (esc_attr($id) == $calendar->id){
                            $DOT->echo('<option value="'.$calendar->id.'" selected="selected">'.$calendar->id.' - '.$calendar->name.'</option>',
                                       'content',
                                       $DOT->models->allowed_html->select());
                        }
                        else{
                            $DOT->echo('<option value="'.$calendar->id.'">'.$calendar->id.' - '.$calendar->name.'</option>',
                                       'content',
                                       $DOT->models->allowed_html->select());
                        }
                    }
                }
                else{
                    $DOT->echo('<option value="0">'.$DOPBSP->text('WIDGET_NO_CALENDARS').'</option>',
                               'content',
                               $DOT->models->allowed_html->select());
                }
                ?>

            </select>
        </p>

        <!-- Language Field -->
        <p id="DOPBSP-widget-lang-<?php $DOT->echo($this->get_field_id('selection'),
                                                   'attr'); ?>">
            <label for="<?php $DOT->echo($this->get_field_id('lang'),
                                         'attr'); ?>"><?php $DOT->echo($DOPBSP->text('WIDGET_LANGUAGE_LABEL')); ?></label>
            <select class="widefat" id="<?php $DOT->echo($this->get_field_id('lang'),
                                                         'attr'); ?>" name="<?php $DOT->echo($this->get_field_name('lang'),
                                                                                             'attr'); ?>">
                <?php $DOT->echo($this->getLanguages(esc_attr($lang)),
                                 'content',
                                 $DOT->models->allowed_html->select()); ?>
            </select>
        </p>

        <!-- Form Configuration Script -->
        <script>
            jQuery(document)
            .ready(function(){
                dopbspConfigureWidgetForm('<?php $DOT->echo($this->get_field_id('selection'),
                                                            'js');?>',
                                          '<?php $DOT->echo(esc_attr($selection),
                                                            'attr');?>');
            });

            function dopbspConfigureWidgetForm(id,
                                               selection){
                const $id   = jQuery('#DOPBSP-widget-id-'+id),
                      $lang = jQuery('#DOPBSP-widget-lang-'+id);

                $id.css('display',
                        'none');
                $lang.css('display',
                          'none');

                switch (selection){
                    case 'calendar':
                        $id.css('display',
                                'block');
                        $lang.css('display',
                                  'block');
                        break;
                    case 'sidebar':
                        $id.css('display',
                                'block');
                        break;
                }
            }
        </script>
        <?php
    }

    function update($new_instance,
                    $old_instance){
        $instance = $old_instance;

        $instance['title'] = $new_instance['title'];
        $instance['selection'] = $new_instance['selection'];
        $instance['id'] = $new_instance['id'];
        $instance['lang'] = $new_instance['lang'];

        return $instance;
    }

    function widget($args,
                    $instance){
        extract($args,
                EXTR_SKIP);

        $DOT->echo($before_widget);

        $title = empty($instance['title'])
                ? ' '
                : apply_filters('widget_title',
                                $instance['title']);
        $selection = empty($instance['selection'])
                ? 'calendar'
                : $instance['selection'];
        $id = empty($instance['id'])
                ? '0'
                : $instance['id'];
        $lang = empty($instance['lang'])
                ? DOPBSP_CONFIG_TRANSLATION_DEFAULT_LANGUAGE
                : $instance['lang'];

        if (!empty($title)){
            $DOT->echo($before_title.$title.$after_title);
        }

        switch ($selection){
            case 'calendar':
                echo do_shortcode('[dopbsp id="'.$id.'" lang="'.$lang.'"]');
                break;
            case 'sidebar':
                $DOT->echo('<div class="DOPBSPCalendar-outer-sidebar" id="DOPBSPCalendar-outer-sidebar'.$id.'"></div>',
                           'content',
                           [
                                   'div' => ['class' => [],
                                             'id'    => []]
                           ]);
                break;
        }

        $DOT->echo($after_widget);
    }

    function getLanguages($current_language){ // List languages select.
        global $wpdb;
        global $DOPBSP;

        $HTML = array();

        $languages = $DOPBSP->classes->languages->languages;

        //phpcs:ignore WordPress.DB.DirectDatabaseQuery
        $enabled_languages = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE enabled="true"',
                                                               $DOPBSP->tables->languages));

        foreach ($enabled_languages as $enabled_language){
            for ($i = 0; $i<count($languages); $i++){
                if ($enabled_language->code == $languages[$i]['code']){
                    $HTML[] = '<option value="'.$languages[$i]['code'].'"'.($current_language == $languages[$i]['code']
                                    ? ' selected="selected"'
                                    : '').'>'.$languages[$i]['name'].'</option>';
                    break;
                }
            }
        }

        return implode('',
                       $HTML);
    }
}