<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.2
* File                    : views/translation/views-backend-translation.php
* File Version            : 1.0.6
* Created / Last Modified : 11 October 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end translation views class.
*/

if (!class_exists('DOPBSPViewsBackEndTranslation')){
    class DOPBSPViewsBackEndTranslation extends DOPBSPViewsBackEnd{
        /*
         * Returns translation template.
         *
         * @return translation HTML page
         */
        function template(){
            global $wpdb;
            global $DOPBSP;
            global $DOT;

            $text_groups_options_HTML = array();

            $this->getTranslation();
            ?>
            <div class="wrap DOPBSP-admin">

                <!--
                    Header
                -->
                <?php $this->displayHeader($DOPBSP->text('TITLE'),
                                           $DOPBSP->text('TRANSLATION_TITLE')); ?>

                <!--
                    Content
                -->
                <div class="dopbsp-main dopbsp-hidden">
                    <div class="dopbsp-translation-header">

                        <!--
                            Buttons
                        -->
                        <a href="<?php $DOT->echo(DOPBSP_CONFIG_HELP_DOCUMENTATION_URL,
                                                  'url'); ?>" target="_blank" class="dopbsp-button dopbsp-help dopbsp-right">
                            <span class="dopbsp-info dopbsp-help">
                                <?php $DOT->echo($DOPBSP->text('TRANSLATION_HELP')); ?>
                                <br /><br /
                                <?php $DOT->echo($DOPBSP->text('TRANSLATION_SEARCH_HELP')); ?>
                                <br /><br />
                                <?php $DOT->echo($DOPBSP->text('LANGUAGES_HELP')); ?>
                                <br /><br />
                                <?php $DOT->echo($DOPBSP->text('TRANSLATION_RESET_HELP')); ?>
                                <br /><br />
                                <?php $DOT->echo($DOPBSP->text('HELP_VIEW_DOCUMENTATION')); ?>
                            </span>
                        </a>
                        <input type="button" name="DOPBSP-translation-check" id="DOPBSP-translation-check" class="dopbsp-right" value="Check translation" onclick="DOPBSPBackEndTranslation.check()" />
                        <input type="button" name="DOPBSP-translation-reset" id="DOPBSP-translation-reset" class="dopbsp-right" value="<?php $DOT->echo($DOPBSP->text('TRANSLATION_RESET',
                                                                                                                                                                      'Reset translation')); ?>" onclick="DOPBSPBackEnd.confirmation('TRANSLATION_RESET_CONFIRMATION', 'DOPBSPBackEndTranslation.reset()')" />
                        <input type="button" name="DOPBSP-translation-manage-languages" id="DOPBSP-translation-manage-languages" class="dopbsp-right" value="<?php $DOT->echo($DOPBSP->text('LANGUAGES_MANAGE')); ?>" onclick="DOPBSPBackEndLanguages.display()" />
                        <input type="button" name="DOPBSP-translation-manage-translation" id="DOPBSP-translation-manage-translation" value="<?php $DOT->echo($DOPBSP->text('TRANSLATION_SUBMIT')); ?>" onclick="DOPBSPBackEndTranslation.display()" />

                        <!--
                            Language select.
                        -->
                        <div id="DOPBSP-translation-manage-language" class="dopbsp-input-wrapper dopbsp-left">
                            <label for="DOPBSP-translation-language"><?php $DOT->echo($DOPBSP->text('TRANSLATION_LANGUAGE')); ?></label>
                            <?php $DOT->echo($this->getLanguages('DOPBSP-translation-language',
                                                                 'DOPBSPBackEndTranslation.display()',
                                                                 '',
                                                                 'dopbsp-left'),
                                             'content',
                                             $DOT->models->allowed_html->select()); ?>
                        </div>

                        <!--
                            Text group select.
                        -->
                        <div id="DOPBSP-translation-manage-text-group" class="dopbsp-input-wrapper dopbsp-left">
                            <label for="DOPBSP-translation-location"><?php $DOT->echo($DOPBSP->text('TRANSLATION_TEXT_GROUP')); ?></label>
                            <select name="DOPBSP-translation-text-group" id="DOPBSP-translation-text-group" class="dopbsp-left" onchange="DOPBSPBackEndTranslation.display()">
                                <?php
                                if (DOPBSP_CONFIG_TRANSLATION_DISPLAY_ALL){
                                    $DOT->echo('<option value="all">'.$DOPBSP->text('TRANSLATION_TEXT_GROUP_ALL').'</option>',
                                               'content',
                                               $DOT->models->allowed_html->select());
                                }

                                $language = $DOPBSP->classes->backend_language->get();

                                //phpcs:ignore WordPress.DB.DirectDatabaseQuery
                                $text_groups = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i WHERE parent_key="" ORDER BY translation ASC',
                                                                     $DOPBSP->tables->translation.'_'.$language));

                                $i = 0;

                                foreach ($text_groups as $text_group){
                                    $i++;
                                    $text_groups_options_HTML[] = '<option value="'.$text_group->key_data.'"'.(!DOPBSP_CONFIG_TRANSLATION_DISPLAY_START_ALL && $i == 1
                                                    ? ' selected="selected"'
                                                    : '').'>'.$text_group->translation.'</option>';
                                }
                                $DOT->echo(implode('',
                                                   $text_groups_options_HTML),
                                           'content',
                                           $DOT->models->allowed_html->select());
                                ?>
                            </select>
                            <script type="text/JavaScript">jQuery('#DOPBSP-translation-text-group')
                                .DOPSelect();</script>
                        </div>

                        <!--
                            Search
                        -->
                        <div id="DOPBSP-translation-manage-search" class="dopbsp-input-wrapper dopbsp-left">
                            <label for="DOPBSP-translation-search"><?php $DOT->echo($DOPBSP->text('TRANSLATION_SEARCH')); ?></label>
                            <input type="text" name="DOPBSP-translation-search" id="DOPBSP-translation-search" class="dopbsp-left" value="" onkeyup="DOPBSPBackEndTranslation.search()" />
                        </div>
                    </div>
                    <div class="dopbsp-translation-content" id="DOPBSP-translation-content"></div>
                </div>
            </div>
            <?php
        }

        /*
         * Returns translation text.
         *
         * @param args (array): function arguments
         *                      * language (string): selected language
         *                      * translation (object): translation for selected language
         *
         * @return translation text HTML list
         */
        function text($args = array()){
            global $DOPBSP;
            global $DOT;

            $language = $args['language'];
            $translation = $args['translation'];
            ?>
            <table class="dopbsp-translation">
                <colgroup>
                    <col />
                    <col class="dopbsp-separator" />
                    <col />
                </colgroup>
                <tbody>
                    <?php
                    foreach ($translation as $item){
                        $translation_text = stripslashes($item->translation);
                        $translation_text = str_replace('<<single-quote>>',
                                                        "'",
                                                        $translation_text);
                        $translation_text = str_replace('<br />',
                                                        "\n",
                                                        $translation_text);
                        ?>
                        <tr>
                            <td>
                                <?php $DOT->echo(($item->parent_key == 'none' || $item->parent_key == ''
                                                         ? ''
                                                         : '<span class="dopbsp-hint">['.$DOPBSP->text($item->parent_key).']</span>').' '.str_replace('<<single-quote>>',
                                                                                                                                                      "'",
                                                                                                                                                      stripslashes($item->text_data)),
                                                 'content',
                                                 [
                                                         'span' => ['class' => ''],
                                                 ]); ?>
                            </td>
                            <td class="dopbsp-separator"></td>
                            <td>
                                <textarea name="<?php $DOT->echo('DOPBSP-translation-'.$item->id,
                                                                 'attr'); ?>" id="<?php $DOT->echo('DOPBSP-translation-'.$item->id,
                                                                                                   'attr'); ?>" rows="1" cols="" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPBackEndTranslation.edit(<?php $DOT->echo($item->id,
                                                                                                                                                                                                                                 'js'); ?>, '<?php $DOT->echo($language,
                                                                                                                                                                                                                                                              'js'); ?>', this.value);}" onpaste="DOPBSPBackEndTranslation.edit(<?php $DOT->echo($item->id,
                                                                                                                                                                                                                                                                                                                                                 'js'); ?>, '<?php $DOT->echo($language,
                                                                                                                                                                                                                                                                                                                                                                              'js'); ?>', this.value)" onblur="DOPBSPBackEndTranslation.edit(<?php $DOT->echo($item->id,
                                                                                                                                                                                                                                                                                                                                                                                                                                                              'js'); ?>, '<?php $DOT->echo($language,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           'js'); ?>', this.value, true)"><?php $DOT->echo($translation_text,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           'textarea'); ?></textarea>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        }
    }
}