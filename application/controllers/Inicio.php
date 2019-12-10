<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index()
	{
		$this->load->view('public/header');
		$this->load->view('public/inicio');
		$this->load->view('public/footer');
	}
}
