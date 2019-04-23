<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_best_horse extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model("Horse_model");
	}

	/**
	 * |- Get Best Ever Horse and its stats and time to complete the race
	 */
	public function index() {

		$raceData["bestHorseData"] = array();
		$bestHorseData = $this->Horse_model->getBestHorse();
		if(!is_null($bestHorseData))
			$raceData["bestHorseData"] = $bestHorseData;

		echo json_encode($raceData);
	}
}
