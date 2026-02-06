<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-view.php
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : View PHP class.
 */

if (!class_exists('DOTView')){
    class DOTView{
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
        function __construct(){
        }

        /*
         * Initialize view files (assets).
         *
         * @usage
         *      In FILE search for function call: $this->init
         *      In FILE search for function call in hooks: array(&$this, 'init')
         *      In PROJECT search for function call: $DOT->classes->view->init
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
         *      DOT (object): DOT framework main class variable
         *      dot_css (array): a list with all CSS files that will be loaded on a page; the array will contain up to 3 keys each with its own array:
         *          beta : The list of CSS files that will appear on development site.
         *          live : The list of CSS files that will appear on live site.
         *          page : The list of CSS files which content will appear in page header.
         *
         *      dot_js (array): a list with all JS files that will be loaded on a page; the array will contain up to 3 keys each with its own array:
         *          beta : The list of JavaScript files that will appear on development site.
         *          live : The list of JavaScript files that will appear on live site (usually one minified version).
         *          page : The list of JavaScript files which content will appear in page footer.
         *
         * @functions
         *      framework/includes/class-hooks.php : add() // Add a hook.
         *
         *      application/controllers/{controller}.php : css() // Add CSS files specific to this page.
         *      application/controllers/{controller}.php : js() // Add JS files specific to this page.
         *
         *      this : css() // Register CSS files.
         *      this : cssCode() // Include CSS code in HTML page.
         *      this : js() // Register JavaScript.
         *      this : jsCode() // Include JavaScript code in HTML page.
         *
         * @hooks
         *      admin_enqueue_scripts (action-wp): hook for WordPress admin scripts
         *      admin_footer (action-wp): hook for WordPress admin footer
         *      admin_head (action-wp): hook for WordPress admin header
         *      wp_enqueue_scripts (action-wp): hook for WordPress scripts
         *      wp_footer (action-wp): hook for WordPress footer
         *      wp_head (action-wp): hook for WordPress header
         *
         * @layouts
         *      -
         *
         * @return
         *      Get assets files.
         *
         * @return_details
         *      The CSS files are added to [DOT->views->{$key}->css] object and the JavaScript files are added to [DOT->views->{$key}->js].
         *
         *      [DOT->views->{$key}->css] variable description:
         *      {$key} : Controller class key
         *      css : array
         *          css['beta'] (array): The list of CSS files that will appear on development site.
         *          css['keys'] (array): The list of registered CSS files.
         *          css['live'] (array) : The list of CSS files that will appear on live site.
         *          css['page'] (array) : The list of CSS files which content will appear in page header.
         *
         *      [DOT->views->{$key}->js] variable description:
         *      {$key} : Controller class key
         *      js : array
         *          js['beta'] (array): The list of JavaScript files that will appear on development site.
         *          js['keys'] (array): The list of registered JavaScript files.
         *          js['live'] (array) : The list of JavaScript files that will appear on live site.
         *          js['page'] (array) : The list of JavaScript files which content will appear in page header.
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        public function init(){
            global $DOT;
            global $dot_css;
            global $dot_js;

            /*
             * Add JavaScript data on page.
             */
            array_unshift($dot_js['page'],
                          'framework/assets/js/data.php');

            /*
             * Get controllers CSS & JS files.
             */
            foreach ($DOT->controllers as $key => $controller){
                $DOT->views->{$key} = new stdClass;
                $DOT->views->{$key}->css = array();
                $DOT->views->{$key}->css['keys'] = array();
                $DOT->views->{$key}->js = array();
                $DOT->views->{$key}->js['keys'] = array();

                if (method_exists($controller,
                                  'css')){
                    $css = $controller->css();

                    $DOT->views->{$key}->css['beta'] = $dot_css['beta'];
                    $DOT->views->{$key}->css['live'] = $dot_css['live'];
                    $DOT->views->{$key}->css['page'] = $dot_css['page'];

                    $DOT->views->{$key}->css['beta'] = isset($css['beta'])
                            ? array_merge($DOT->views->{$key}->css['beta'],
                                          $css['beta'])
                            : $DOT->views->{$key}->css['beta'];
                    $DOT->views->{$key}->css['live'] = isset($css['live'])
                            ? array_merge($DOT->views->{$key}->css['live'],
                                          $css['live'])
                            : $DOT->views->{$key}->css['live'];
                    $DOT->views->{$key}->css['page'] = isset($css['page'])
                            ? array_merge($DOT->views->{$key}->css['page'],
                                          $css['page'])
                            : $DOT->views->{$key}->css['page'];
                }

                if (method_exists($controller,
                                  'js')){
                    $js = $controller->js();

                    $DOT->views->{$key}->js['beta'] = $dot_js['beta'];
                    $DOT->views->{$key}->js['live'] = $dot_js['live'];
                    $DOT->views->{$key}->js['page'] = $dot_js['page'];

                    $DOT->views->{$key}->js['beta'] = isset($js['beta'])
                            ? array_merge($DOT->views->{$key}->js['beta'],
                                          $js['beta'])
                            : $DOT->views->{$key}->js['beta'];
                    $DOT->views->{$key}->js['live'] = isset($js['live'])
                            ? array_merge($DOT->views->{$key}->js['live'],
                                          $js['live'])
                            : $DOT->views->{$key}->js['live'];
                    $DOT->views->{$key}->js['page'] = isset($js['page'])
                            ? array_merge($DOT->views->{$key}->js['page'],
                                          $js['page'])
                            : $DOT->views->{$key}->js['page'];
                }
            }

            if (is_admin()){
                /*
                 * Add assets to admin area.
                 */
                $DOT->hooks->add('admin_head',
                                 'action-wp',
                                 array(&$this,
                                       'cssCode'));
                $DOT->hooks->add('admin_enqueue_scripts',
                                 'action-wp',
                                 array(&$this,
                                       'css'));
                $DOT->hooks->add('admin_footer',
                                 'action-wp',
                                 array(&$this,
                                       'jsCode'));
                $DOT->hooks->add('admin_enqueue_scripts',
                                 'action-wp',
                                 array(&$this,
                                       'js'));
            }
            else{
                /*
                 * Add assets to front end.
                 */
                $DOT->hooks->add('wp_head',
                                 'action-wp',
                                 array(&$this,
                                       'cssCode'));
                $DOT->hooks->add('wp_enqueue_scripts',
                                 'action-wp',
                                 array(&$this,
                                       'css'));
                $DOT->hooks->add('wp_footer',
                                 'action-wp',
                                 array(&$this,
                                       'jsCode'));
                $DOT->hooks->add('wp_enqueue_scripts',
                                 'action-wp',
                                 array(&$this,
                                       'js'));
            }
        }

        /*
         * Register CSS files.
         *
         * @usage
         *      In FILE search for function call: $this->css
         *      In FILE search for function call in hooks: array(&$this, 'css')
         *      In PROJECT search for function call: $DOT->classes->view->css
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
         *      DOT_ID (string): unique application ID
         *      DOT_STATUS (string): application status (beta, live, maintenance)
         *
         * @globals
         *      DOT (object): DOT framework main class variable
         *
         * @functions
         *      WP : wp_register_style() // Register CSS files in WordPress.
         *
         *      framework/includes/class-prototypes.php : random() // Creates a string with random characters.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Register the CSS files in header for {beta} or {live} website.
         *
         * @return_details
         *      -
         *
         * @dv
         *
         * @tests
         *      -
         */
        public function css(){
            global $DOT;

            $css = array();
            $page_views = $DOT->views->{$DOT->permalink->page};

            foreach ($page_views->css[DOT_STATUS] as $file){
                /*
                 * Search if the file has already been registered.
                 */
                $search = array_search($file,
                                       $css);

                if ($search === false){
                    $path_sections = explode('/',
                                             $file);
                    $path_sections_last = $path_sections[count($path_sections)-1];
                    $file_name = str_contains($path_sections_last,
                                              '.css')
                            ? str_replace('.css',
                                          '',
                                          $path_sections_last)
                            : $DOT->prototypes->random(16,
                                                       'abcdefghiklmnopqrstuvwxyz');
                    $key = DOT_ID.'-'.$file_name;

                    /*
                     * Register styles.
                     */
                    wp_register_style($key,
                                      $file,
                                      [],
                                      DOT_VERSION);

                    /*
                     * Save file & key.
                     */
                    $css[$key] = $file;
                    $page_views->css['keys'][] = $key;
                }
                else{
                    $page_views->css['keys'][] = $search;
                }
            }
        }

        /*
         * Include CSS code in HTML page.
         *
         * @usage
         *      In FILE search for function call: $this->cssCode
         *      In FILE search for function call in hooks: array(&$this, 'cssCode')
         *      In PROJECT search for function call: $DOT->classes->view->cssCode
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
         *      DOT (object): DOT framework main class variable
         *
         * @functions
         *      this : render() // Minifies the content of the CSS files.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Get minified CSS code.
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
         * @noinspection PhpUnused
         */
        public function cssCode(){
            global $DOT;

            /*
             * Get CSS files.
             */
            $css = array();
            $page_views = $DOT->views->{$DOT->permalink->page};

            foreach ($page_views->css['page'] as $file){
                !in_array($file,
                          $css)
                        ? array_push($css,
                                     $DOT->paths->abs.'/'.$file)
                        : null;
            }

            echo '<style>';
            $this->render($css);
            echo '</style>';
        }

        /*
         * Register JavaScript files.
         *
         * @usage
         *      In FILE search for function call: $this->js
         *      In FILE search for function call in hooks: array(&$this, 'js')
         *      In PROJECT search for function call: $DOT->classes->view->js
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
         *      DOT_ID (string): unique application ID
         *      DOT_STATUS (string): application status (beta, live, maintenance)
         *
         * @globals
         *      DOT (object): DOT framework main class variable
         *
         * @functions
         *      WP : wp_register_script() // Register JavaScript files in WordPress.
         *      WP : wp_script_is() // Determine if a script has been registered, enqueued, printed, or is waiting to be printed in WordPress.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Register JavaScript files for {beta} or {live} website.
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
         * @noinspection PhpUnused
         */
        public function js(){
            global $DOT;

            $js = array();
            $page_views = $DOT->views->{$DOT->permalink->page};

            /*
             * Libraries
             */
            !wp_script_is('jquery',
                          'queue')
                    ? wp_enqueue_script('jquery')
                    : null;
            !wp_script_is('jquery-effects-core',
                          'queue')
                    ? wp_enqueue_script('jquery-effects-core')
                    : null;
            !wp_script_is('jquery-ui-sortable',
                          'queue')
                    ? wp_enqueue_script('jquery-ui-sortable')
                    : null;
            !wp_script_is('jquery-touch-punch',
                          'queue')
                    ? wp_enqueue_script('jquery-touch-punch')
                    : null;

            foreach ($page_views->js[DOT_STATUS] as $file){
                /*
                 * Search if the file has already been registered.
                 */
                $search = array_search($file,
                                       $js);

                if ($search === false){
                    $path_sections = explode('/',
                                             $file);
                    $file_name = str_replace('.js',
                                             '',
                                             $path_sections[count($path_sections)-1]);
                    $key = DOT_ID.'-js-'.$file_name;

                    /*
                     * Register scripts.
                     */
                    wp_register_script($key,
                                       $file,
                                       array('jquery'),
                                       DOT_VERSION,
                                       true);

                    /*
                     * Save file & key.
                     */
                    $js[$key] = $file;
                    $page_views->js['keys'][] = $key;
                }
                else{
                    $page_views->js['keys'][] = $search;
                }
            }
        }

        /*
         * Include JavaScript code in HTML page.
         *
         * @usage
         *      In FILE search for function call: $this->jsCode
         *      In FILE search for function call in hooks: array(&$this, 'jsCode')
         *      In PROJECT search for function call: $DOT->classes->view->jsCode
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
         *      DOT (object): DOT framework main class variable
         *
         * @functions
         *      this : render() // Minifies the content of the JavaScript files.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Get minified JavaScript code.
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
         * @noinspection PhpUnused
         */
        public function jsCode(){
            global $DOT;

            /*
             * Get JavaScript files.
             */
            $js = array();
            $page_views = $DOT->views->{$DOT->permalink->page};

            foreach ($page_views->js['page'] as $file){
                !in_array($file,
                          $js)
                        ? array_push($js,
                                     $DOT->paths->abs.'/'.$file)
                        : null;
            }

            echo '<script>';
            $this->render($js);
            echo '</script>';
        }

        /*
         * Render an HTML/CSS/JavaScript page/layout.
         *
         * @usage
         *      In FILE search for function call: $this->render
         *      In FILE search for function call in hooks: array(&$this, 'render')
         *      In PROJECT search for function call: $DOT->classes->view->render
         *
         * @params
         *      files (array/string): file(s) to be rendered
         *      data (array): the data that will be passed to the file
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
         *      DOT (object): DOT framework main class variable
         *
         * @functions
         *      this : minify() // Minifies the file content.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Get file content.
         *
         * @return_details
         *      The data that is passed to a file can be used only in this file and not in a files that are rendered inside it.
         *      To pass data to inner files use [DOT->dv] framework's public variable.
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param array|string $files
         * @param array $data
         */
        public function render($files,
                               $data = array()){
            /*
             * Turn on output buffering and minify its content.
             */
            ob_start('DOTView::minify');

            /*
             * Add [DOT] global variable to be used in the file.
             */
            global $DOT; // Do not remove because of IDEs notifications.

            /*
             * Add [data] variables to be used in the file.
             */
            extract($data);

            /*
             * Include the file(s).
             */
            if (is_array($files)){
                foreach ($files as $file){
                    include($file);
                }
            }
            else{
                include($files);
            }

            /*
             * Send the output buffer.
             */
            ob_flush();

            /*
             * Display current buffer contents and delete current output buffer.
             */
            echo ob_get_clean();
        }

        /*
         * Minify HTML/CSS/JavaScript code.
         *
         * @usage
         *      In FILE search for function call: $this->minify
         *      In FILE search for function call in hooks: array(&$this, 'minify')
         *      In PROJECT search for function call: $DOT->classes->view->minify / DOTView::minify
         *
         * @params
         *      code (string): page code
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
         *      DOT (object): DOT framework main class variable
         *
         * @functions
         *      this : block() // Block minification.
         *      this : unblock() // Unblock minification.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Minified file code & content.
         *
         * @return_details
         *      Replace "dot-css-assets-url" text in CSS files with the application URL.
         *      Remove comments or any content inside /*{ content }* /.
         *      Remove empty spaces.
         *      Remove new lines, new rows, tabs, ...
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param string $code
         *
         * @return string
         */
        public function minify($code){
            global $DOT;

            /*
             * Block minification in <pre> & <textarea> tags.
             */
            $code = preg_replace_callback('/>[^<]*<\\/pre/i',
                                          array(&$this,
                                                'block'),
                                          $code);
            $code = preg_replace_callback('/>[^<]*<\\/textarea/i',
                                          array(&$this,
                                                'block'),
                                          $code);

            $search = array('/dot-css-assets-url/'                                                                                                        => $DOT->paths->url, // Add application URL in CSS files.
                            '!/\*.*?\*/!s'                                                                                                                => '', // Remove comments.
                            '/ +/'                                                                                                                        => ' ', // Remove empty spaces.
                            '/<!--\{(.*?)\}-->|<!--(.*?)-->|[\t\r\n]|<!--|-->|\/\/ <!--|\/\/ -->|<!\[CDATA\[|\/\/ \]\]>|\]\]>|\/\/\]\]>|\/\/<!\[CDATA\[/' => ''); // Remove new lines, new rows, tabs, ...
            $code = preg_replace(array_keys($search),
                                 array_values($search),
                                 $code);

            /*
             * Unblock minification in <pre> & <textarea> tags.
             */
            $code = preg_replace_callback('/>[^<]*<\\/textarea/i',
                                          array(&$this,
                                                'unblock'),
                                          $code);

            return preg_replace_callback('/>[^<]*<\\/pre/i',
                                         array(&$this,
                                               'unblock'),
                                         $code);
        }

        /*
         * Block minification.
         *
         * @usage
         *      In FILE search for function call: $this->block
         *      In FILE search for function call in hooks: array(&$this, 'block')
         *      In PROJECT search for function call: $DOT->classes->view->block
         *
         * @params
         *      code (string): page code
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
         *      Replace specific [code] with specific [marker].
         *
         * @return_details
         *      [code] : [marker]
         *
         *      "\n" : {{{newline}}}
         *      "\t" : {{{tab}}}
         *      " " : {{{space}}}
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param string $code
         *
         * @return string
         */
        public function block($code){
            $code = $code[0];

            $code = preg_replace('/\\n/',
                                 '{{{newline}}}',
                                 $code);
            $code = preg_replace('/\\t/',
                                 '{{{tab}}}',
                                 $code);

            return preg_replace('/\\s/',
                                '{{{space}}}',
                                $code);
        }

        /*
         * Unblock minification.
         *
         * @usage
         *      In FILE search for function call: $this->unblock
         *      In FILE search for function call in hooks: array(&$this, 'unblock')
         *      In PROJECT search for function call: $DOT->classes->view->unblock
         *
         * @params
         *      code (string): page code
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
         *      Replace specific [marker] with specific [code].
         *
         * @return_details
         *      [marker] : [code]
         *
         *      {{{newline}}} : "\n"
         *      {{{tab}}} : "\t"
         *      {{{space}}} : " "
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @noinspection PhpUnused
         *
         * @param string $code
         *
         * @return string
         */
        public function unblock($code){
            $code = $code[0];

            $code = preg_replace('/{{{newline}}}/',
                                 "\n",
                                 $code);
            $code = preg_replace('/{{{tab}}}/',
                                 "\t",
                                 $code);

            return preg_replace('/{{{space}}}/',
                                " ",
                                $code);
        }
    }
}