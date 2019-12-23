<?php
/**
* @copyright POS-MX-ESIME
* @package  CodeIgniter
* @subpackage  IPN
* @category controller
*/
defined('BASEPATH') OR exit('No direct script access allowed');
    /**
    * @author Gustavo Pérez Cruz
    * @uses Despliega la vista de Inicio principal al publico
    * @return view
    */
class Inicio extends CI_Controller {

	public function index()
	{
		$this->load->view('public/header');
		$this->load->view('public/inicio');
		$this->load->view('public/footer');
	}
}
