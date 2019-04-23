<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_race_history extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model("Race_history_model");
	}

	/**
	 * |- Get past 5 races with the top three position
	 */
	public function index() {

		$raceData["pastRaceData"] = array();
		$pastRaceData = $this->Race_history_model->getPastRaces();
		if(!is_null($pastRaceData))
			$raceData["pastRaceData"] = $pastRaceData;

		echo json_encode($raceData);
	}
}
