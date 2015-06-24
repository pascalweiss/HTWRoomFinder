<?php

class Room_finder extends Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
       $buildings = $this->_model->sortBuildingsByCampus($this->_model->getBuildingsAndCampus());
       $this->_view->render('head');
       $this->_view->render('search_menu', $buildings);
       $this->_view->render('result_skeleton');
       $this->_view->render('jscripts');
   }

    public function availableRooms($building, $date, $time) {
        $data = $this->_model->getAvailableRooms($building,$date,$time);
        $this->_view->render('search_result', $data);
    }
}