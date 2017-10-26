<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_us extends CI_Controller {
	public function __construct() { 
		parent::__construct(); 
  	}
	public function index()
	{
		$data = [];
		$this->load->view('templates/header', $data);
        $this->load->view('pages/about_us.php', $data);
        $this->load->view('templates/footer', $data);
	}
}
