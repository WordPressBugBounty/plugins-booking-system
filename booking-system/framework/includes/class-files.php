<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-files.php
 * Author                  : Dot on Paper
 * Copyright               : © 2016 Dot on Paper
 * Website                 : https://dotonpaper.net
 * Description             : Files PHP class.
 */

if (!class_exists('DOTFiles')){
    class DOTFiles{
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
         * Scan for files.
         *
         * @usage
         *      In FILE search for function call: $this->scan
         *      In FILE search for function call in hooks: array(&$this, 'scan')
         *      In PROJECT search for function call: $DOT->classes->files->scan
         *
         * @params
         *      path (string): absolute path
         *      dir (string): directory path
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
         *      this : scan() // The function is recursive
         *
         * @hooks
         *      -
         *
         * @layouts
         *      -
         *
         * @return
         *      All files found in a folder.
         *
         * @return_details
         *      The absolute path to all files in a folder.
         *      Some system files are excluded, like ".", ".." for UNIX and ".DS_Store" for MAC.
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
         * @param string $dir
         *
         * @return array
         */
        public function scan($path,
                             $dir = ''){
            $files = array();

            /*
             * Get files list from a folder, except the ones excluded.
             */
            $folder = $path.$dir;
            $list = is_dir($folder)
                    ? array_diff(scandir($folder),
                                 array('.',
                                       '..',
                                       '.DS_Store'))
                    : array();

            foreach ($list as $file){
                if (is_dir($path.$dir.$file)){
                    /*
                     * If a folder is found, it is scanned.
                     */
                    $files = array_merge($files,
                                         $this->scan($path,
                                                     $dir.$file.'/'));
                }
                else{
                    $files[] = $dir.$file;
                }
            }

            return $files;
        }
    }
}