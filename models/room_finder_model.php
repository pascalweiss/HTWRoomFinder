<?php

class Room_finder_model extends Model {

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
            if ($building['campus'] == "Treskowallee") {
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

    public function getAvailableRooms($building, $date, $time) {
//        $infected = $building . ';drop table events;';
        $building = filter_var($building,FILTER_SANITIZE_STRING);
        $date = filter_var($date,FILTER_SANITIZE_STRING);
        $time = filter_var($time,FILTER_SANITIZE_STRING);
        $query = $this->freeRoomQuery($building, $date, $time . ':00');
        $result = $this->_db->select($query);
        return $this->excludeDuplicates($result);
    }

    private function excludeDuplicates($data) {
        $result = array();
        foreach ($data as $event) {
            $key = $event['room'];
            $date = strtotime($event['begin']);
            if (!$result[$key] || $date < $result[$key]) {
                $result[$key] = $date;
            }
        }
        return $result;
    }

    private function freeRoomQuery($building, $date, $time) {
        return "WITH x AS (
                SELECT tmp.room
                    FROM (
                        (SELECT e1.room
                            FROM events e1
                            WHERE e1.building = '$building'
                            GROUP BY e1.room
                        )
                        EXCEPT
                        (SELECT e2.room
                            FROM events e2
                            WHERE e2.building = '$building'
                            AND e2.begin < '$date $time'
                            AND '$date $time' < e2.finish
                        )
                    ) as tmp
                ORDER BY tmp.room
                ), y AS (
                    Select tmp.room, tmp.begin from (
                        (SELECT e1.room, e1.begin, e1.finish, e1.building
                            FROM events e1
                            WHERE e1.building = '$building'
                            AND date(e1.begin) = '$date'
                            AND pg_catalog.time(e1.begin) >= '$time')
                        EXCEPT
                        (SELECT e2.room, e2.begin, e2.finish, e2.building
                            FROM events e2
                            WHERE e2.building = '$building'
                            AND  e2.begin < '$date $time'
                            AND '$date $time' < e2.finish)
                        ) as tmp
                        ORDER by tmp.room
                )
                SELECT x.room, y.begin FROM x LEFT OUTER JOIN y ON (x.room=y.room);";
    }
}