<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();

		//cargando archivo de configuraciones
		$this->config->load("settings");
		$settings_config = $this->config->item("settings");
	}

	public function index()
	{
		$this->load->view('admin/login');
	}

	public function registro()
	{
		$this->load->view('admin/registro');
	}

	public function recordar_contrasena()
	{
		$this->load->view('admin/recordar_contrasena');
	}
}
