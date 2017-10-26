<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journals extends CI_Controller {

	public function index()
	{
		$data = [];
		$this->load->view('templates/header', $data);
        $this->load->view('pages/journals.php', $data);
        $this->load->view('templates/footer', $data);
	}
}
