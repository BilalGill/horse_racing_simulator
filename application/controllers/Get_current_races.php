<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_current_races extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model("Race_model");
	}

	/**
	 * |- Get Current Races data, data includes horses "Horse Position", "Time Duration", "Distance Covered"
	 * |- Sorts data with respect to distance covered is time
	 */
	public function index() {

		$raceData["raceData"] = array();

		$currentRacesList = $this->Race_model->getCurrentRaces();
		if(!is_null($currentRacesList)){

			foreach($currentRacesList as $key=>$raceItem){
				usort($raceItem, "compareDistanceAndTime");
				$currentRacesList[$key] = $raceItem;
			}

			$raceData["raceData"] = $currentRacesList;
		}

		echo json_encode($raceData);
	}
}
