<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data = [];
		$this->load->view('templates/header', $data);
        $this->load->view('pages/home.php', $data);
        $this->load->view('templates/footer', $data);
	}
	public function get_home_page_journals() {		
		$this->load->model('App_model');

		//sanitize post value
		if($this->input->post("page")) {
			$page_number = $this->input->post("page");
		if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
		} else{
			$page_number = 1;
		}

		//get current starting point of records
		$position = (($page_number-1) * 5);

		$data['latest_articles'] = $this->App_model->get_home_page_journals($position);

		echo $this->load->view('pages/ajax_home_page_journals', $data,TRUE);	
	}
}
