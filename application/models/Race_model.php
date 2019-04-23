<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Race_model extends CI_Model {

    public function insertRace(){

        do{
            $raceId = getUniqueKey(PREFIX_RACE);
        } while (($this->Race_model->getRaceById($raceId)));

        $raceData[CN_RACE_ID] = $raceId;
        $raceData[CN_RACE_FINISHED] = 0;
        $raceData[CN_CREATED] = date('Y-m-d G:i:s');
        $raceData[CN_UPDATED] = date('Y-m-d G:i:s');

        $this->db->insert(TBL_RACE, $raceData);
        return $raceId;
    }

    public function updateRaceFinishedStatus($raceId){

        $this->db->set(CN_UPDATED,date('Y-m-d G:i:s'));
        $this->db->set(CN_RACE_FINISHED,1);
        $this->db->where(CN_RACE_ID,$raceId);
        $this->db->update(TBL_RACE);
    }

    public function getCurrentRaces(){
        $this->db->select('`tbl_races`.`race_id`,`tbl_race_progress`.`distance_covered`, `tbl_race_progress`.`horse_id`, `tbl_race_progress`.`time_duration`');
        $this->db->from('tbl_race_progress');
        $this->db->join('tbl_races', 'tbl_races.race_id = tbl_race_progress.race_id','left');
        $this->db->where('tbl_races.race_finished', 0);
        $query = $this->db->get();
        $result = $query->result_array();
        $race_result = array();

        //Creating Dictionary with respect to Race
        if(!empty($result)){
            foreach($result as $row_item){
                $raceID = $row_item[CN_RACE_ID];

                unset($row_item[CN_RACE_ID]);
                $race_result[$raceID][] = $row_item;
            }
        }
        return $race_result;
    }

    public function getCurrentRaceHorsesData(){

        $this->db->select('`tbl_races`.`race_id`,`tbl_race_progress`.`distance_covered`, `tbl_race_progress`.`horse_id`, `tbl_race_progress`.`time_duration`, tbl_horses.`speed`,tbl_horses.`strength`,tbl_horses.`endurance`');
        $this->db->from('tbl_race_progress');
        $this->db->join('tbl_races', 'tbl_race_progress.race_id=tbl_races.race_id','left');
        $this->db->join('tbl_horses','tbl_race_progress.horse_id=tbl_horses.horse_id','left');
        $this->db->where('tbl_races.race_finished', 0);
        $query = $this->db->get();
        $result = $query->result_array();
        $race_result = array();

        //Creating Dictionary with respect to Race
        if(!empty($result)){
            foreach($result as $row_item){
                $raceID = $row_item[CN_RACE_ID];

                unset($row_item[CN_RACE_ID]);
                $race_result[$raceID][] = $row_item;
            }
        }
        return $race_result;
    }

    public function getCurrentRacesCount(){

        $this->db->select('count(*) as race_count');
        $this->db->from(TBL_RACE);
        $this->db->where(CN_RACE_FINISHED, 0);
        $query = $this->db->get();
        $result = $query->result_array();

        return intval($result[0]["race_count"]);
    }

    public function getRaceById($raceId){

        $query = $this->db->get_where(TBL_RACE, array(CN_RACE_ID => $raceId));
        $result = $query->result_array();

        if(count($result) == 0)
            return null;
        else
            return $result[0];
    }

}