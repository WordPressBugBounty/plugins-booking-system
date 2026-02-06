/*
 * Title                   : DOT Framework
 * File                    : framework/assets/js/min/sanitize.js
 * Author                  : Dot on Paper
 * Copyright               : © 2021 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Minified -> JavaScript sanitize functions.
 */

DOT.sanitize=new function(){"use strict";return this.__construct=function(){},this.get=function(t,n){switch(n=void 0===n?"text":n){case"float":return DOT.sanitize["float"](t);case"int":return DOT.sanitize["int"](t);case"text":case"textarea":return DOT.sanitize.text(t)}},this["float"]=function(t){return parseFloat(t)},this["int"]=function(t){return parseInt(t)},this.text=function(t){return t},this.__construct()};