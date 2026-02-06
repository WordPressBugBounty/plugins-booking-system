<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.1.2
* File                    : views/languages/views-backend-languages.php
* File Version            : 1.0.2
* Created / Last Modified : 11 October 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end languages views class.
*/

if (!class_exists('DOPBSPViewsBackEndLanguages')){
    class DOPBSPViewsBackEndLanguages extends DOPBSPViewsBackEnd{
        /*
         * Returns languages template.
         *
         * @param args (array): function arguments
         *                      * languages (string): languages list
         *
         * @return languages HTML list
         */
        function template($args = array()){
            global $DOPBSP;
            global $DOT;

            $languages = $args['languages'];
            ?>
            <table class="dopbsp-languages">
                <colgroup>
                    <col />
                    <col class="dopbsp-separator" />
                    <col />
                    <col class="dopbsp-separator" />
                    <col />
                    <col class="dopbsp-separator" />
                    <col />
                </colgroup>
                <tbody>
                    <?php
                    $i = 0;

                    foreach ($languages as $language){
                        $i++;

                        if ($i%4 == 1){
                            ?>
                            <tr>
                            <?php
                        }

                        if ($i%4 != 1){
                            ?>
                            <td class="dopbsp-separator"></td>
                            <?php
                        }
                        ?>
                        <td>
                            <div class="dopbsp-input-wrapper">
                                <label class="dopbsp-for-switch"><?php $DOT->echo($language->name); ?></label>
                                <?php
                                if ($language->code != DOPBSP_CONFIG_TRANSLATION_DEFAULT_LANGUAGE){
                                    ?>
                                    <div class="dopbsp-switch">
                                        <input type="checkbox" name="<?php $DOT->echo('DOPBSP-translation-language-'.$language->code,'attr'); ?>" id="<?php $DOT->echo('DOPBSP-translation-language-'.$language->code,'attr'); ?>" class="dopbsp-switch-checkbox"<?php $DOT->echo($language->enabled == 'true'
                                                ? ' checked="checked"'
                                                : ''); ?>" onchange="DOPBSPBackEndLanguage.set('<?php $DOT->echo($language->code,'js'); ?>')" />
                                        <label class="dopbsp-switch-label" for="<?php $DOT->echo('DOPBSP-translation-language-'.$language->code,'attr'); ?>">
                                            <div class="dopbsp-switch-inner"></div>
                                            <div class="dopbsp-switch-switch"></div>
                                        </label>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </td>
                        <?php
                        if ($i%4 == 0){
                            ?>
                            </tr>
                            <?php
                        }
                    }

                    switch ($i%4){
                        case 0:
                            ?>
                            </tr>
                            <?php
                            break;
                        case 1:
                            ?>
                            <td class="dopbsp-separator"></td>
                            <td></td>
                            <td class="dopbsp-separator"></td>
                            <td></td>
                            <td class="dopbsp-separator"></td>
                            <td></td>
                            </tr>
                            <?php
                            break;
                        case 2:
                            ?>
                            <td class="dopbsp-separator"></td>
                            <td></td>
                            <td class="dopbsp-separator"></td>
                            <td></td>
                            </tr>
                            <?php
                            break;
                        case 3:
                            ?>
                            <td class="dopbsp-separator"></td>
                            <td></td>
                            </tr>
                            <?php
                            break;
                    }
                    ?>
                </tbody>
            </table>
            <style>
                .DOPBSP-admin .dopbsp-input-wrapper .dopbsp-switch .dopbsp-switch-inner:before{
                    content: "<?php $DOT->echo($DOPBSP->text('SETTINGS_ENABLED')); ?>";
                }

                .DOPBSP-admin .dopbsp-input-wrapper .dopbsp-switch .dopbsp-switch-inner:after{
                    content: "<?php $DOT->echo($DOPBSP->text('SETTINGS_DISABLED')); ?>";
                }
            </style>
            <?php
        }
    }
}