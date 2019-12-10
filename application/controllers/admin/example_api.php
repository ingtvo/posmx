<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//suse chriskacerguis\RestServer\RestController;
require(APPPATH'.libraries/REST_Controller.php');
 
class Example_api extends RestController {
 
}

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
		$this->load->view('admin/header');
		$this->load->view('admin/demo/dashboard');

		$this->load->view('admin/footerTop');
		$this->load->view('admin/js/jsDashboard');
		$this->load->view('admin/footerBottom');
	}//fin del index


	public function listaUsuarios(){

		$this->load->model('Modulo/ModUsuarios');

		$lista = $this->ModUsuarios->listaUsuarios();

		var_dump($lista);
	}


	public function Seguridad(){
		$this->load->library('Sistema/libSeguridad');
		$dato['user'] = 'esimio';
		$dato['password'] = '1111';

		$encripcion = $this->libseguridad->dataEncriptados($dato);
		echo 'dato:  |  encriptado: '.$encripcion;
		echo '<br>';
		$desencripcion = $this->libseguridad->desEcnciptaDatos($encripcion);
		echo 'dato:   |  Des-encriptado: '.$desencripcion;

	}

}//fin del controlador