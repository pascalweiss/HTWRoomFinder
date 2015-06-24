<?php

class URL {

   public static function redirect($url = null, $status) {
      header('Location: ' . DIR . $url, true, $status);
      exit;
   }

   public static function halt($status = 404, $message = 'Something went wrong.') {
      if (ob_get_level() !== 0) {
          ob_clean();
      }

      http_response_code($status);
      $data['status'] = $status;
      $data['message'] = $message;

      if (!file_exists("views/error/$status.php")) {
         $status = 'default';
      }
      require "views/error/$status.php";

      exit;
   }

    public static function STYLES($filename = false, $path = 'static/css/') {
        if ($filename) {
            $path .= "$filename.css";
        }

//        $result = DIR . $path;
        return $path;
    }

    public static function JSCRIPTS($filename = false, $path = 'static/js/') {
        if ($filename) {
            $path .= "$filename.js";
        }
//        $result = DIR . $path;
        return $path;
    }
}