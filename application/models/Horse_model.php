<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Horse_model extends CI_Model {

    public function updateHorseData($horseData){

        $horseData[CN_UPDATED] = date('Y-m-d G:i:s');
        $this->db->where(CN_HORSE_ID, $horseData[CN_HORSE_ID]);
        $this->db->update(TBL_HORSES, $horseData);
    }

    public function getHorseById($horseId){

        $query = $this->db->get_where(TBL_HORSES, array(CN_HORSE_ID => $horseId));
        $result = $query->result_array();

        if(count($result) == 0)
            return null;
        else
            return $result[0];
    }

    public function getBestHorse(){

        $this->db->select('tbl_horses.`speed`,tbl_horses.`strength`,tbl_horses.`endurance`, `tbl_race_progress`.`time_duration`');
        $this->db->from('tbl_race_progress');
        $this->db->join('tbl_horses', 'tbl_horses.`horse_id` = tbl_race_progress.`horse_id`','left');
        $this->db->where('tbl_race_progress.`distance_covered`', TOTAL_DISTANCE);
        $this->db->limit(1);
        $this->db->order_by(CN_TIME_DURATION, 'asc');
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    public function insertHorse(){

        do{
            $horseId = getUniqueKey(PREFIX_HORSE);
        } while (($this->getHorseById($horseId)));

        $horseData[CN_HORSE_ID] = $horseId;
        $horseData[CN_STRENGTH] = generateRandomStat();
        $horseData[CN_SPEED] = BASE_SPEED + generateRandomStat();
        $horseData[CN_ENDURANCE] = generateRandomStat();
        $raceData[CN_CREATED] = date('Y-m-d G:i:s');
        $raceData[CN_UPDATED] = date('Y-m-d G:i:s');

        $this->db->insert(TBL_HORSES, $horseData);

        return $horseId;
    }
}