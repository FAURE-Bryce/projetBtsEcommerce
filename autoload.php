<?php

    /**
     * Charge les class
     */

    function my_autoloader($class_name) {
       $directories = array(
           'model',
           'classe',
           'controller'
       );
       foreach ($directories as $directory) {
           $file = __DIR__ . '/' . $directory . '/' . $class_name . '.php';
           if (file_exists($file)) {
               require_once $file;
               return;
           }
       }
    }

    spl_autoload_register('my_autoloader');

    session_start();
?>