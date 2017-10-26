<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Submit_manuscript extends CI_Controller {

	public function index()
	{
		$data = [];
		$this->load->view('templates/header', $data);
        $this->load->view('pages/submit_manuscript.php', $data);
        $this->load->view('templates/footer', $data);
	}
}
