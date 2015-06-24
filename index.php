<?php
ob_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// include config data
require('config.php');

function autoloadsystem($class) {
   $filename = DOCROOT . "/core/" . strtolower($class) . ".php";
   if (file_exists($filename)) {
      require $filename;
   }

   $filename = DOCROOT . "/helpers/" . strtolower($class) . ".php";
   if (file_exists($filename)) {
      require $filename;
   }
}
spl_autoload_register("autoloadsystem");
set_exception_handler('logger::exception_handler');
set_error_handler('logger::error_handler');

$app = new Bootstrap();
$app->setController('room_finder');
$app->init();

ob_flush();
