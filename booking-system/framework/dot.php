<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/dot.php
 * Author                  : Dot on Paper
 * Copyright               : © 2018 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Main PHP class.
 */

if (!class_exists('DOT')){
    class DOT{
        /*
         * Public variables. The type Object can not be attributed to some variables because navigation within code will not be possible anymore.
         */
        public array $addons; // A list of all activated add-ons plugins.
        public object $ajax; // A list of all AJAX calls.
        public object $ajax_classes; // All AJAX type classes.
        public object $classes; // All framework's classes.
        public object $config;  // Reserved framework public variable for configuration.
        public object $config_js;  // Reserved framework public variable for JavaScript configuration.
        public object $controllers;  // All controller type classes.
        /**
         * @var DOTDatabase DOTDatabase
         */
        public object $db; // Reserved framework public variable for Database Class.
        public array $dv; // A list of variables that are passed from controllers to layouts.
        /**
         * @var DOTEmail DOTEmail
         */
        public object $email; // Reserved framework public variable for Email Class.
        /**
         * @var DOTHooks DOTHooks
         */
        public object $hooks; // Reserved framework public variable for Hooks Class.
        public string $language; // Current application language.
        public string $language_default; // Default application language.
        public string $language_overwrite; // "true" if language is overwritten, "false" otherwise.
        /**
         * @var DOTDocModels DOTDocModels
         */
        public object $models; // All model type classes.
        public object $paths; // Application paths.
        public object $permalink; // All data collected from controllers to create the correct page permalink.
        /**
         * @var DOTPrototypes DOTPrototypes
         */
        public object $prototypes; // Reserved framework public variable for Prototypes Class.
        public object $tables; // A list of all database tables.
        public object $views; // A list of CSS & JS files for all controllers.

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
         *      Initialize framework's public variables.
         *
         * @return_details
         *      Public variables type:
         *      addons : array
         *      ajax : object
         *          ajax->{key} : AJAX call key
         *          ajax->{key}->class : the class name
         *          ajax->{key}->method : the class method (function) name
         *
         *      ajax_classes : object
         *          ajax_classes->{key} (object): AJAX class object; {key} class key
         *
         *      classes : object
         *          classes->{key} (object): class object; {key} class key
         *
         *      config : object
         *      config_js : object
         *      controllers : object
         *          controllers->{key} (object): controller object; {key} Controller class key
         *
         *      db : object
         *      dv : array
         *          {variable} => {value}
         *          {variable} (string): variable name
         *          {value} (mixed): variable value
         *
         *      email : object
         *      hooks : object
         *      language : string
         *      language_default : string
         *          The first value of the global variable, the array [dot_languages], is the default language.
         *      language_overwrite : boolean
         *
         *      models : object
         *          models->{key} (object): model object; {key} Model class key
         *
         *      paths : object
         *          paths->abs (string): absolute path
         *          paths->url (string): application URL
         *
         *      permalink : object
         *          permalink->data (array): a list with all sections from the permalink
         *          permalink->get (string): a string with the URL syntax for $_GET variables
         *          permalink->page_name (string): current page name, words are separated with the "-" character
         *          permalink->page (string): current page, words are separated with the "_" character
         *          permalink->page_class (string): page class, words are separated with the "-" character
         *          permalink->routes (array): a list with all translated URLs keys to corresponding default URL; are used to find the correct controller
         *          permalink->routes[{key}] => {URL}
         *              {key} (string): translated URL key; "/" character is replaced with "_"
         *              {URL} (string): default URL
         *          permalink->translation (array): all translated URLs from all permalinks functions found in controllers
         *          permalink->translation[{URL}] => [{language ISO code}] => {translated URL}
         *              {URL} (string): default language URL
         *              {language ISO code} (string): language ISO 639-1 code
         *              {translated URL} (string): translated URL
         *          permalink->verify (function): verify permalink data
         *
         *      prototypes : object
         *      tables : object
         *
         *      views : object
         *          controllers->{key} (object): views object; {key} Controller class key
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        function __construct(){
            $this->addons = array();
            $this->ajax = new stdClass;
            $this->ajax_classes = new stdClass;
            $this->classes = new stdClass;
            $this->config = new stdClass;
            $this->config_js = new stdClass;
            $this->controllers = new stdClass;
            $this->db = new stdClass;
            $this->dv = array();
            $this->email = new stdClass;
            $this->hooks = new stdClass;
            $this->language = '';
            $this->language_default = '';
            $this->language_overwrite = false;
            $this->models = new stdClass;
            $this->paths = new stdClass;
            $this->permalink = new stdClass;
            $this->prototypes = new stdClass;
            $this->tables = new stdClass;
            $this->views = new stdClass;
        }

        /*
         * Initialize API.
         *
         * @usage
         *      In FILE search for function call: $this->init
         *      In FILE search for function call in hooks: array(&$this, 'init')
         *      In PROJECT search for function call: $DOT->init
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
         *      dot_classes (array): a list with all classes' details
         *
         * @functions
         *      framework/includes/class-addons.php : get() // Get installed add-ons.
         *      framework/includes/class-ajax.php : init() // Initialize AJAX classes.
         *      framework/includes/class-controllers.php : init() // Initialize controllers.
         *      framework/includes/class-controller.php : init() // Display current page.
         *      framework/includes/class-database.php : tables() // Initialize database tables list.
         *      framework/includes/class-hooks.php : add() // Add a hook.
         *      framework/includes/class-hooks.php : set() // Set a hook.
         *      framework/includes/class-menu.php : init() // Initialize admin menu.
         *      framework/includes/class-models.php : init() // Initialize models.
         *      framework/includes/class-permalink.php : set() // Set permalink data to know what controller to access.
         *      framework/includes/class-session.php : secure() // Make sessions secure by saving them in cookies.
         *      framework/includes/class-shortcode.php : init() // Initialize shortcode.
         *      framework/includes/class-translation.php : init() // Load language files.
         *      framework/includes/class-view.php : init() // Initialize view files (assets).
         *
         *      this : load() // Load all files (classes, controllers, models, translations) and initialize them.
         *      this : paths() // Set application paths.
         *
         * @hooks
         *      admin_enqueue_scripts (action-wp): hook for WordPress admin scripts
         *      admin_menu (action-wp): hook for WordPress admin menu
	     *	    config (filter): Configuration data.
         *      init (action-wp): WordPress initialization hook
         *
         * @layouts
         *      -
         *
         * @return
         *      Initialize API and display current page.
         *
         * @return_details
         *      Step 1 : Define application paths (absolute & URL).
         *      Step 2 : Load framework classes.
         *      Step 3 : Make sessions secure.
         *      Step 4 : Initialize tables.
         *      Step 5 : Get installed add-ons.
         *      Step 6 : Initialize AJAX classes.
         *      Step 7 : Initialize models.
         *      Step 8 : Initialize configuration.
         *      Step 9 : Initialize controllers.
         *      Step 10 : Initialize view files (assets).
         *      Step 11 : Initialize shortcode.
         *      Step 12 : Initialize admin menu.
         *      Step 13 : Set permalink data.
         *      Step 14 : Load translation.
         *      Step 15 : Display page.
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        public function init(){
            global $DOT;
            global $dot_classes;

            /*
             * Define paths.
             */
            $DOT->paths();

            /*
             * Initialize classes.
             */
            $DOT->load('classes',
                       $dot_classes);

            /*
             * Initialize secure session.
             */
            // $DOT->classes->session->secure();

            /*
             * Define database tables' names.
             */
            $DOT->db->tables();

            /*
             * Get installed add-ons.
             */
            $DOT->classes->addons->get();

            /*
             * Initialize AJAX.
             */
            $DOT->classes->ajax->init();

            /*
             * Initialize models.
             */
            $DOT->classes->models->init();

            /*
             * Initialize configuration.
             */
            $DOT->config = $DOT->hooks->set('config',
                                            'filter',
                                            $DOT->config);

            /*
             * Initialize controllers.
             */
            $DOT->classes->controllers->init();

            /*
             * Initialize view files.
             */
            //            $DOT->classes->view->init();

            /*
             * Initialize shortcode.
             */
            //            $DOT->classes->shortcode->init();

            /*
             * Set admin menu.
             */
            //            $DOT->hooks->add('admin_menu',
            //                             'action-wp',
            //                             array(&$DOT->classes->menu,
            //                                   'init'));

            /*
             * Set permalink data.
             */
            //            $DOT->hooks->add('init',
            //                             'action-wp',
            //                             array(&$DOT->classes->permalink,
            //                                   'set'));

            /*
             * Get translation.
             */
            //            $DOT->hooks->add('init',
            //                             'action-wp',
            //                             array(&$DOT->classes->translation,
            //                                   'init'));

            /*
             * Display admin page.
             */
            //            is_admin()
            //                    ? $DOT->hooks->add('admin_enqueue_scripts',
            //                                       'action-wp',
            //                                       array(&$DOT->classes->controller,
            //                                             'init'))
            //                    : null;
        }

        /*
         * Initialize classes.
         *
         * @usage
         *      In FILE search for function call: $this->load
         *      In FILE search for function call in hooks: array(&$this, 'load')
         *      In PROJECT search for function call: $DOT->load
         *
         * @params
         *      type (string): classes type
         *      data (array): classes data
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
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      The classes are initialized in DOT object.
         *
         * @return_details
         *      AJAX classes are initialized in DOT->ajax_classes object.
         *      Controllers are initialized in DOT->controllers object.
         *      Framework classes are initialized in DOT->classes object.
         *      Models' are initialized in DOT->models object.
         *
         *      Framework classes' are initialized in DOT->classes object.
         *      Some framework classes have their own reserved DOT object:
         *      DOT->db : framework/includes/class-database.php
         *      DOT->email : framework/includes/class-email.php
         *      DOT->hooks : framework/includes/class-hooks.php
         *      DOT->prototypes : framework/includes/class-prototypes.php
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        /**
         * @param string $type
         * @param array $data
         */
        public function load($type,
                             $data){
            global $DOT;

            foreach ($data as $key => $class){
                $name = $class->class ?? '';
                $file = $class->file;

                include_once($type == 'classes'
                        ? $DOT->paths->abs.'/framework/includes/'.$file.'.php'
                        : $file);

                if ($name != ''){
                    if (class_exists($name)){
                        if ($type == 'classes'
                                && ($key == 'db'
                                        || $key == 'email'
                                        || $key == 'hooks'
                                        || $key == 'prototypes')){
                            /*
                             * Set framework reserved classes.
                             */
                            $DOT->{$key} = new $name();
                        }
                        else{
                            $DOT->{$type}->{$key} = new $name();
                        }
                    }
                    else{
                        /*
                         * Add a message if there is a problem with the class.
                         */
                        $DOT->{$type}->{$key} = match ($type) {
                            'ajax_classes' => 'AJAX class does not exist!',
                            'classes'      => 'Class does not exist!',
                            'controllers'  => 'Controller does not exist!',
                            'models'       => 'Model does not exist!'
                        };
                    }
                }
            }
        }

        /*
         * Defines paths.
         *
         * @usage
         *      In FILE search for function call: $this->paths
         *      In FILE search for function call in hooks: array(&$this, 'paths')
         *      In PROJECT search for function call: $DOT->paths
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
         *      -
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Set application URL & absolute path.
         *
         * @return_details
         *      The paths are set in object DOT->paths object.
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        public function paths(){
            global $DOT;

            /*
             * Application URL.
             */
            $DOT->paths->url = !str_ends_with(DOT_URL,
                                              '/')
                    ? DOT_URL
                    : substr(DOT_URL,
                             0,
                             -1);

            /*
             * Absolute path.
             */
            $DOT->paths->abs = !str_ends_with(DOT_ABS_PATH,
                                              '/')
                    ? DOT_ABS_PATH
                    : substr(DOT_ABS_PATH,
                             0,
                             -1);
        }

        /*
         * Functions used in application.
         */

        /*
         * Get, set or delete a cookie.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->cookie
         *      In FILE search for function call in hooks: array(&$this, 'cookie')
         *      In PROJECT search for function call: $DOT->cookie
         *
         * @params
         *      name (string): cookie name
         *      value (string): cookie value
         *      expire (integer): cookie lifetime in seconds
         *      path (string): the path where the cookie is available
         *      domain (string): the (sub)domain where the cookie is available
         *      secure (boolean): the cookie should be available over a https connection or not
         *      http (boolean): the cookie should be made accessible only through the HTTP protocol
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
         *      DOT_COOKIE_EXPIRE (integer): default cookie expiration time in seconds
         *      DOT_COOKIE_PATH (string): default cookie path
         *      DOT_COOKIE_DOMAIN (string): default cookie (sub)domain
         *      DOT_COOKIE_SECURE (boolean): default cookie security
         *      DOT_COOKIE_HTTP (boolean): default cookie HTTP access
         *
         * @globals
         *      DOT (object): DOT framework main class variable
         *
         * @functions
         *      framework/includes/class-cookie.php : delete() // Delete a cookie.
         *      framework/includes/class-cookie.php : get() // Get cookie value.
         *      framework/includes/class-cookie.php : set() // Set cookie value.
         *
         * @layouts
         *      -
         *
         * @hooks
         *      -
         *
         * @return
         *      Return the cookie value or "false" if it does not exist, or "true" if the cookie was set.
         *
         * @return_details
         *      If [value] is "null" the cookie will be returned, if not the cookie will be set.
         *      If expiration value is "-1" the cookie will be deleted.
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
         * @param string $name
         * @param string $value
         * @param integer $expire
         * @param string $path
         * @param string $domain
         * @param boolean $secure
         * @param boolean $http
         *
         * @return mixed
         */
        public function cookie($name,
                               $value = null,
                               $expire = DOT_COOKIE_EXPIRE,
                               $path = DOT_COOKIE_PATH,
                               $domain = DOT_COOKIE_DOMAIN,
                               $secure = DOT_COOKIE_SECURE,
                               $http = DOT_COOKIE_HTTP){
            global $DOT;

            if ($expire == -1){
                return $DOT->classes->cookie->delete($name,
                                                     '',
                                                     $expire,
                                                     $path,
                                                     $domain,
                                                     $secure,
                                                     $http);
            }
            else{
                return $value === null
                        ? $DOT->classes->cookie->get($name)
                        : $DOT->classes->cookie->set($name,
                                                     $value,
                                                     $expire,
                                                     $path,
                                                     $domain,
                                                     $secure,
                                                     $http);
            }
        }

        /*
         * Display content.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->display
         *      In FILE search for function call in hooks: array(&$this, 'display')
         *      In PROJECT search for function call: $DOT->display
         *
         * @params
         *      page (string): content (layout, HTML, JSON, ...) to be displayed
         *      data (array): the data that will be passed to the page
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
         *      framework/includes/class-view.php : render() // Render the content.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Display minified content.
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
         *
         * @param string $file
         * @param array $data
         */
        public function display($file,
                                $data = array()){
            global $DOT;

            $DOT->classes->view->render($DOT->paths->abs.'/application/views/'.$file.'.php',
                                        $data);
        }

        /*
         * Escape and outputs an expression.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->echo
         *      In FILE search for function call in hooks: array(&$this, 'echo')
         *      In PROJECT search for function call: $DOT->echo
         *
         * @params
         *      expression (mixed): the expression
         *      escape (string): escape type
         *      html (array): allowed HTML
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
         *      this : escape() // Escape value against malicious content or just return the correct value format.
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
         * @param mixed $expression
         * @param string $escape
         * @param array $html
         */
        public function echo($expression,
                             $escape = 'html',
                             $html = array()){
            global $DOT;

            if ($escape !== 'json'
                    && (is_array($expression)
                            || is_object($expression))){
                foreach ($expression as $item){
                    $escape_item = match (gettype($item)) {
                        'integer' => 'int',
                        'double'  => 'float',
                        default   => $escape,
                    };

                    $DOT->echo($item,
                               $escape_item,
                               $html);
                }
            }
            else{
                echo $this->escape($expression,
                                   $escape,
                                   $html);
            }
        }

        /*
         * Escape value against malicious content or just return the correct value format.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->escape
         *      In FILE search for function call in hooks: array(&$this, 'escape')
         *      In PROJECT search for function call: $DOT->escape
         *
         * @params
         *      value (string): the value that will be escaped
         *      type (string): escaping type
         *      html (array): allowed HTML
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
         *      framework/includes/class-sanitize.php : attr() // Escape HTML attribute values.
         *      framework/includes/class-sanitize.php : content() // Escape content values.
         *      framework/includes/class-sanitize.php : float() // Escape float values.
         *      framework/includes/class-sanitize.php : html() // Escape HTML in values.
         *      framework/includes/class-sanitize.php : int() // Escape integer values.
         *      framework/includes/class-sanitize.php : js() // Escape JS values.
         *      framework/includes/class-sanitize.php : textarea() // Escape textarea values.
         *      framework/includes/class-sanitize.php : url() // Escape URL values.
         *
         *      this // The function is recursive.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      The escaped value.
         *
         * @return_details
         *      If the value is an array or object each individual value is escaped.
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
         * @param mixed $value
         * @param string $type
         * @param array $html
         *
         * @return mixed
         */
        public function escape($value,
                               $type = 'html',
                               $html = array()){
            global $DOT;

            if ($type !== 'json'
                    && (is_array($value)
                            || is_object($value))){
                foreach ($value as $key => $item){
                    $type_item = match (gettype($item)) {
                        'integer' => 'int',
                        'double'  => 'float',
                        default   => $type,
                    };

                    is_array($value)
                            ? $value[$key] = $DOT->escape($item,
                                                          $type_item,
                                                          $html)
                            : $value->{$key} = $DOT->escape($item,
                                                            $type_item,
                                                            $html);
                }

                return $value;
            }
            else{
                $value = match ($type) {
                    'attr'     => $DOT->classes->escape->attr($value),
                    'content'  => $DOT->classes->escape->content($value,
                                                                 $html),
                    'float'    => $DOT->classes->escape->float($value),
                    'html'     => $DOT->classes->escape->html($value),
                    'int'      => $DOT->classes->escape->int($value),
                    'js'       => $DOT->classes->escape->js($value),
                    'json'     => $DOT->classes->escape->json($value),
                    'textarea' => $DOT->classes->escape->textarea($value),
                    'url'      => $DOT->classes->escape->url($value)
                };
            }

            return $value;
        }

        /*
         * Get a $_FILES variable.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->file
         *      In FILE search for function call in hooks: array(&$this, 'file')
         *      In PROJECT search for function call: $DOT->file
         *
         * @params
         *      variable (string): variable name
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
         *      Return the file or "false" if it does not exist.
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
         *
         * @param string $variable
         *
         * @return mixed|false
         */
        public function file($variable){
            return $_FILES[$variable] ?? false;
        }

        /*
         * Get a $_GET variable.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->get
         *      In FILE search for function call in hooks: array(&$this, 'get')
         *      In PROJECT search for function call: $DOT->get
         *
         * @params
         *      variable (string): variable name
         *      type (string): variable type
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
         *      WP : stripslashes_deep() // Navigates through an array | object | string and removes slashes from the values.
         *
         *      this : sanitize() // Sanitize value against malicious content or just return the correct value format.
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
         *      The result is sanitized.
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
         * @param string $variable
         * @param string $type
         *
         * @return mixed|false
         */
        public function get($variable,
                            $type = 'text'){
            global $DOT;

            return isset($_GET[$variable])
                    ? $DOT->sanitize(stripslashes_deep($_GET[$variable]),
                                     $type)
                    : false;
        }

        /*
         * Generate a link for a page or an asset in the application.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->link
         *      In FILE search for function call in hooks: array(&$this, 'link')
         *      In PROJECT search for function call: $DOT->link
         *
         * @params
         *      path (string): URL path
         *      permalink (boolean): generate a permalink depending on selected language
         *      display (boolean): display the link or return it
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
         *      framework/includes/class-permalink.php : get() // Get permalink.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      The link.
         *
         * @return_details
         *      If variable [display] value is:
         *          true : The link will be "written".
         *          false : The link will be "returned".
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
         * @param string $path
         * @param boolean $permalink
         * @param boolean $display
         *
         * @return string|false
         */
        /*
         * @TODO
         *      Finish function.
         */
        public function link($path,
                             $permalink = true,
                             $display = true){
            global $DOT;

            $link = $DOT->classes->permalink->get($path,
                                                  $permalink);

            /*
             * Return or display the link.
             */
            if ($display){
                $DOT->echo($link,
                           'url');
            }
            else{
                return $link;
            }

            return false;
        }

        /*
         * Get a $_POST variable.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->post
         *      In FILE search for function call in hooks: array(&$this, 'post')
         *      In PROJECT search for function call: $DOT->post
         *
         * @params
         *      variable (string): variable name
         *      type (string): variable type
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
         *      WP : stripslashes_deep() // Navigates through an array | object | string and removes slashes from the values.
         *
         *      this : sanitize() // Sanitize value against malicious content or just return the correct value format.
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
         *      If "Magic quotes" option is enabled, the slashes are stripped.
         *      The result is sanitized.
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
         * @param string $variable
         * @param string $type
         *
         * @return mixed|false
         */
        public function post($variable,
                             $type = 'text'){
            global $DOT;

            return isset($_POST[$variable])
                    ? $DOT->sanitize(stripslashes_deep($_POST[$variable]),
                                     $type)
                    : false;
        }

        /*
         * Sanitize value against malicious content or just return the correct value format.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->sanitize
         *      In FILE search for function call in hooks: array(&$this, 'sanitize')
         *      In PROJECT search for function call: $DOT->sanitize
         *
         * @params
         *      value (string): the value that will be sanitized
         *      type (string): sanitization type
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
         *      framework/includes/class-sanitize.php : float() // Sanitize float values.
         *      framework/includes/class-sanitize.php : html() // Sanitize values but allow HTML tags.
         *      framework/includes/class-sanitize.php : int() // Sanitize integer values.
         *      framework/includes/class-sanitize.php : tags() // Sanitize HTML tags from a value.
         *      framework/includes/class-sanitize.php : text() // Sanitize text values.
         *      framework/includes/class-sanitize.php : textarea() // Sanitize textarea values.
         *      framework/includes/class-sanitize.php : url() // Sanitize URL values.
         *
         *      this // The function is recursive.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      The sanitized value.
         *
         * @return_details
         *      If the value is an array or object each individual value is sanitized.
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
         * @param mixed $value
         * @param string $type
         *
         * @return mixed
         */
        public function sanitize($value,
                                 $type = 'text'){
            global $DOT;

            if (is_array($value)
                    || is_object($value)){
                foreach ($value as $key => $item){
                    $type_item = match (gettype($item)) {
                        'integer' => 'int',
                        'double'  => 'float',
                        default   => $type,
                    };

                    is_array($value)
                            ? $value[$key] = $DOT->sanitize($item,
                                                            $type_item)
                            : $value->{$key} = $DOT->sanitize($item,
                                                              $type_item);
                }

                return $value;
            }
            else{
                $value = match ($type) {
                    'float'    => $DOT->classes->sanitize->float($value),
                    'html'     => $DOT->classes->sanitize->html($value),
                    'int'      => $DOT->classes->sanitize->int($value),
                    'tags'     => $DOT->classes->sanitize->tags($value),
                    'text'     => $DOT->classes->sanitize->text($value),
                    'textarea' => $DOT->classes->sanitize->textarea($value),
                    'url'      => $DOT->classes->sanitize->url($value),
                    default  => $value
                };
            }

            return $value;
        }

        /*
         * Get or set a session.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->session
         *      In FILE search for function call in hooks: array(&$this, 'session')
         *      In PROJECT search for function call: $DOT->session
         *
         * @params
         *      name (string): session name
         *      value (string): session value
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
         *      framework/includes/class-session.php : get() // Get session value.
         *      framework/includes/class-session.php : set() // Set session value.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Return the session value or "false" if it does not exist, or "true" if the session was set.
         *
         * @return_details
         *      If [value] is "null" the session will be returned, if not the session will be set.
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
         * @param string $name
         * @param string|null $value
         *
         * @return mixed
         */
        public function session($name,
                                $value = null){
            global $DOT;

            return $value === null
                    ? $DOT->classes->session->get($name)
                    : $DOT->classes->session->set($name,
                                                  $value);
        }

        /*
         * Get text.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->text
         *      In FILE search for function call in hooks: array(&$this, 'text')
         *      In PROJECT search for function call: $DOT->text
         *
         * @params
         *      key (string): translation text key
         *      fallback (string): fallback text if key is invalid
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
         *      dot_text (array): a list with language's text
         *      dot_text_default (array): a list with default language's text
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
         *      The text.
         *
         * @return_details
         *      The text is returned based on a key. If the key does not exist, verify if it has the JavaScript key, verify default language text, or you can set a fallback text (!).
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
         * @param string $key
         * @param string $fallback
         *
         * @return string
         */
        public function text($key,
                             $fallback = '!'){
            global $DOT;
            global $dot_text;
            global $dot_text_default;

            /*
             * Return selected language text.
             */
            if (isset($dot_text[$key])){
                return $dot_text[$key];
            }

            /*
             * If JavaScript key is present return selected language text.
             */
            if (isset($dot_text[$key.'_JS'])){
                return $dot_text[$key.'_JS'];
            }

            /*
             * Return selected language text from automatic translation.
             */
            $text = $DOT->config->translation[$DOT->language] ?? new stdClass;

            if (isset($text->{$key})){
                return isset($text->{$key}->no)
                        ? $text->{$key}->text[array_search(max($text->{$key}->no),
                                                           $text->{$key}->no)]
                        : $text->{$key}->text;
            }

            if (isset($text->{$key.'_JS'})){
                return isset($text->{$key.'_JS'}->no)
                        ? $text->{$key.'_JS'}->text[array_search(max($text->{$key.'_JS'}->no),
                                                                 $text->{$key.'_JS'}->no)]
                        : $text->{$key.'_JS'}->text;
            }

            /*
             * Fallback to default language text.
             */
            if (isset($dot_text_default[$key])){
                return $dot_text_default[$key];
            }

            /*
             * If JavaScript key is present return default language text.
             */
            if (isset($dot_text_default[$key.'_JS'])){
                return $dot_text_default[$key.'_JS'];
            }

            /*
             * Return fallback text.
             */
            return $fallback;
        }
    }
}