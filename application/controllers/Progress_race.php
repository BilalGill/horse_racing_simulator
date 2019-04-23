<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Progress_race extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model("Race_model");
		$this->load->model("Horse_model");
		$this->load->model("Race_history_model");
		$this->load->model("Race_Progress_model");
	}

	/**
	 * |- Get Currently Active Races
	 * |- Calculate Progress of horses by 10 seconds or time to reach 1500m distance
	 * |- Update horses progress data in the tbl_race_progress
	 * |- Sorts data with respect to distance covered is time
	 * |- If All horses finished the race then mark status of race completed and add top three positions to tbl_race_history
	 */
	public function index() {

		$currentRaces = $this->Race_model->getCurrentRaceHorsesData();

		if(!empty($currentRaces)) {
			foreach ($currentRaces as $raceId => $horsesList) {
				if (!empty($horsesList)) {

					$horsesFinished = 0;
					foreach ($horsesList as $key => $value) {

						$distanceCovered = $value[CN_DISTANCE_COVERED];

						if ($distanceCovered >= TOTAL_DISTANCE) {
							$horsesFinished++;
							continue;
						}

						$progressedData = $this->Race_Progress_model->calculateProgress($value);

						if($progressedData == TOTAL_DISTANCE)
							$horsesFinished++;

						$horsesList[$key] = $progressedData;
						$this->Race_Progress_model->updateHorseRaceProgressData($raceId, $progressedData[CN_HORSE_ID], $progressedData[CN_DISTANCE_COVERED], $progressedData[CN_TIME_DURATION]);
					}

					usort($horsesList, "compareDistanceAndTime");
					$currentRaces[$raceId] = $horsesList;

					if($horsesFinished == count($horsesList)){

						$this->Race_model->updateRaceFinishedStatus($raceId);
						$this->Race_history_model->insertRaceHistory($raceId, $horsesList);
					}
				}
			}
		}

		$response["raceData"] = $currentRaces;
		echo json_encode($response);
	}
}
