<?php
/**
* @copyright POS-MX-ESIME
* @package  CodeIgniter
* @subpackage  ipn
* @category module
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Acceso extends MX_Controller {

    function __construct() {
        parent::__construct();

		$this->load->helper("formularios");

	}

    /**
    * @author Gustavo Pérez Cruz
    * @uses Despliega vista de login para el usuario
    */

	public function index()
	{
		$data = array(
					'dataPage', array('title' => 'Ingresar',
									'description' => 'Ingresar al Dashboard de administración'),
					'logitems' => logitems(),
					);
		$this->load->view('login', $data);		
	}//fin del index
/*
	public function _loginfields(){
		return array(
			'correo' => array(
				'type' => 'email',				
				'id' => 'correo',
				'name' => 'correo',
				'value' => 'Correo Electrónico',
				'class' => 'form-control',
				'placeholder' => 'Correo Electrónico',
				'required' => 'required',
				'autofocus' => 'autofocus'
			),
 			'contrasena' => array( 				
				'type' => 'password',
 				'id' => 'contrasena',
 				'name' => 'contrasena',
 				'class' => 'form-control',
 				'placeholder' => 'contraseña',
 			),
 			'ingresar' => array( 				
				'type' => 'submit',
				'value' => 'Ingresar',
 				'class' => 'btn btn-primary btn-block',
 			),
		);
	}
*/


    /**
    * @author Gustavo Pérez Cruz
    * @uses Despliega vista de login para el usuario
    */

	public function registro()
	{
		$this->load->helper("formularios");

		$data = array(
					'dataPage', array('title' => 'Ingresar',
					'description' => 'Ingresar al Dashboard de administración'),
					'regitems'=>regitems()
					);
		$this->load->view('registro', $data);		
	}//fin del index



	/**
    * @author Gustavo Pérez Cruz
    * @uses Loguea al usuario
    * @return view
    */
	public function login(){

		//validando que existan datos recibidos por post
		if(!$this->input->post("submit")){
			//agregando el helper para validar los campos delformulario
			$this->load->helper("security");

			$this->form_validation->set_rules("correo", "Correo", "required|trim|valid_email|xss_clean");
			$this->form_validation->set_rules("contrasena", "Contraseña", "required|trim|min_length[6]|max_length[50]|xss_clean");

			$this->form_validation->set_message("required", "El campo %s es requerido");
			$this->form_validation->set_message("valid_emal", "El campo %s no es un correo válido");
			$this->form_validation->set_message("min_length", "El campo %s debe contener almenos 6 caracteres");
			$this->form_validation->set_message("max_length", "El campo %s no sobrepasar de 50 caracteres");

			if(! $this->form_validation->run()){
				//refrescando
				$this->index();
			}else{
				//obteniendo los datosq ue se reciben por post e imprimiendolos
				$usuario['correo'] = $this->input->post('correo');
				$usuario['contrasena'] = $this->input->post('contrasena');
				
				$this->load->library('Acceso/LibAcceso');

				$acceso = $this->libacceso->validarUsuario($usuario);
				

			}
		}else{
			//redireccionando al login
			redirect(base_url("acceso"));
		}
	}//fin de validandoAcceso


	/**
    * @author Gustavo Pérez Cruz
    * @uses Registra al usuario
    * @return view
    */

    public function registrarUsuario(){
    	//validando que existan datos recibidos por post
		if(!$this->input->post("submit")){
			//agregando el helper para validar los campos delformulario
			$this->load->helper("security");

			$this->form_validation->set_rules("nombres", "Nombres", "required|trim|min_length[6]|max_length[50]|xss_clean");
			$this->form_validation->set_rules("apellidoPaterno", "Apellido Paterno", "required|trim|min_length[6]|max_length[50]|xss_clean");
			$this->form_validation->set_rules("apellidoMaterno", "Apellido Materno", "required|trim|min_length[6]|max_length[50]|xss_clean");
			$this->form_validation->set_rules("correo", "Correo", "required|trim|valid_email|xss_clean");
			$this->form_validation->set_rules("contrasena", "Contraseña", "required|trim|min_length[6]|max_length[50]|xss_clean");

			$this->form_validation->set_message("required", "El campo %s es requerido");
			$this->form_validation->set_message("valid_emal", "El campo %s no es un correo válido");
			$this->form_validation->set_message("min_length", "El campo %s debe contener almenos 6 caracteres");
			$this->form_validation->set_message("max_length", "El campo %s no sobrepasar de 50 caracteres");

			if(! $this->form_validation->run()){
				//refrescando
				redirect(base_url("acceso/registro"));
			}else{
				//obteniendo los datosq ue se reciben por post e imprimiendolos
				$usuario['nombres'] = $this->input->post('nombres');
				$usuario['apellidoPaterno'] = $this->input->post('apellidoPaterno');
				$usuario['apellidoMaterno'] = $this->input->post('apellidoMaterno');
				$usuario['correo'] = $this->input->post('correo');
				$usuario['contrasena'] = $this->input->post('contrasena');
				
				$this->load->library('Acceso/LibAcceso');
				$acceso = $this->libacceso->regiustrarUsuario($usuario);
			}

		}else{
			//redireccionando al login
			redirect(base_url("acceso/registro"));
		}
    }



}//fin del login