<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/assets/js/data.php
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : JavaScript data.
 */

?>

<?php
global $dot_text_default;
?>
    let DOT = new function(){
        this.ajax = {
            keys: new Array(),
            var: '<?php $DOT->echo(DOT_AJAX_VAR,'js'); ?>',
            url: '<?php $DOT->echo(admin_url('admin-ajax.php'),'url'); ?>'
        };
        this.config = <?php $DOT->echo($DOT->config_js,'json'); ?>;
        this.id = '<?php $DOT->echo(DOT_ID,'js'); ?>';
        this.language = '<?php $DOT->echo($DOT->language,'js'); ?>';
        this.language_default = '<?php $DOT->echo($DOT->language_default,'js'); ?>';
        this.layouts = {};
        this.methods = {};
        this.page = '<?php $DOT->echo($DOT->permalink->page_name,'js'); ?>';
        this.prototypes = {};
        this.sanitize = {};
        this.status = '<?php $DOT->echo(DOT_STATUS,'js'); ?>';
        this.text = new Array();
        this.url = '<?php $DOT->echo($DOT->paths->url,'url'); ?>';
    };
<?php

/*
 * Set AJAX keys.
 */
foreach ($DOT->ajax as $key => $ajax){
    $DOT->echo('DOT.ajax.keys[\''.$key.'\'] = \''.DOT_ID.'_'.$key.'\';');
}

/*
 * Set JavaScript text.
 */
foreach ($dot_text_default as $key => $text){
    $DOT->echo(str_contains($key,
                      '_JS')
            ? 'DOT.text[\''.str_replace('_JS',
                                        '',
                                        $key).'\'] = \''.addslashes($DOT->text($key)).'\';'
            : '');
}