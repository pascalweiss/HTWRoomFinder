<?php

class Bootstrap {

   private $_url;
   private $_controller = NULL;
   private $_defaultController;

    public function __construct() {
        //start the session class
        Session::init();
    }

   public function setController($name) {
      $this->_defaultController = $name;
   }

   public function init() {
      //sets the protected url

      $this->_getUrl();

      //if no page requested set default controller
      if(empty($this->_url[0])) {
         $this->_loadDefaultController();
         return false;
      }

      $this->_loadExistingController();
      $this->_callControllerMethod();

   }

   protected function _getUrl() {
      $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : NULL;
      $url = urldecode(filter_var(urlencode($url), FILTER_SANITIZE_URL));
      $this->_url = explode('/', $url);
   }

   protected function _loadDefaultController() {
      require 'controllers/' . $this->_defaultController . '.php';
      $this->_controller = new $this->_defaultController();
      $this->_controller->loadModel($this->_defaultController);
      $this->_controller->index();
   }

   protected function _loadExistingController() {

      //set url for controllers
      $file = 'controllers/' . $this->_url[0] . '.php';

      if(file_exists($file)) {
         require $file;

         //instatiate controller
         $this->_controller = new $this->_url[0];

         //load model if exists
         $this->_controller->loadModel($this->_url[0]);

      } else {
         $this->_error("File does not exist: " . $this->_url[0]);
         return false;
      }

   }

   /**
     * If a method is passed in the GET url paremter
     *
     *  http://localhost/controller/method/(param)/(param)/(param)
     *  url[0] = Controller
     *  url[1] = Method
     *  url[2] = Param
     *  url[3] = Param
     *  url[4] = Param
     */
    protected function _callControllerMethod()
    {
        unset($this->_url[0]);
        $method = 'index';

        if (is_callable(array($this->_controller, $this->_url[1]))) {
            $method = array_shift($this->_url);
        }

        call_user_func_array(array($this->_controller, $method), $this->_url);
    }

    /**
     * Display an error page if nothing exists
     *
     * @return boolean
     */
    protected function _error($error) {
        require 'core/error.php';
        $this->_controller = new Error($error);
        $this->_controller->index();
        die;
    }

}
