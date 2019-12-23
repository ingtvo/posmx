<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller {

    function __construct() {
        parent::__construct();

		//cargando archivo de configuraciones
		$this->config->load("settings");
		$settings_config = $this->config->item("settings");

		//print_r($settings_config);
 
		//echo $this->config->item("environment","settings");
	}

	public function index()
	{
		$this->load->library('Sistema/LibSeguridad');
		$encriptado = $this->libseguridad->dataEncriptaDatos('2006301487');
		echo 'encriptado: '.$encriptado.'<br><hr>';
		$desencriptado = $this->libseguridad->desEcnciptaDatos('7963b824ff8ee6cc941be638a1e581ef4da2a55adb4e67e62f769f4ad64172ec71ef379739e2f23536ee96d09bdd58c6aaba0dfc7bc4b2fbfbfeb730c181562bCvSROJVdKAHSzoyQ4sv+wI/0szd3Vr4I');
		echo 'desencriptado: '.$desencriptado.'<br>';

/*
		$this->output->enable_profiler(TRUE);
		$this->load->view('admin/header');
		$this->load->view('admin/demo/dashboard');

		$this->load->view('admin/footerTop');
		$this->load->view('admin/js/jsDashboard');
		$this->load->view('admin/footerBottom');
		*/
	}

	public function blank()
	{
		//probando agregar unla biblioteca de codeigniter
		$this->load->library("user_agent");
		$data['navegador']= $this->agent->is_browser("Chrome");

		//agregando una biblioteca propia
		$this->load->library("demo/libDemo", array(
			'username' => 'esimio',
			'password' => 'arduino'
		));


		$data["username"] = $this->libdemo->getUsername();
		$data["encrytpKey"] = $this->libdemo->getEncryptedPassword();
		$data["password"] = $this->libdemo->getDecryptedPassword();

		$this->load->view('admin/header');
		$this->load->view('admin/demo/blank',$data);

		$this->load->view('admin/footerTop');
		$this->load->view('admin/js/jsBlank');
		$this->load->view('admin/footerBottom');
	}

	public function error404()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/demo/error404');

		$this->load->view('admin/footerTop');
		$this->load->view('admin/js/jsError404');
		$this->load->view('admin/footerBottom');
	}

	public function chart()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/demo/chart');

		$this->load->view('admin/footerTop');
		$this->load->view('admin/js/jsChart');
		$this->load->view('admin/footerBottom');
	}

	public function forgotPassword()
	{
		$this->load->view('admin/demo/forgotPassword');
	}

	public function login()
	{
		$this->load->view('admin/demo/login');
	}

	public function register()
	{
		$this->load->view('admin/demo/register');
	}

	public function tables()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/demo/tables');

		$this->load->view('admin/footerTop');
		$this->load->view('admin/js/jsTables');
		$this->load->view('admin/footerBottom');
	}
}
