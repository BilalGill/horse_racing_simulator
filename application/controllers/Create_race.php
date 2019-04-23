<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create_race extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model("Race_model");
		$this->load->model("Horse_model");
		$this->load->model("Race_history_model");
		$this->load->model("Race_Progress_model");
	}

	/**
	 * |- Check whether maximum limit reached for creating new race
	 * |- Insert Race data in tbl_races
	 * |- Generate new Horses with random stats and save horses data to tbl_horses
	 * |- Insert Data into the tbl_race_progress
	 */
	public function index() {

		$raceCount = $this->Race_model->getCurrentRacesCount();
		if($raceCount == 3){
			$response[RESPONSE_MESSAGE] = 'Max limit reached. Could not create new race !!!';
			echo json_encode($response);
			return;
		}

		$raceId = $this->Race_model->insertRace();

		for($i=0;$i<NUMBER_OF_HORSES_IN_RACE;$i++) {

			$horseId = $this->Horse_model->insertHorse();
			$this->Race_Progress_model->insertRaceProgressData($raceId, $horseId);
		}

		$response[RESPONSE_MESSAGE] = 'Race Created Successfully !!!';
		echo json_encode($response);
		return;
	}
}
