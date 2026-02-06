<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-database.php
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Database PHP class.
 */

if (!class_exists('DOTDatabase')){
    class DOTDatabase{
        /*
         * Public variables.
         */
        public string $db_collation; // Database collation.
        public object $db_config; // Database tables configuration.
        public object $db_tables; // Database tables data.
        public string $error; // Query error description.
        public mixed $insert_id; // The ID of a row when it is added to a table.
        public mixed $result; // A list with query results.
        public mixed $result_query; // An object with query results.
        public int $rows_affected; // The number of rows affected by a query.
        public int $rows_no; // The number of rows returned by a query.
        public string $query; // The query that is being executed.

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
         *      DOT (object): DOT framework main class variable
         *
         * @functions
         *      framework/includes/class-hooks.php : add() // Add a hook.
         *
         *      this : add() // Add database.
         *
         * @hooks
         *      init (action-wp): WordPress initialization hook
         *
         * @layouts
         *      -
         *
         * @return
         *      Create database.
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
            global $DOT;

            $DOT->hooks->add('init',
                             'action-wp',
                             array(&$this,
                                   'add'));
        }

        /*
         * Main functions.
         */

        /*
         * Add database.
         *
         * @usage
         *      In FILE search for function call: $this->add
         *      In FILE search for function call in hooks: array(&$this, 'add')
         *      In PROJECT search for function call: $DOT->db->add
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
         *      ABSPATH (string): WordPress absolute path
         *      DOT_ID (string): unique application ID
         *      DOT_DATABASE_UPDATE (boolean): update database
         *      DOT_DATABASE_VERSION (float): database version
         *
         * @globals
         *      wpdb (object): WordPress database object
         *
         *      DOT (object): DOT framework main class variable
         *
         * @functions
         *      WP : add_option() // Add WordPress option.
         *      WP : get_option() // Get WordPress option.
         *      WP : update_option() // Set WordPress option.
         *
         *      framework : hooks->set() // Set a hook.
         *
         * @hooks
         *      db_collation (filter): database collation
         *      db_config (filter): database columns default values
         *      db_tables (filter): database tables
         *
         * @layouts
         *      -
         *
         * @return
         *      Add or update database tables.
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
        function add(){
            global $DOT;
            global $wpdb;

            /*
             * Initialize database tables and configuration.
             */
            $this->db_collation = $DOT->hooks->set('db_collation',
                                                   'filter',
                                                   $wpdb->collate);
            $this->db_config = $DOT->hooks->set('db_config',
                                                'filter',
                                                new stdClass);
            $this->db_tables = $DOT->hooks->set('db_tables',
                                                'filter',
                                                new stdClass);

            /*
             * Get current database version.
             */
            $version_database = get_option(DOT_ID.'_version_database');
            DOT_DATABASE_UPDATE
                    ? $version_database = 0.1
                    : null;

            /*
             * Add database.
             */
            if ($version_database != DOT_DATABASE_VERSION){
                require_once(str_replace('\\',
                                         '/',
                                         ABSPATH).'wp-admin/includes/upgrade.php');

                foreach ($this->db_tables as $key => $table){
                    /*
                     * Get current table version.
                     */
                    $version_table = get_option(DOT_ID.'_version__database_table_'.$key);
                    DOT_DATABASE_UPDATE
                            ? $version_table = 0.1
                            : null;

                    /*
                     * Add table.
                     */
                    if ($version_table != $table->version){
                        dbDelta($table->sql);

                        /*
                         * Update tables' versions.
                         */
                        $version_table == ''
                                ? add_option(DOT_ID.'_version__database_table_'.$key,
                                             $table->version)
                                : update_option(DOT_ID.'_version__database_table_'.$key,
                                                $table->version);
                    }
                }

                /*
                 * Update database version.
                 */
                $version_database == ''
                        ? add_option(DOT_ID.'_version_database',
                                     DOT_DATABASE_VERSION)
                        : update_option(DOT_ID.'_version_database',
                                        DOT_DATABASE_VERSION);
            }
        }

        /*
         * Set query results, usually after a query is executed.
         *
         * @usage
         *      In FILE search for function call: $this->set
         *      In FILE search for function call in hooks: array(&$this, 'set')
         *      In PROJECT search for function call: $DOT->db->set
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
         *      wpdb (object): WordPress database object
         *
         * @functions
         *      WP : wpdb->__get() // Makes private properties readable for backward compatibility.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      All public variables are set.
         *
         * @return_details
         *      Public variables type:
         *          error (string/boolean): wpdb->last_error
         *          insert_id (integer): wpdb->insert_id
         *          result (array): wpdb->last_result
         *          result_query (object): wpdb->result
         *          rows_affected (integer): wpdb->rows_affected
         *          rows_no (integer): wpdb->num_rows
         *          query (string): wpdb->last_query
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        public function set(){
            global $wpdb;

            $this->error = $wpdb->last_error;
            $this->insert_id = $wpdb->insert_id;
            $this->result = $wpdb->last_result;
            $this->result_query = $wpdb->__get('result');
            $this->rows_affected = $wpdb->rows_affected;
            $this->rows_no = $wpdb->num_rows;
            $this->query = $wpdb->last_query;
        }

        /*
         * Initialize tables names.
         *
         * @usage
         *      In FILE search for function call: $this->tables
         *      In FILE search for function call in hooks: array(&$this, 'tables')
         *      In PROJECT search for function call: $DOT->db->tables
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
         *      DOT_DATABASE_TABLES_PREFIX (string): tables names prefix from the database
         *      DOT_DATABASE_TABLES_WP_PREFIX (boolean): user WordPress tables names prefix from the database
         *
         * @globals
         *      wpdb (object): WordPress database object
         *
         *      DOT (object): DOT framework main class variable
         *      dot_database_tables (array): a list with all database tables
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
         *      Tables list.
         *
         * @return_details
         *      The public variable [DOT->tables] from framework/dot.php will be completed with all tables keys.
         *
         * @dv
         *      -
         *
         * @tests
         *      -
         */
        public function tables(){
            global $DOT;
            global $dot_database_tables;
            global $wpdb;

            foreach (array_keys($dot_database_tables) as $key){
                $DOT->tables->{$key} = (DOT_DATABASE_TABLES_WP_PREFIX
                                ? $wpdb->prefix
                                : '').DOT_DATABASE_TABLES_PREFIX.$key;
            }
        }

        /*
         * Query functions.
         */

        /*
         * Execute a MySQL database query.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->query
         *      In FILE search for function call in hooks: array(&$this, 'query')
         *      In PROJECT search for function call: $DOT->db->query
         *
         * @params
         *      query (string): the query to be executed
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
         *      wpdb (object): WordPress database object
         *
         * @functions
         *      WP : wpdb->query() // Execute a query.
         *
         *      this : set() // Set query results.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Query result.
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
         * @param string $query
         *
         * @return boolean|integer
         */
        public function query($query){
            global $wpdb;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $result = $wpdb->query($query);

            $this->set();

            return $result;
        }

        /*
         * Create query for safe execution.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->safe
         *      In FILE search for function call in hooks: array(&$this, 'safe')
         *      In PROJECT search for function call: $DOT->db->safe
         *
         * @params
         *      query (string): the query to be executed
         *      values (array): the list of values passed to the query
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
         *      wpdb (object): WordPress database object
         *
         * @functions
         *      WP : wpdb->prepare() // Delete rows from a table.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Safe query string.
         *
         * @return_details
         *      The query string is escaped to prevent injections, remove double quotes, single quotes and add the appropriate values type (%d, %F, %s).
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
         * @param string $query
         * @param array $values
         *
         * @return string
         */
        public function safe($query,
                             $values){
            global $wpdb;

            return $wpdb->prepare($query,
                                  $values);
        }

        /*
         * Delete one or more rows in a database table.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->delete
         *      In FILE search for function call in hooks: array(&$this, 'delete')
         *      In PROJECT search for function call: $DOT->db->delete
         *
         * @params
         *      table (string): table name
         *      where (array): conditions
         *      formats_where (array): conditions values format
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
         *      wpdb (object): WordPress database object
         *
         * @functions
         *      WP : wpdb->delete() // Delete rows from a table.
         *
         *      this : set() // Set query results.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      The number of rows deleted.
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
         * @param string $table
         * @param array $where
         * @param array|null $formats_where
         *
         * @return integer
         */
        public function delete($table,
                               $where,
                               $formats_where = null){
            global $wpdb;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $result = $wpdb->delete($table,
                                    $where,
                                    $formats_where);

            $this->set();

            return $result;
        }

        /*
         * Insert a row into a database table.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->insert
         *      In FILE search for function call in hooks: array(&$this, 'insert')
         *      In PROJECT search for function call: $DOT->db->insert
         *
         * @params
         *      table (string): table name
         *      values (array): values to be added to the database
         *      formats (array): values format
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
         *      wpdb (object): WordPress database object
         *
         * @functions
         *      WP : wpdb->insert() // Insert a row into a table.
         *
         *      this : set() // Set query results.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      New row ID.
         *
         * @return_details
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
         * @param string $table
         * @param array $values
         * @param array|null $formats
         *
         * @return integer
         */
        public function insert($table,
                               $values,
                               $formats = null){
            global $wpdb;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->insert($table,
                          $values,
                          $formats);

            $this->set();

            return $this->insert_id;
        }

        /*
         * Replace row fields in a database table.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->replace
         *      In FILE search for function call in hooks: array(&$this, 'replace')
         *      In PROJECT search for function call: $DOT->db->replace
         *
         * @params
         *      table (string): table name
         *      values (array): values to be added to the database
         *      formats (array): values format
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
         *      wpdb (object): WordPress database object
         *
         * @functions
         *      WP : wpdb->replace() // Replace a row in a table.
         *
         *      this : set() // Set query results.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Replaced row ID.
         *
         * @return_details
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
         * @param string $table
         * @param array $values
         * @param array|null $formats
         *
         * @return integer
         */
        public function replace($table,
                                $values,
                                $formats = null){
            global $wpdb;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $wpdb->replace($table,
                           $values,
                           $formats);

            $this->set();

            return $this->insert_id;
        }

        /*
         * Update row fields in a database table.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->update
         *      In FILE search for function call in hooks: array(&$this, 'update')
         *      In PROJECT search for function call: $DOT->db->update
         *
         * @params
         *      table (string): table name
         *      values (array): values to be updated to the database
         *      where (array): conditions
         *      formats (array): values format
         *      formats_where (array): conditions values format
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
         *      wpdb (object): WordPress database object
         *
         * @functions
         *      WP : wpdb->update() // Update a row in a table.
         *
         *      this : set() // Set query results.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      The number of rows updated.
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
         * @param string $table
         * @param array $values
         * @param array $where
         * @param array|null $formats
         * @param array|null $formats_where
         *
         * @return integer
         */
        public function update($table,
                               $values,
                               $where,
                               $formats = null,
                               $formats_where = null){
            global $wpdb;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $result = $wpdb->update($table,
                                    $values,
                                    $where,
                                    $formats,
                                    $formats_where);

            $this->set();

            return $result;
        }

        /*
         * Get query results.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->results
         *      In FILE search for function call in hooks: array(&$this, 'results')
         *      In PROJECT search for function call: $DOT->db->results
         *
         * @params
         *      query (string): the query to be executed
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
         *      wpdb (object): WordPress database object
         *
         * @functions
         *      WP : wpdb->get_results() // Get generic results.
         *
         *      this : set() // Set query results.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Query results array.
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
         * @param string $query
         *
         * @return array|boolean
         */
        public function results($query){
            global $wpdb;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $result = $wpdb->get_results($query);

            $this->set();

            return $result !== null
                    ? $result
                    : false;
        }

        /*
         * Get one row from a database table.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->row
         *      In FILE search for function call in hooks: array(&$this, 'row')
         *      In PROJECT search for function call: $DOT->db->row
         *
         * @params
         *        query (string): the query to be executed
         *        row (integer): row number
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
         *      wpdb (object): WordPress database object
         *
         * @functions
         *      WP : wpdb->get_row() // Get row.
         *
         *      this : set() // Set query results.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      Query results selected row or "false" if it does not exist.
         *
         * @return_details
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
         * @param string $query
         * @param integer $row
         *
         * @return array|boolean|object
         */
        public function row($query,
                            $row = 0){
            global $wpdb;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $result = $wpdb->get_row($query,
                                     OBJECT,
                                     $row);

            $this->set();

            return $result !== null
                    ? $result
                    : false;
        }

        /*
         * Get the value of one column from one row from a database table.
         *
         * @usage
         *      Reserved framework function that will be called by DOT application.
         *
         *      In FILE search for function call: $this->val
         *      In FILE search for function call in hooks: array(&$this, 'val')
         *      In PROJECT search for function call: $DOT->db->val
         *
         * @params
         *      query (string): the query to be executed
         *      column (integer): column number
         *      row (integer): row number
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
         *      wpdb (object): WordPress database object
         *
         * @functions
         *      WP : wpdb->get_var() // Get a variable.
         *
         *      this : set() // Set query results.
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      The column value.
         *
         * @return_details
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
         * @param null|string $query
         * @param integer $column
         * @param integer $row
         *
         * @return boolean|string
         */
        public function val($query = null,
                            $column = 0,
                            $row = 0){
            global $wpdb;

            //phpcs:ignore WordPress.DB.DirectDatabaseQuery
            $result = $wpdb->get_var($query,
                                     $column,
                                     $row);

            $this->set();

            return $result !== null
                    ? $result
                    : false;
        }
    }
}