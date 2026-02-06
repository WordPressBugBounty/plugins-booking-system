/*
 * Title                   : DOT Framework
 * File                    : framework/assets/js/file.js
 * Author                  : Dot on Paper
 * Copyright               : © 2018 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : DOT File jQuery plugin.
 */

(function($){
    $.fn.DOTFile = function(options){
        'use strict';

        /*
         * Private variables.
         */
        let Data               = {
                "textChoose"        : "Choose a file",
                "textChooseMultiple": "Choose some files",
                "textDisabled"      : "The field is disabled.",
                "textDrag"          : "or drag it here.",
                "textDragMultiple"  : "or drag them here.",
                "textFormats"       : "Formats accepted",
                "textFormatsVal"    : "All",
                "textNo"            : "Maximum number of files at once",
                "textNoVal"         : "10",
                "textSize"          : "Maximum file size",
                "textSizeVal"       : "8MB"
            }, /* The data */
            Wrapper            = this, /* <input type="file"> HTML tag. */

            ID                 = '', /* Plugin ID. */
            id                 = '', /* <input type="file"> [id] attribute. */
            name               = '', /* <input type="file"> [name] attribute. */
            accept             = '', /* <input type="file"> [accept] attribute. */
            classes            = '', /* <input type="file"> [class] attribute. */
            onChange           = '', /* <input type="file"> [onchange] attribute. */
            isDisabled         = false, /* <input type="file"> [disabled] attribute. */
            isMultiple         = false, /* <input type="file"> [multiple] attribute. */
            textChoose         = Data.textChoose, /* <input type="file"> choose text. */
            textChooseMultiple = Data.textChooseMultiple, /* <input type="file"> choose text for multiple files. */
            textDisabled       = Data.textDisabled, /* <input type="file"> disabled text. */
            textDrag           = Data.textDrag, /* <input type="file"> drag text. */
            textDragMultiple   = Data.textDragMultiple, /* <input type="file"> drag text for multiple files. */
            textFormats        = Data.textFormats, /* <input type="file"> formats accepted text. */
            textFormatsVal     = Data.textFormatsVal, /* <input type="file"> formats accepted value text. */
            textNo             = Data.textNo, /* <input type="file"> maximum number of files text. */
            textNoVal          = Data.textNoVal, /* <input type="file"> maximum number of files value text. */
            textSize           = Data.textSize, /* <input type="file"> maximum file size text. */
            textSizeVal        = Data.textSizeVal, /* <input type="file"> maximum file size value text. */

            methods            = {
                /*
                 * Initialize jQuery plugin.
                 *
                 * @usage
                 *      This function is initialized when the plugin starts.
                 *
                 *      In PROJECT search for function call: DOTFile
                 *
                 * @params
                 *      -
                 *
                 * @post
                 *      -
                 *
                 * @get
                 *      -
                 *
                 * @sessions
                 *      -
                 *
                 * @cookies
                 *      -
                 *
                 * @constants
                 *      -
                 *
                 * @globals
                 *      options (Object): options sent to the plugin when you initialize it
                 *
                 * @functions
                 *      this : parse() // Parse <input type="file"> tag.
                 *
                 * @hooks
                 *      -
                 *
                 * @layouts
                 *      -
                 *
                 * @return
                 *      -
                 *
                 * @return_details
                 *      -
                 *
                 * @dv
                 *      -
                 *
                 * @tests
                 *      -
                 */
                /**
                 * @returns {jQuery}
                 */
                init: function(){
                    return this.each(function(){
                        options
                                ? $.extend(Data,
                                           options)
                                : null;
                        methods.parse();
                    });
                },

                /*
                 * Parse <input type="file"> tag.
                 *
                 * @usage
                 *      In FILE search for function call: methods.parse
                 *
                 * @params
                 *      -
                 *
                 * @post
                 *      -
                 *
                 * @get
                 *      -
                 *
                 * @sessions
                 *      -
                 *
                 * @cookies
                 *      -
                 *
                 * @constants
                 *      -
                 *
                 * @globals
                 *      -
                 *
                 * @functions
                 *      this : display() // Replace <input type="file"> with DOT File plugin.
                 *      this : events() // Initialize DOT File events.
                 *
                 * @hooks
                 *      -
                 *
                 * @layouts
                 *      -
                 *
                 * @return
                 *      Private variables are completed.
                 *
                 * @return_details
                 *      -
                 *
                 * @dv
                 *      -
                 *
                 * @tests
                 *      -
                 */
                parse: function(){
                    const $wrapper = $(Wrapper);

                    id = $wrapper.attr('id') !== undefined
                            ? $wrapper.attr('id')
                            : '';
                    name = $wrapper.attr('name') !== undefined
                            ? $wrapper.attr('name')
                            : '';
                    accept = $wrapper.attr('accept') !== undefined
                            ? $wrapper.attr('accept')
                            : '';
                    classes = $wrapper.attr('class') !== undefined
                            ? $wrapper.attr('class')
                            : '';
                    onChange = $wrapper.attr('onchange') !== undefined
                            ? $wrapper.attr('onchange')
                            : '';
                    isDisabled = $wrapper.attr('disabled') !== undefined;
                    isMultiple = $wrapper.attr('multiple') !== undefined;
                    ID = id !== ''
                            ? id
                            : name;

                    textChoose = Data.textChoose;
                    textChooseMultiple = Data.textChooseMultiple;
                    textDisabled = Data.textDisabled;
                    textDrag = Data.textDrag;
                    textDragMultiple = Data.textDragMultiple;
                    textFormats = Data.textFormats;
                    textFormatsVal = Data.textFormatsVal;
                    textNo = Data.textNo;
                    textNoVal = Data.textNoVal;
                    textSize = Data.textSize;
                    textSizeVal = Data.textSizeVal;

                    /*
                     * Display <input type="file">.
                     */
                    methods.display();

                    /*
                     * Set <input type="file"> events.
                     */
                    methods.events();
                },

                /*
                 * Replace <input type="file"> with DOT File plugin.
                 *
                 * @usage
                 *      In FILE search for function call: methods.display
                 *
                 * @params
                 *      -
                 *
                 * @post
                 *      -
                 *
                 * @get
                 *      -
                 *
                 * @sessions
                 *      -
                 *
                 * @cookies
                 *      -
                 *
                 * @constants
                 *      -
                 *
                 * @globals
                 *      -
                 *
                 * @functions
                 *      -
                 *
                 * @hooks
                 *      -
                 *
                 * @layouts
                 *      -
                 *
                 * @return
                 *      DOT File HTML code is generated and <input type="file"> tag is replaced.
                 *
                 * @return_details
                 *      -
                 *
                 * @dv
                 *      -
                 *
                 * @tests
                 *      -
                 */
                display: function(){
                    const $wrapper = $(Wrapper);
                    let HTML = [];

                    /*
                     * Set wrapper.
                     */
                    HTML.push('<div id="dot-file-'+ID+'" class="dot-file'
                                      +(isDisabled
                                    ? ' dot-file-disabled'
                                    : '')
                                      +'">');

                    /*
                     * Set icon.
                     */
                    HTML.push(' <span class="dot-file-icon dot-icon-interface-files"></span>');

                    /*
                     * Set file input.
                     */
                    HTML.push(' <input type="file"');
                    HTML.push(' id="'+ID+'"');
                    HTML.push(' name="'+name+'"');
                    HTML.push(' class="dot-file-input'
                                      +(classes !== ''
                                    ? ' '+classes
                                    : '')
                                      +'"');
                    HTML.push(accept !== ''
                                      ? ' accept="'+accept+'"'
                                      : '');
                    HTML.push(isDisabled
                                      ? ' disabled="disabled"'
                                      : '');
                    HTML.push(isMultiple
                                      ? ' multiple="multiple"'
                                      : '');
                    HTML.push(' />');

                    /*
                     * Set label.
                     */
                    HTML.push(' <label class="dot-file-label" for="'+ID+'">');

                    if (isDisabled){
                        HTML.push(textDisabled);
                    }
                    else{
                        HTML.push('<span class="dot-file-label-choose">'
                                          +(isMultiple
                                        ? textChooseMultiple
                                        : textChoose)
                                          +'</span>&nbsp;');
                        HTML.push('<span class="dot-file-label-drag">'
                                          +(isMultiple
                                        ? textDragMultiple
                                        : textDrag)
                                          +'</span>');
                        HTML.push('<br /><br /><span class="dot-file-label-info">'
                                          +(textFormats+': <strong>'+textFormatsVal+'</strong><br />')
                                          +(textNo+': <strong>'+textNoVal+'</strong><br />')
                                          +(textSize+': <strong>'+textSizeVal+'</strong>')
                                          +'</span>');
                    }
                    HTML.push(' </label>');

                    /*
                     * Set files list.
                     */
                    HTML.push(' <span id="dot-file-list-'+ID+'" class="dot-file-list"></span>');
                    HTML.push('</div>');

                    $wrapper.replaceWith(HTML.join(''));
                },

                /*
                 * Initialize DOT File events.
                 *
                 * @usage
                 *      In FILE search for function call: methods.events
                 *
                 * @params
                 *      -
                 *
                 * @post
                 *      -
                 *
                 * @get
                 *      -
                 *
                 * @sessions
                 *      -
                 *
                 * @cookies
                 *      -
                 *
                 * @constants
                 *      -
                 *
                 * @globals
                 *      -
                 *
                 * @functions
                 *      this : list() // Set files list.
                 *
                 * @hooks
                 *      -
                 *
                 * @layouts
                 *      -
                 *
                 * @return
                 *      DOT File events are initialized.
                 *
                 * @return_details
                 *      -
                 *
                 * @dv
                 *      -
                 *
                 * @tests
                 *      -
                 */
                /**
                 * @returns {*|Boolean}
                 */
                events: function(){
                    const $body = $('body'),
                          $file = $('#dot-file-'+ID),
                          $ID   = $('#'+ID);
                    let files = false;

                    /*
                     * Prevent default events.
                     */
                    $body.off('dragend dragover dragleave drop');
                    $body.on('dragend dragover dragleave drop',
                             function(e){
                                 e.preventDefault();
                                 e.stopPropagation();
                             });

                    $file.off('drag dragstart dragend dragover dragenter dragleave drop');
                    $file.on('drag dragstart dragend dragover dragenter dragleave drop',
                             function(e){
                                 e.preventDefault();
                                 e.stopPropagation();
                             });

                    /*
                     * Disable drop events if <input type="file"> is disabled.
                     */
                    if (isDisabled){
                        return false;
                    }

                    /*
                     * Set drop event.
                     */
                    $file.off('drop');
                    $file.on('drop',
                             function(e){
                                 e.preventDefault();
                                 e.stopPropagation();

                                 /*
                                  * Get files.
                                  */
                                 files = e.originalEvent.dataTransfer.files;

                                 /*
                                  * Remove extra files if multiple attribute is not set.
                                  */
                                 if (!isMultiple
                                         && files.length>1){
                                     return false;
                                 }

                                 /*
                                  * Add file(s).
                                  */
                                 $ID.prop('files',
                                          files);

                                 /*
                                  * Trigger change event.
                                  */
                                 $ID.trigger('change');
                             });

                    /*
                     * Set <input type="file"> change event.
                     */
                    $ID.off('change');
                    $ID.on('change',
                           function(){
                               const $this = $(this);

                               methods.list($this.prop('files'));

                               /*
                                * Run on change function.
                                */
                               if (onChange !== ''){
                                   eval(onChange);
                               }
                           });
                },

                /*
                 * Set files list.
                 *
                 * @usage
                 *      In FILE search for function call: methods.list
                 *
                 * @params
                 *      files (Array): files list
                 *
                 * @post
                 *      -
                 *
                 * @get
                 *      -
                 *
                 * @sessions
                 *      -
                 *
                 * @cookies
                 *      -
                 *
                 * @constants
                 *      -
                 *
                 * @globals
                 *      -
                 *
                 * @functions
                 *      -
                 *
                 * @hooks
                 *      -
                 *
                 * @layouts
                 *      -
                 *
                 * @return
                 *      DOT File list HTML code is generated.
                 *
                 * @return_details
                 *      -
                 *
                 * @dv
                 *      -
                 *
                 * @tests
                 *      -
                 */
                /**
                 * @param {Array} files
                 */
                list: function(files){
                    const $list = $('#dot-file-list-'+ID);
                    let HTML = [];

                    $.each(files,
                           function(i,
                                    file){
                               HTML.push('<br />'+file.name);
                           });

                    $list.html(HTML.join(''));
                }
            };

        return methods.init.apply(this);
    };
})(jQuery);