<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Latest_articles extends CI_Controller {

	public function index()
	{
		$data = [];
		$this->load->view('templates/header', $data);
        $this->load->view('pages/Latest_articles.php', $data);
        $this->load->view('templates/footer', $data);
	}
}
