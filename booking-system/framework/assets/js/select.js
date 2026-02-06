/*
 * Title                   : DOT Framework
 * File                    : framework/assets/js/select.js
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : DOT Select jQuery plugin.
 */

(function($){
    $.fn.DOTSelect = function(options){
        'use strict';

        /*
         * Private variables.
         */
        let Data             = {}, /* The data */
            Wrapper          = this, /* <select> HTML tag. */

            ID               = '', /* Plugin ID. */
            id               = '', /* <select> [id] attribute. */
            name             = '', /* <select> [name] attribute. */
            classes          = '', /* <select> [class] attribute. */
            onChange         = '', /* <select> [onchange] attribute. */
            isDisabled       = false, /* <select> [disabled] attribute. */
            isMultiple       = false, /* <select> [multiple] attribute. */
            thisItem         = '', /* Used to get [multiple] attribute. */
            values           = [], /* <select> <option> [value] attribute. */
            valuesKey        = [], /* <select> <option> [value] key. */
            labels           = [], /* <select> <option> text. */
            search           = '', /* <select> search location. */
            selectedOption   = 0, /* <select> selected option value. */

            firstClick       = false, /* "true" if you clicked to display the options for the first time, "false" otherwise. */
            minSearchOptions = 10, /* The minimum amount of options for the search field to be displayed. */
            wasChanged       = false, /* "true" if an option was selected, "false" otherwise. */

            methods          = {
                /*
                 * Initialize jQuery plugin.
                 *
                 * @usage
                 *      This function is initialized when the plugin starts.
                 *
                 *      In PROJECT search for function call: DOTSelect
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
                 *      this : parse() // Parse <select> tag.
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
                 * Parse <select> tag.
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
                 *      this : display() // Replace <select> with DOT Select plugin.
                 *      this : events() // Initialize DOT Select events.
                 *      this : key() // Get option key.
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
                    let $option;

                    /*
                     * Options.
                     */
                    if (options !== undefined){
                        options.search !== undefined
                                ? search = options.search
                                : null;
                    }

                    /*
                     * Get attributes.
                     */
                    id = $wrapper.attr('id') !== undefined
                            ? $wrapper.attr('id')
                            : '';
                    name = $wrapper.attr('name') !== undefined
                            ? $wrapper.attr('name')
                            : '';
                    classes = $wrapper.attr('class') !== undefined
                            ? $wrapper.attr('class')
                            : '';
                    onChange = $wrapper.attr('onchange') !== undefined
                            ? $wrapper.attr('onchange')
                            : '';
                    isDisabled = $wrapper.attr('disabled') !== undefined;
                    thisItem = id !== ''
                            ? '#'+id
                            : 'select[name*="'+name+'"]';
                    isMultiple = $(thisItem+'[multiple]').length>0;
                    ID = id !== ''
                            ? id
                            : name;

                    /*
                     * Get the options' values and text.
                     */
                    selectedOption = !isMultiple
                            ? 0
                            : [];
                    $option = $(thisItem+' option');

                    $option.each(function(){
                        const $this = $(this);

                        values.push($this.attr('value'));
                        valuesKey.push(methods.key($this.attr('value')));
                        labels.push($this.html());

                        $this.is(':selected')
                                ? (!isMultiple
                                        ? selectedOption = values.length-1
                                        : selectedOption.push(values.length-1))
                                : null;
                    });

                    methods.display();

                    /*
                     * Set <select> events if the items is not disabled.
                     */
                    !isDisabled
                            ? methods.events()
                            : null;
                },

                /*
                 * Replace <select> with DOT Select plugin.
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
                 *      DOT Select HTML code is generated and <select> tag is replaced.
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
                    const $Wrapper = $(Wrapper);
                    let HTML = [],
                        i;

                    HTML.push('<div id="dot-select-'+ID+'" class="dot-select '
                                      +(isMultiple
                                    ? 'dot-select-multiple'
                                    : 'dot-select-single')
                                      +(isDisabled
                                    ? ' dot-select-disabled'
                                    : '')
                                      +(values.length>minSearchOptions
                                    ? ' dot-select-has-search'
                                    : '')
                                      +(classes !== ''
                                    ? ' '+classes
                                    : '')
                                      +'">');
                    HTML.push(' <input type="hidden" id="'+ID+'" name="'+name+'" value="'
                                      +(isMultiple
                                    ? ''
                                    : values[selectedOption])
                                      +'">');

                    /*
                     * Display "selected" component only on single select.
                     */
                    if (!isMultiple){
                        HTML.push(' <div class="dot-select-select">');
                        HTML.push('     <div class="dot-select-selection">'
                                          +(values.length !== 0
                                        ? labels[selectedOption]
                                        : '')
                                          +'</div>');
                        HTML.push('     <div class="dot-select-icon dot-select-icon-down dot-icon-action-arrow-down"></div>');
                        HTML.push('     <div class="dot-select-icon dot-select-icon-up dot-icon-action-arrow-up"></div>');
                        HTML.push(' </div>');
                    }

                    /*
                     * Display search if you have more than 10 options.
                     */
                    if (values.length>minSearchOptions
                            && !isDisabled){
                        HTML.push(' <div class="dot-select-search">');
                        HTML.push('	    <span class="dot-select-search-icon dot-icon-action-search"></span>');
                        HTML.push('	    <input type="text" name="dot-select-search-'+ID+'" id="dot-select-search-'+ID+'" class="dot-select-search-input" value="" autocomplete="off" />');
                        HTML.push('	    <a href="javascript:void(0)" class="dot-select-search-reset dot-icon-action-close-fill"></a>');
                        HTML.push(' </div>');
                    }

                    HTML.push(' <ul class="dot-select-list">');

                    for (i = 0; i<values.length; i++){
                        if (!isMultiple){
                            /*
                             * Single select options.
                             */
                            HTML.push('     <li class="dot-select-list-item'
                                              +(selectedOption === i
                                            ? ' dot-select-selected'
                                            : '')
                                              +'" id="dot-select-'+ID+'-'+valuesKey[i]+'" data-value="'+values[i]+'" title="'+labels[i]+'">'+labels[i]+'</li>');
                        }
                        else{
                            /*
                             * Multiple select options.
                             */
                            HTML.push('     <li class="dot-select-list-item" title="'+labels[i]+'">');
                            HTML.push('         <input type="checkbox" name="dot-select-'+ID+'-'+valuesKey[i]+'" id="dot-select-'+ID+'-'+valuesKey[i]+'" data-value="'+values[i]+'" class="dot-select-checkbox"'
                                              +(isDisabled
                                            ? ' disabled="disabled"'
                                            : '')
                                              +($.inArray(i,
                                                          selectedOption) !== -1
                                            ? ' checked="checked"'
                                            : '')
                                              +' />');
                            HTML.push('         <label for="dot-select-'+ID+'-'+valuesKey[i]+'" class="dot-select-label">'+labels[i]+'</label>');
                            HTML.push('     </li>');
                        }
                    }
                    HTML.push(' </ul>');
                    HTML.push('</div>');

                    $Wrapper.replaceWith(HTML.join(''));
                },

                /*
                 * Initialize DOT Select events.
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
                 *      this : hide() // Hide single select options list.
                 *      this : search() // Search options list.
                 *      this : show() // Show single select options list.
                 *
                 * @hooks
                 *      -
                 *
                 * @layouts
                 *      -
                 *
                 * @return
                 *      DOT Select events are initialized.
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
                events: function(){
                    const $document    = $(document),
                          $listItem    = $('#dot-select-'+ID+' .dot-select-list-item'),
                          $searchInput = $('#dot-select-'+ID+' .dot-select-search-input'),
                          $searchReset = $('#dot-select-'+ID+' .dot-select-search-reset'),
                          $select      = $('#dot-select-'+ID+' .dot-select-select');

                    if (isMultiple){
                        /*
                         * Multiple select events.
                         */
                        $listItem.off('click');
                        $listItem.on('click',
                                     function(){
                                         const $checkbox = $('#dot-select-'+ID+' .dot-select-checkbox'),
                                               $ID       = $('#'+ID);
                                         let selected = [],
                                             value;

                                         setTimeout(function(){
                                                        $checkbox.each(function(){
                                                            const $this = $(this);

                                                            if ($this.is(':checked')){
                                                                value = $this.data('value');
                                                                selected.push(value);
                                                            }
                                                        });

                                                        $ID.val(selected)
                                                           .trigger('change');

                                                        if (onChange !== ''){
                                                            eval(onChange.replace(/this.value/g,
                                                                                  "'"+selected.join(',')+"'"));
                                                        }
                                                    },
                                                    1);
                                     });
                    }
                    else{
                        /*
                         * Single select events.
                         */
                        /*
                         * Hide options list when you click outside DOT Select.
                         */
                        $document.on('mousedown',
                                     function(event){
                                         const $list   = $('#dot-select-'+ID+' .dot-select-list'),
                                               $search = $('#dot-select-'+ID+' .dot-select-search'),
                                               $select = $('#dot-select-'+ID+' .dot-select-select'),
                                               $target = $(event.target);

                                         if ($target.parents('#dot-select-'+ID).length === 0){
                                             /*
                                              * Hide list.
                                              */
                                             $select.removeClass('dot-select-focus');
                                             $list.removeAttr('style')
                                                  .removeClass('dot-select-visible');
                                             $search.removeClass('dot-select-visible');
                                         }
                                     });

                        /*
                         * Display the options list.
                         */
                        $select.off('click');
                        $select.on('click',
                                   function(){
                                       const $list = $('#dot-select-'+ID+' .dot-select-list');

                                       if ($list.hasClass('dot-select-visible')){
                                           /*
                                            * Hide list.
                                            */
                                           methods.hide();
                                       }
                                       else{
                                           /*
                                            * Hide list.
                                            */
                                           methods.hide();

                                           /*
                                            * Show list.
                                            */
                                           methods.show();
                                       }
                                   });

                        /*
                         * Select an option.
                         */
                        $listItem.off('click');
                        $listItem.on('click',
                                     function(){
                                         const $ID        = $('#'+ID),
                                               $selection = $('#dot-select-'+ID+' .dot-select-selection'),
                                               $this      = $(this);

                                         /*
                                          * Do not take any action if item is disabled.
                                          */
                                         if ($this.hasClass('dot-select-list-item-disabled')){
                                             return false;
                                         }

                                         /*
                                          * Take action only on unselected items.
                                          */
                                         if (!$this.hasClass('dot-select-selected')){
                                             wasChanged = true;

                                             $listItem.removeClass('dot-select-selected');
                                             $this.addClass('dot-select-selected');
                                             $selection.html($this.html());
                                             $ID.val($this.data('value'))
                                                .trigger('change');

                                             if (onChange !== ''){
                                                 eval(onChange.replace(/this.value/g,
                                                                       "'"+$this.data('value')+"'"));
                                             }
                                         }

                                         /*
                                          * Hide list.
                                          */
                                         methods.hide();
                                     });
                    }

                    /*
                     * Search options.
                     */
                    $searchInput.off('blur keyup paste');
                    $searchInput.on('blur keyup paste',
                                    function(){
                                        const $this = $(this);

                                        methods.search($this.val());
                                    });

                    /*
                     * Reset search.
                     */
                    $searchReset.off('click');
                    $searchReset.on('click',
                                    function(){
                                        $searchInput.val('');
                                        methods.search('');
                                    });
                },

                /*
                 * Hide single select options list.
                 *
                 * @usage
                 *      In FILE search for function call: methods.hide
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
                 *      The single select option list & the search are hidden.
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
                hide: function(){
                    const $list   = $('.dot-select.dot-select-single .dot-select-list'),
                          $search = $('.dot-select.dot-select-single .dot-select-search'),
                          $select = $('.dot-select.dot-select-single .dot-select-select');

                    $select.removeClass('dot-select-focus');
                    $list.removeAttr('style')
                         .removeClass('dot-select-visible')
                         .scrollTop(0);
                    $search.removeClass('dot-select-visible');
                },

                /*
                 * Get option key.
                 *
                 * @usage
                 *      In FILE search for function call: methods.key
                 *
                 * @params
                 *      value (String): option value
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
                 *      Option key.
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
                 * @param {String} value
                 *
                 * @return {String}
                 */
                key: function(value){
                    return value.replace(/\//g,
                                         '-')
                                .replace(/ /g,
                                         '_')
                                .replace(/,/g,
                                         '-')
                                .replace(/;/g,
                                         '-')
                                .replace(/\./g,
                                         '-')
                                .replace(/:/g,
                                         '-')
                                .replace(/'/g,
                                         '-')
                                .replace(/"/g,
                                         '-')
                                .replace(/\(/g,
                                         '-')
                                .replace(/\)/g,
                                         '-')
                                .replace(/\[/g,
                                         '-')
                                .replace(/]/g,
                                         '-')
                                .replace(/\{/g,
                                         '-')
                                .replace(/}/g,
                                         '-');
                },

                /*
                 * Search options list.
                 *
                 * @usage
                 *	    In FILE search for function call: methods.search
                 *
                 * @params
                 *	    val (String): search value
                 *
                 * @post
                 *	    -
                 *
                 * @get
                 *	    -
                 *
                 * @sessions
                 *	    -
                 *
                 * @cookies
                 *	    -
                 *
                 * @constants
                 *	    -
                 *
                 * @globals
                 *	    -
                 *
                 * @functions
                 *	    -
                 *
                 * @hooks
                 *	    -
                 *
                 * @layouts
                 *	    -
                 *
                 * @return
                 *	    Display only the options that for the search parameters.
                 *
                 * @return_details
                 *	    -
                 *
                 * @dv
                 *	    -
                 *
                 * @tests
                 *	    -
                 */
                /**
                 * @param {String} val
                 */
                search: function(val){
                    const $searchReset = $('#dot-select-'+ID+' .dot-select-search-reset');
                    let $option = $('#dot-select-'+ID+' .dot-select-list-item'),
                        $optionId,
                        label,
                        i,
                        value;

                    val = val.toLowerCase();

                    /*
                     * Set reset button.
                     */
                    val === ''
                            ? $searchReset.removeClass('dot-select-visible')
                            : $searchReset.addClass('dot-select-visible');

                    /*
                     * Reset all options.
                     */
                    $option.removeClass('dot-select-hidden');

                    /*
                     * Verify options.
                     */
                    if (val !== ''){
                        for (i = 0; i<values.length; i++){
                            label = labels[i].toLowerCase();
                            value = values[i];
                            $optionId = $(('#dot-select-'+ID+'-'+valuesKey[i]).replace(/\./g,
                                                                                       '\\.'));
                            $option = isMultiple
                                    ? $optionId.parent()
                                    : $optionId;
                            value = value.toLowerCase();

                            /*
                             * Hide options.
                             */
                            value !== ''
                            && (value.indexOf(val) === -1 || search === 'labels')
                            && (label.indexOf(val) === -1 || search === 'values')
                                    ? $option.addClass('dot-select-hidden')
                                    : null;
                        }
                    }
                },

                /*
                 * Show single select options list.
                 *
                 * @usage
                 *      In FILE search for function call: methods.show
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
                 *      The single select option list & the search are shown. The list will be scrolled and the option selected.
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
                show: function(){
                    const $document      = $(document),
                          $list          = $('#dot-select-'+ID+' .dot-select-list'),
                          $search        = $('#dot-select-'+ID+' .dot-select-search'),
                          $select        = $('#dot-select-'+ID+' .dot-select-select'),
                          $selected      = $('#dot-select-'+ID+' .dot-select-list-item.dot-select-selected'),
                          heightDocument = $document.height();
                    let height,
                        heightList,
                        heightSearch,
                        heightSelect,
                        scrollTo;

                    $select.addClass('dot-select-focus');
                    $list.addClass('dot-select-visible')
                         .removeAttr('style');
                    $search.addClass('dot-select-visible')
                           .removeAttr('style');

                    /*
                     * Position list.
                     */
                    heightList = $list.height()
                            +parseInt($list.css('border-top'))
                            +parseInt($list.css('border-bottom'))
                            +parseInt($list.css('margin-top'))
                            +parseInt($list.css('padding-top'))
                            +parseInt($list.css('padding-bottom'));
                    heightSelect = $select.height()
                            +parseInt($select.css('border-top'))
                            +parseInt($select.css('border-bottom'))
                            +parseInt($select.css('padding-top'))
                            +parseInt($select.css('padding-bottom'));

                    if ($search.length === 0){
                        height = heightSelect+heightList;

                        $select.offset().top+height>heightDocument
                                ? $list.attr('style',
                                             'margin-top: '+((-1)*height)+'px !important')
                                : null;
                    }
                    else{
                        heightSearch = $search.height()
                                +parseInt($search.css('border-top'))
                                +parseInt($search.css('border-bottom'))
                                +parseInt($search.css('margin-top'))
                                +parseInt($search.css('padding-top'))
                                +parseInt($search.css('padding-bottom'));
                        height = heightSelect+heightList+heightSearch;

                        if ($select.offset().top+height>heightDocument){
                            $list.attr('style',
                                       'margin-top: '+((-1)*(height-heightSearch))+'px !important');
                            $search.attr('style',
                                         'margin-top: '+((-1)*(heightSelect+heightSearch))+'px !important');
                        }
                    }

                    /*
                     * Duplicate scrollTo action for the right position.
                     */
                    scrollTo = $selected.position().top-$selected.height();
                    $list.scrollTop(scrollTo);

                    if (wasChanged
                            || firstClick){
                        scrollTo = $selected.position().top-$selected.height();
                        $list.scrollTop(scrollTo);
                    }

                    if (!firstClick){
                        firstClick = true;
                    }
                }
            };

        return methods.init.apply(this);
    };
})(jQuery);