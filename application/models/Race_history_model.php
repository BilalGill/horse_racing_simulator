<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Race_history_model extends CI_Model {

    public function insertRaceHistory($raceId, $raceData){

        $race_history_data = array();
        for($i=0; $i<3;$i++){
            $horse_pos = $i+1;
            $race_history_data[CN_RACE_ID] = $raceId;
            $race_history_data[CN_HORSE_ID] = $raceData[$i][CN_HORSE_ID];
            $race_history_data[CN_HORSE_POS] = $horse_pos;
            $race_history_data[CN_COMPLETION_TIME] = $raceData[$i][CN_TIME_DURATION];
            $race_history_data[CN_CREATED] = date('Y-m-d G:i:s');

            $this->db->insert(TBL_RACE_HISTORY, $race_history_data);
        }
    }

    public function getPastRaces(){

        $pastRacesData = array();

        $queryString = "SELECT R1.race_id,R1.horse_id,R1.horse_pos,R1.completion_time
                    FROM `tbl_race_history` R1
                    JOIN(
                    SELECT *
                    FROM(
                    SELECT race_id,MAX(created) max_created
                    FROM `tbl_race_history`
                    GROUP BY race_id
                    )R1
                    ORDER BY max_created DESC
                    LIMIT 5
                    )R2
                    ON R1.race_id = R2.race_id
                    ORDER BY max_created DESC, completion_time ASC";

        $query = $this->db->query($queryString);

        $result = $query->result_array();
        foreach($result as $row_data){
            $pastRacesData[$row_data[CN_RACE_ID]][] = $row_data;
        }

        return $pastRacesData;
    }

}