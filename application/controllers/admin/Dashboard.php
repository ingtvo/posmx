<?php
/**
* @copyright POS-MX-ESIME
* @package  CodeIgniter
* @subpackage  IPN
* @category controller
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    /**
    * @author Gustavo Pérez Cruz
    * @uses Despliega la vista del Dashboard
    * @return view
    */
	public function index()
	{

		//cargando archivo de configuraciones
		$this->config->load("settings");
		$settings_config = $this->config->item("settings");

		$this->load->library('Acceso/LibAcceso');
		$this->libacceso->validarSesion();

		$this->load->view('admin/header');
		$this->load->view('admin/demo/dashboard');	
		
		$this->load->view('admin/footerTop');
		$this->load->view('admin/js/jsDashboard');
		$this->load->view('admin/footerBottom');
	}
}
