<?php

class Room_finder_model2 extends Model {

   public function __construct(){
      parent::__construct();
   }

   /**
   * Gibt die letzten 20 Einträge im Archiv zurück.
   * @return array Liste aus Produkten mit id, timestamp, name, url, image und price
   */

    public function sortBuildingsByCampus($data) {
        $treskow = array();
        $wilhelm = array();
        foreach ($data as $building) {
            if ($data['campus'] == "Treskowallee") {
                array_push($treskow, $building['building']);
            }
            if ($building['campus'] == "Wilhelminenhof") {
                array_push($wilhelm, $building['building']);
            }
        }
        return array('tresk' => $treskow, 'wilh' => $wilhelm);
    }

   public function getBuildingsAndCampus() {
       return $this->_db->select("SELECT building, campus FROM events GROUP BY building, campus ORDER BY building");
   }

    public function getAvailableRooms($building, $time) {
        return $this->_db->select(
            "(SELECT e1.room, e1.begin, e1.finish, e1.building
            FROM events e1
            WHERE e1.building = 'Gebäude C'
            AND date(e1.begin) = '2015-06-03'
            AND pg_catalog.time(e1.begin) >= '12:05:00')
            EXCEPT
            (SELECT e2.room, e2.begin, e2.finish, e2.building
            FROM events e2
            WHERE e2.building = 'Gebäude C'
            AND  e2.begin < '2015-06-03 12:05:00'
            AND '2015-06-03 12:05:00' < e2.finish)");
    }
}