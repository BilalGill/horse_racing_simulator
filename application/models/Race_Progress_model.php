<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Race_Progress_model extends CI_Model {

    public function insertRaceProgressData($raceId, $horseId){

        $raceData[CN_RACE_ID] = $raceId;
        $raceData[CN_HORSE_ID] = $horseId;
        $raceData[CN_DISTANCE_COVERED] = 0;
        $raceData[CN_TIME_DURATION] = 0;

        $this->db->insert(TBL_RACE_PROGRESS, $raceData);
        return $raceId;
    }

    public function updateHorseRaceProgressData($raceId, $horseId, $distance_covered, $time_duration){

        $this->db->set(CN_DISTANCE_COVERED,$distance_covered);
        $this->db->set(CN_TIME_DURATION,$time_duration);
        $this->db->where(CN_RACE_ID,$raceId);
        $this->db->where(CN_HORSE_ID,$horseId);
        $this->db->update(TBL_RACE_PROGRESS);
    }

    /**
     * |- Calculate process of the horses by the formula specified in the document
     */
    public function calculateProgress($horseData){

        $distanceCovered = $horseData[CN_DISTANCE_COVERED];
        $progressTime = PROGRESS_TIME_PER_CLICK;

        //Calculate time to reach it endurance limit for which horse can run by maximum speed
        $enduranceLimit = $horseData[CN_ENDURANCE] * ENDURANCE_MULTIPLIER;
        $distanceWithMaxSpeed = $horseData[CN_DISTANCE_COVERED] + $horseData[CN_SPEED]*$progressTime;
        if($distanceWithMaxSpeed <= $enduranceLimit){
            $horseData[CN_DISTANCE_COVERED] = $distanceWithMaxSpeed;
            $horseData[CN_TIME_DURATION] += $progressTime;
        }
        else{

            //Calculate time to reach it endurance limit for which horse can run by maximum speed
            $timeToAchieveEnduranceLimit = 0;
            if($distanceCovered < $enduranceLimit){
                $timeToAchieveEnduranceLimit = ($enduranceLimit - $distanceCovered) / $horseData[CN_SPEED];
                $maxSpeedDistanceUpdated = $distanceCovered + $horseData[CN_SPEED]*$timeToAchieveEnduranceLimit;
                $horseData[CN_DISTANCE_COVERED] = $maxSpeedDistanceUpdated;
                $horseData[CN_TIME_DURATION] += $timeToAchieveEnduranceLimit;
            }

            //If endurance limit reached then calculate the speed reduction due to endurance effect
            $enduranceEffect = ($horseData[CN_STRENGTH]*STRENGTH_FACTOR)/STRENGTH_PERCENTAGE_FACTOR;
            $enduranceEffect = SPEED_REDUCTION_AFTER_ENDURANCE_REACHED - $enduranceEffect;
            $progressDistanceCalculated = $horseData[CN_SPEED] - $enduranceEffect;

            //calculate the time required to reach finish line
            $timeToReachFinish = (TOTAL_DISTANCE - $distanceCovered) / $progressDistanceCalculated;
            if($timeToReachFinish >= PROGRESS_TIME_PER_CLICK)
                $timeToReachFinish = PROGRESS_TIME_PER_CLICK;

            $progressTime = $timeToReachFinish-$timeToAchieveEnduranceLimit;

            $progressDistanceWithEndurance = $progressDistanceCalculated*($progressTime);
            $horseData[CN_DISTANCE_COVERED] += $progressDistanceWithEndurance;
            $horseData[CN_TIME_DURATION] += $progressTime;
        }

        return $horseData;
    }
}