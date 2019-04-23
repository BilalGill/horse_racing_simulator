<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horse_racing extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model("Race_model");
		$this->load->model("Horse_model");
		$this->load->model("Race_history_model");
	}

	/**
	 * |- load webpage to simulate the application
	 */
	public function index() {

		$this->load->view('horse_racing_view');
	}
}
