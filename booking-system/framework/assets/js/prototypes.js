/*
 * Title                   : DOT Framework
 * File                    : framework/assets/js/prototypes.js
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : JavaScript prototypes functions.
 */

DOT.prototypes = new function(){
    'use strict';

    /*
     * Private variables
     */
    const $ = jQuery.noConflict();

    /*
     * Constructor
     *
     * @usage
     *      The constructor is called when a class instance is created.
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
    this.__construct = function(){
    };

    /*
     * Actions
     */

    /*
     * Open a link.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.link
     *
     * @params
     *      url (String): link URL
     *      target (String): link target (_blank, _parent, _self, _top)
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
     *      The link is open in [target].
     *
     * @return_details
     *      The target values are same as HTML [_target] attribute values.
     *
     * @dv
     *      -
     *
     * @tests
     *      -
     */
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {String} url
     * @param {String} [target]
     */
    this.link = function(url,
                         target){
        target = target === undefined
                ? '_self'
                : target;

        switch (target.toLowerCase()){
            case '_blank':
                window.open(url);
                break;
            case '_parent':
                parent.location.href = url;
                break;
            case '_top':
                top.location.href = url;
                break;
            default:
                window.location = url;
        }
    };

    /*
     * Scroll horizontally to position.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.scrollToX
     *
     * @params
     *      position (Number): position to scroll to
     *      wrapper (String): HTML wrapper
     *      speed (Number): scroll speed
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
     *      The website page is scrolled where you set the position.
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {Number} position
     * @param {String} [wrapper]
     * @param {Number} [speed]
     */
    this.scrollToX = function(position,
                              wrapper,
                              speed){
        const $body    = $('body'),
              $html    = $('html'),
              $wrapper = $(wrapper);

        speed = speed !== undefined
                ? speed
                : 300;

        if (wrapper === undefined){
            $body.stop(false,
                       true)
                 .animate({'scrollLeft': position},
                          speed);
            $html.stop(false,
                       true)
                 .animate({'scrollLeft': position},
                          speed);
        }
        else{
            $wrapper.stop(false,
                          true)
                    .animate({'scrollLeft': position},
                             speed);
        }
    };

    /*
     * Scroll vertically to position.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.scrollToY
     *
     * @params
     *      position (Number): position to scroll to
     *      wrapper (String): HTML wrapper
     *      speed (Number): scroll speed
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
     *      The website page is scrolled where you set the position.
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {Number} position
     * @param {String} [wrapper]
     * @param {Number} [speed]
     */
    this.scrollToY = function(position,
                              wrapper,
                              speed){
        const $body    = $('body'),
              $html    = $('html'),
              $wrapper = $(wrapper);

        speed = speed !== undefined
                ? speed
                : 300;

        if (wrapper === undefined){
            $html.stop(false,
                       true)
                 .animate({'scrollTop': position},
                          speed);
            $body.stop(false,
                       true)
                 .animate({'scrollTop': position},
                          speed);
        }
        else{
            $wrapper.stop(false,
                          true)
                    .animate({'scrollTop': position},
                             speed);
        }
    };

    /*
     * Colors
     */

    /*
     * Convert HEX color to RGB.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.HEXtoRGB
     *
     * @params
     *      hex (String): color hex code
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
     *      rgb (Object): rgb data
     *          r (Number): red value (0-255)
     *          g (Number): green value (0-255)
     *          b (Number): blue value (0-255)
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {String} hex
     *
     * @returns {{b: *, s: *, h: *}}
     */
    this.HEXtoRGB = function(hex){
        const hexInt = parseInt(hex,
                                16),
              r      = Math.round(hexInt>>16),
              g      = Math.round((hexInt&0x00FF00)>>8),
              b      = Math.round(hexInt&0x0000FF);

        return {
            r: r,
            g: g,
            b: b
        };
    };

    /*
     * Convert HEX color to HSB.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.HEXtoHSB
     *
     * @params
     *      hex (String): color hex code
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
     *      this : HEXtoRGB() // Convert HEX color to RGB.
     *      this : RGBtoHSB() // Convert RGB color to HSB.
     *
     * @hooks
     *      -
     *
     * @layouts
     *      -
     *
     * @return
     *      hsb (Object): hsb data
     *          h (Number): hue value (0-360)
     *          s (Number): saturation value (0-100)
     *          b (Number): brightness value (0-100)
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {String} hex
     *
     * @returns {{b: Number, s: Number, h: Number}}
     */
    this.HEXtoHSB = function(hex){
        return DOT.prototypes.RGBtoHSB(DOT.prototypes.HEXtoRGB(hex));
    };

    /*
     * Convert HSB color to HEX.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.HSBtoHEX
     *
     * @params
     *      hsb (Object): color hsb data
     *          h (Number): hue value (0-360)
     *          s (Number): saturation value (0-100)
     *          b (Number): brightness value (0-100)
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
     *      this : HEXtoRGB() // Convert HEX color to RGB.
     *      this : RGBtoHEX() // Convert RGB color to HEX.
     *
     * @hooks
     *      -
     *
     * @layouts
     *      -
     *
     * @return
     *      hex (String): hex code
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {Object} hsb
     *
     * @returns {String}
     */
    this.HSBtoHEX = function(hsb){
        return DOT.prototypes.RGBtoHEX(DOT.prototypes.HSBtoRGB(hsb));
    };

    /*
     * Convert HSB color to RGB.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.HSBtoRGB
     *
     * @params
     *      hsb (Object): color hsb data
     *          h (Number): hue value (0-360)
     *          s (Number): saturation value (0-100)
     *          b (Number): brightness value (0-100)
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
     *      rgb (Object): rgb data
     *          r (Number): red value (0-255)
     *          g (Number): green value (0-255)
     *          b (Number): blue value (0-255)
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {Object} hsb
     *
     * @returns {{r: number, b: number, g: number}}
     */
    this.HSBtoRGB = function(hsb){
        let h = Math.round(hsb.h);
        const s  = Math.round(hsb.s*255/100),
              b  = Math.round(hsb.b*255/100),
              t1 = b,
              t2 = (255-s)*b/255,
              t3 = (t1-t2)*(h%60)/60;
        let rgb = {
            r: 0,
            g: 0,
            b: 0
        };

        if (b === 0){
            /*
             * Set brightness to 0 (black).
             */
            rgb.r = rgb.g = rgb.b = 0;
        }
        else{
            /*
             * Verify hue.
             */
            h === 360
                    ? h = 0
                    : null;

            if (h<60){
                rgb.r = Math.round(t1);
                rgb.b = Math.round(t2);
                rgb.g = Math.round(t2+t3);
            }
            else if (h<120){
                rgb.g = Math.round(t1);
                rgb.b = Math.round(t2);
                rgb.r = Math.round(t1-t3);
            }
            else if (h<180){
                rgb.g = Math.round(t1);
                rgb.r = Math.round(t2);
                rgb.b = Math.round(t2+t3);
            }
            else if (h<240){
                rgb.b = Math.round(t1);
                rgb.r = Math.round(t2);
                rgb.g = Math.round(t1-t3);
            }
            else if (h<300){
                rgb.b = Math.round(t1);
                rgb.g = Math.round(t2);
                rgb.r = Math.round(t2+t3);
            }
            else if (h<360){
                rgb.r = Math.round(t1);
                rgb.g = Math.round(t2);
                rgb.b = Math.round(t1-t3);
            }
            else{
                rgb.r = 0;
                rgb.g = 0;
                rgb.b = 0;
            }
        }

        return rgb;
    };

    /*
     * Convert RGB color to HEX.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.RGBtoHEX
     *
     * @params
     *      rgb (Object): color rgb data
     *          r (Number): red value (0-255)
     *          g (Number): green value (0-255)
     *          b (Number): blue value (0-255)
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
     *      hex (String): hex code
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {Object} rgb
     *
     * @returns {String}
     */
    this.RGBtoHEX = function(rgb){
        const r = parseInt(rgb.r),
              g = parseInt(rgb.g),
              b = parseInt(rgb.b);
        let hex = [r.toString(16),
                   g.toString(16),
                   b.toString(16)];

        /*
         * Fix HEX.
         */
        $.each(hex,
               function(nr,
                        val){
                   val.length === 1
                           ? hex[nr] = '0'+val
                           : null;
               });

        return hex.join('');
    };

    /*
     * Convert RGB color to HSB.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.RGBtoHSB
     *
     * @params
     *      rgb (Object): color rgb data
     *          r (Number): red value (0-255)
     *          g (Number): green value (0-255)
     *          b (Number): blue value (0-255)
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
     *      hsb (Object): hsb data
     *          h (Number): hue value (0-360)
     *          s (Number): saturation value (0-100)
     *          b (Number): brightness value (0-100)
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {Object} rgb
     *
     * @returns {{b: number, s: number, h: number}}
     */
    this.RGBtoHSB = function(rgb){
        const min   = Math.min(rgb.r,
                               rgb.g,
                               rgb.b),
              max   = Math.max(rgb.r,
                               rgb.g,
                               rgb.b),
              delta = max-min;
        let hsb = {
            h: 0,
            s: 0,
            b: 0
        };

        /*
         * Set brightness.
         */
        hsb.b = Math.round(max*100/255);

        /*
         * Set saturation.
         */
        hsb.s = max !== 0
                ? Math.round(delta/max*100)
                : 0;

        /*
         * Set hue.
         */
        if (hsb.s !== 0){
            if (rgb.r === max){
                hsb.h = (rgb.g-rgb.b)/delta;
            }
            else if (rgb.g === max){
                hsb.h = 2+(rgb.b-rgb.r)/delta;
            }
            else{
                hsb.h = 4+(rgb.r-rgb.g)/delta;
            }
        }
        else{
            hsb.h = -1;
        }
        hsb.h *= 60;
        hsb.h<0
                ? hsb.h += 360
                : null;
        hsb.h = Math.round(hsb.h);

        return hsb;
    };

    /*
     * Cookies
     */

    /*
     * Delete cookie.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.cookieDelete
     *
     * @params
     *      name (String): cookie name
     *      path (String): cookie path
     *      domain (String): cookie domain
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
     *      this : get() // Get cookie.
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {String} name
     * @param {String} [path]
     * @param {String} [domain]
     */
    this.cookieDelete = function(name,
                                 path,
                                 domain){
        if (DOT.prototypes.cookieGet(name)){
            document.cookie = name+'='
                    +((path)
                            ? ';path='+path
                            : '')
                    +((domain)
                            ? ';domain='+domain
                            : '')
                    +';expires=Thu, 01-Jan-1970 00:00:01 GMT';
        }
    };

    /*
     * Get cookie.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.cookieGet
     *
     * @params
     *      name (String): cookie name
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
     *      Cookie value.
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {String} name
     *
     * @returns {String|null}
     */
    this.cookieGet = function(name){
        const namePiece = name+"=",
              cookie    = document.cookie.split(";");
        let i;

        for (i = 0; i<cookie.length; i++){
            let cookiePiece = cookie[i];

            while (cookiePiece.charAt(0) === ' '){
                cookiePiece = cookiePiece.substring(1,
                                                    cookiePiece.length);
            }

            if (cookiePiece.indexOf(namePiece) === 0){
                return decodeURI(cookiePiece.substring(namePiece.length,
                                                       cookiePiece.length));
            }
        }

        return null;
    };

    /*
     * Set cookie.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.cookieSet
     *
     * @params
     *      name (String): cookie name
     *      value (String): cookie value
     *      expire (Number): the number of days after which the cookie will expire
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {String} name
     * @param {String} value
     * @param {Number} expire
     */
    this.cookieSet = function(name,
                              value,
                              expire){
        let expirationDate = new Date();

        expirationDate.setDate(expirationDate.getDate()+expire);
        document.cookie = name+'='+encodeURI(value)
                +((expire === null)
                        ? ''
                        : ';expires='+expirationDate.toUTCString())
                +';javahere=yes;path=/';
    };

    /*
     * Date & time.
     */

    /*
     * Returns date in requested pattern.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *      In PROJECT search for function call: DOT.prototypes.date
     *
     * @params
     *      date (String): the date that will be returned, in format YYYY-MM-DD
     *      pattern (String): the pattern of the new date; the pattern contains some constants to display the date:
     *                        [DD] : day with leading zero
     *                        [D] : day without leading zero
     *                        [MM] : month with leading zero
     *                        [M] : month without leading zero
     *                        [mm] : month name
     *                        [m] : short month name
     *                        [YYYY] : the year
     *                        [YY] : short year
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
     *      The date after pattern.
     *
     * @return_details
     *      Month names are set in application translation with prefixes [MONTH_] and [MONTH_SHORT_].
     *
     * @dv
     *      -
     *
     * @tests
     *      -
     */
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {String} date
     * @param {String} [pattern]
     *
     * @returns {String}
     */
    this.date = function(date,
                         pattern){
        const monthNames      = [DOT.text['MONTH_JANUARY'] !== undefined
                                         ? DOT.text['MONTH_JANUARY']
                                         : 'January',
                                 DOT.text['MONTH_FEBRUARY'] !== undefined
                                         ? DOT.text['MONTH_FEBRUARY']
                                         : 'February',
                                 DOT.text['MONTH_MARCH'] !== undefined
                                         ? DOT.text['MONTH_MARCH']
                                         : 'March',
                                 DOT.text['MONTH_APRIL'] !== undefined
                                         ? DOT.text['MONTH_APRIL']
                                         : 'April',
                                 DOT.text['MONTH_MAY'] !== undefined
                                         ? DOT.text['MONTH_MAY']
                                         : 'May',
                                 DOT.text['MONTH_JUNE'] !== undefined
                                         ? DOT.text['MONTH_JUNE']
                                         : 'June',
                                 DOT.text['MONTH_JULY'] !== undefined
                                         ? DOT.text['MONTH_JULY']
                                         : 'July',
                                 DOT.text['MONTH_AUGUST'] !== undefined
                                         ? DOT.text['MONTH_AUGUST']
                                         : 'August',
                                 DOT.text['MONTH_SEPTEMBER'] !== undefined
                                         ? DOT.text['MONTH_SEPTEMBER']
                                         : 'September',
                                 DOT.text['MONTH_OCTOBER'] !== undefined
                                         ? DOT.text['MONTH_OCTOBER']
                                         : 'October',
                                 DOT.text['MONTH_NOVEMBER'] !== undefined
                                         ? DOT.text['MONTH_NOVEMBER']
                                         : 'November',
                                 DOT.text['MONTH_DECEMBER'] !== undefined
                                         ? DOT.text['MONTH_DECEMBER']
                                         : 'December'],
              monthShortNames = [DOT.text['MONTH_SHORT_JANUARY'] !== undefined
                                         ? DOT.text['MONTH_SHORT_JANUARY']
                                         : 'Jan',
                                 DOT.text['MONTH_SHORT_FEBRUARY'] !== undefined
                                         ? DOT.text['MONTH_SHORT_FEBRUARY']
                                         : 'Feb',
                                 DOT.text['MONTH_SHORT_MARCH'] !== undefined
                                         ? DOT.text['MONTH_SHORT_MARCH']
                                         : 'Mar',
                                 DOT.text['MONTH_SHORT_APRIL'] !== undefined
                                         ? DOT.text['MONTH_SHORT_APRIL']
                                         : 'Apr',
                                 DOT.text['MONTH_SHORT_MAY'] !== undefined
                                         ? DOT.text['MONTH_SHORT_MAY']
                                         : 'May',
                                 DOT.text['MONTH_SHORT_JUNE'] !== undefined
                                         ? DOT.text['MONTH_SHORT_JUNE']
                                         : 'Jun',
                                 DOT.text['MONTH_SHORT_JULY'] !== undefined
                                         ? DOT.text['MONTH_SHORT_JULY']
                                         : 'Jul',
                                 DOT.text['MONTH_SHORT_AUGUST'] !== undefined
                                         ? DOT.text['MONTH_SHORT_AUGUST']
                                         : 'Aug',
                                 DOT.text['MONTH_SHORT_SEPTEMBER'] !== undefined
                                         ? DOT.text['MONTH_SHORT_SEPTEMBER']
                                         : 'Sep',
                                 DOT.text['MONTH_SHORT_OCTOBER'] !== undefined
                                         ? DOT.text['MONTH_SHORT_OCTOBER']
                                         : 'Oct',
                                 DOT.text['MONTH_SHORT_NOVEMBER'] !== undefined
                                         ? DOT.text['MONTH_SHORT_NOVEMBER']
                                         : 'Nov',
                                 DOT.text['MONTH_SHORT_DECEMBER'] !== undefined
                                         ? DOT.text['MONTH_SHORT_DECEMBER']
                                         : 'Dec'];
        let datePieces,
            day,
            dayInt,
            month,
            monthInt,
            year;

        /*
         * Verify parameters.
         */
        pattern = pattern === undefined
                ? '[YYYY]-[MM]-[DD]'
                : pattern;

        /*
         * Get date pieces.
         */
        datePieces = date.split('-');
        day = datePieces[2] !== undefined
                ? datePieces[2]
                : '01';
        dayInt = parseInt(day);
        month = datePieces[1];
        monthInt = parseInt(month);
        year = datePieces[0];

        /*
         * Set day.
         * DD, D
         */
        pattern = pattern.replace('[DD]',
                                  day);
        pattern = pattern.replace('[D]',
                                  dayInt);

        /*
         * Set month.
         * MM, M, mm, m
         */
        pattern = pattern.replace('[MM]',
                                  month);
        pattern = pattern.replace('[M]',
                                  monthInt);
        pattern = pattern.replace('[mm]',
                                  monthNames[monthInt-1]);
        pattern = pattern.replace('[m]',
                                  monthShortNames[month-1]);

        /*
         * Set year.
         * YYYY, YY
         */
        pattern = pattern.replace('[YYYY]',
                                  year);
        pattern = pattern.replace('[YY]',
                                  year.substring(2,
                                                 4));

        return pattern;
    };

    /*
     * Returns hour in requested pattern.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *      In PROJECT search for function call: DOT.prototypes.hour
     *
     * @params
     *      hour (String): the hour that will be returned, in format HH:MM
     *      pattern (String): the pattern of the new hour; the pattern contains some constants to display the date:
     *                        [HH] : hour with leading zero
     *                        [H] : hour without leading zeros
     *                        [MM] : minute with leading zeros
     *                        [M] : minute without leading zeros
     *                        [hh] : hour in AM/PM format with leading zero
     *                        [h] : hour in AM/PM format without leading zeros
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
     *      The hour after pattern.
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {String} hour
     * @param {String} [pattern]
     *
     * @returns {String}
     */
    this.hour = function(hour,
                         pattern){
        let ext = '',
            hourPieces,
            hr,
            hrInt,
            min,
            minInt;

        /*
         * Verify parameters.
         */
        pattern = pattern === undefined
                ? '[HH]:[MM]'
                : pattern;

        /*
         * Get hour pieces.
         */
        hourPieces = hour.split(':');
        hr = hourPieces[0];
        hrInt = parseInt(hr);
        min = hourPieces[1];
        minInt = parseInt(min);

        /*
         * Set hour.
         * HH, H
         */
        pattern = pattern.replace('[HH]',
                                  hr);
        pattern = pattern.replace('[H]',
                                  hrInt);

        /*
         * Set minute.
         * MM, M
         */
        pattern = pattern.replace('[MM]',
                                  min);
        pattern = pattern.replace('[M]',
                                  minInt);


        /*
         * Set AM/PM hour.
         * hh, h
         */
        if (pattern.indexOf('[hh]') !== -1
                || pattern.indexOf('[h]') !== -1){
            ext = hrInt<12 || hrInt === 24
                    ? 'AM'
                    : 'PM';

            if (hrInt === 24){
                hr = '00';
                hrInt = 0;
            }
            else if (hrInt>12){
                hrInt = hrInt-12;
                hr = DOT.prototypes.leading0(hrInt);
            }

            pattern = pattern.replace('[hh]',
                                      hr);
            pattern = pattern.replace('[h]',
                                      hrInt);
        }

        return pattern+(ext !== ''
                ? ' '+ext
                : '');
    };

    /*
     * Domains & URLs.
     */

    /*
     * Parse a $_GET variable.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.$_GET
     *
     * @params
     *      name (String): variable name
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
     *      Return the variable value or "false" if it does not exist.
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {String} name
     *
     * @returns {String|Boolean}
     */
    this.$_GET = function(name){
        const url       = window.location.href.split('?')[1], /* Get $_GET variables. */
              variables = url !== undefined
                      ? url.split('&')
                      : []; /* Parse $_GET variables. */
        let i;

        for (i = 0; i<variables.length; i++){
            if (variables[i].indexOf(name) !== -1){
                return variables[i].split('=')[1];
            }
        }

        return false;
    };

    /*
     * Inputs
     */

    /*
     * Get checkbox input value.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.checked
     *
     * @params
     *      id (String): input ID
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
     *      If the checkbox is checked "1" is returned, "0" if it's not.
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {String} id
     *
     * @returns {Number}
     */
    this.checked = function(id){
        const $id = $('#'+id);

        return $id.is(':checked')
                ? 1
                : 0;
    };

    /*
     * Strings & numbers.
     */

    /*
     * Clean an input by unwanted characters.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.cleanInput
     *
     * @params
     *      id (element): input ID
     *      allowed (String): the string of allowed characters
     *      notFirst (String): the character which can't be on the first position
     *      min (Number|String): the minimum value that is allowed in the input
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
     *      Cleaned input.
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {String} id
     * @param {String} allowed
     * @param {String} [notFirst]
     * @param {Number|String} [min]
     */
    this.cleanInput = function(id,
                               allowed,
                               notFirst,
                               min){
        const $input     = $(id),
              characters = $input.val()
                                 .split('');
        let cleaned = '',
            i,
            start   = 0;

        /*
         * Check first character.
         */
        characters.length>1 && characters[0] === notFirst
                ? start = 1
                : null;

        /*
         * Check decimal numbers if "whole" part is between or including 0 and 9.
         */
        characters.length>1 && parseInt(characters[0])>=0 && parseInt(characters[0])<=9 && characters[1] === '.'
                ? start = 0
                : null;

        /*
         * Check characters.
         */
        for (i = start; i<characters.length; i++){
            if (allowed.indexOf(characters[i]) !== -1){
                cleaned += characters[i];
            }
        }

        /*
         * Check the minimum value.
         */
        min !== undefined && min>cleaned
                ? cleaned = min
                : null;

        $input.val(cleaned);
    };

    /*
     * Email validation.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.email
     *
     * @params
     *      email (String): email to be checked
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
     *      If the email is valid "true" is returned, "false" if it's not.
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {String} email
     *
     * @returns {Boolean}
     */
    this.email = function(email){
        const filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,16}(?:\.[a-z]{2})?)$/i;

        return filter.test(email);
    };

    /*
     * Adds a leading 0 if number smaller than 10.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.leading0
     *
     * @params
     *      no (Number): the number
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
     *      The number with leading 0, if needed.
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {Number|String} no
     *
     * @returns {String}
     */
    this.leading0 = function(no){
        no = parseInt(no);

        return no<10
                ? '0'+no
                : String(no);
    };

    /*
     * Limit input characters number.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.limitSize
     *
     * @params
     *      id (element): input ID
     *      size (String): maximum number of characters
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
     *      Limited input.
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {String} id
     * @param {Number|String} size
     */
    this.limitSize = function(id,
                              size){
        const $input = $(id),
              value  = $input.val();

        $input.val(value.substring(0,
                                   parseInt(size)));
    };

    /*
     * Create a permalink from a string.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.permalink
     *
     * @params
     *      string (string): the string
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
     *      The permalink slug.
     *
     * @return_details
     *      All non-alphanumeric characters are deleted; spaces [ ] and underscore [_] characters are replaced with hyphens [-].
     *
     * @dv
     *      -
     *
     * @tests
     *      -
     */
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {String} string
     *
     * @returns {String}
     */
    this.permalink = function(string){
        string = string.replace(/[~`!@#$%^&*()+={}\[\]|\\:;"'<,>.?\/€]/g,
                                '');
        string = string.replace(/ /g,
                                '-');
        string = string.replace(/_/g,
                                '-');
        string = string.toLowerCase();

        return string;
    };

    /*
     * Creates a string with random characters.
     *
     * @usage
     *      Reserved framework function that will be called by DOT application.
     *
     *      In PROJECT search for function call: DOT.prototypes.random
     *
     * @params
     *      length (Number): the length of the returned string
     *      allowedCharacters (String): the string of allowed characters; by default only alphanumeric characters are allowed
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
     *      Random string.
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
    /* noinspection JSUnusedGlobalSymbols */
    /**
     * @param {Number} length
     * @param {String} [allowedCharacters]
     *
     * @returns {String}
     */
    this.random = function(length,
                           allowedCharacters){
        let randomString = '',
            characterPosition,
            i;

        allowedCharacters = allowedCharacters !== undefined
                ? allowedCharacters
                : '0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz';

        for (i = 0; i<length; i++){
            characterPosition = Math.floor(Math.random()*allowedCharacters.length);
            randomString += allowedCharacters.substring(characterPosition,
                                                        characterPosition+1);
        }

        return randomString;
    };

    return this.__construct();
};