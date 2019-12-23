<?php
/**
* @copyright POS-MX-ESIME
* @package  CodeIgniter
* @subpackage  IPN
* @category module controller
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Acceso extends MX_Controller {

    function __construct() {    	

        parent::__construct();
		$this->load->helper("formularios");
		$this->load->library("session");
	}

    /**
    * @author Gustavo Pérez Cruz
    * @uses Despliega vista de login para el usuario
    * @return view
    */

	public function index()
	{
		if((empty(!$this->session->userdata('logueado'))) == FALSE || $this->session->userdata('logueado') == NULL){
            $data = array(
					'dataPage', array('title' => 'Ingresar',
									'description' => 'Ingresar al Dashboard de administración'),
					'logitems' => logitems(),
					);
			$this->load->view('login', $data);			
        }else{
        	redirect(base_url('Admin/Dashboard'));
        }
		
	}//fin del index

	/**
    * @author Gustavo Pérez Cruz
    * @uses Loguea al usuario si existe y si no tiene sesion de usuario
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
				//obteniendo los datos  que se reciben por post e imprimiendolos
				$usuario['correo'] = $this->input->post('correo');
				$usuario['contrasena'] = $this->input->post('contrasena');
				$usuario['origen'] = 'login';
				
				$this->load->library('Acceso/LibAcceso');
				$acceso = $this->libacceso->validarAcceso($usuario);

				if(!empty($acceso->success) &&  $acceso->success == true){	
					//Estableciendo datos de sesion de usuario
					$usuario_data = array(
				                    'userId' => $acceso->usuario->id_usuario,
				                    'correoElectronico' => $acceso->usuario->correo,
				                    'nombre' => $acceso->usuario->nombres,                  
				                    'logueado'=>$acceso->success
	                				);
	                $this->session->set_userdata($usuario_data);
					redirect('admin/Dashboard');					
				}else{
					//captando el error para establecerlo en una variable de sesión
					$msg = $acceso->response;
					$this->session->set_flashdata('errorContrasena', $msg);
					redirect('acceso');
				}					
			}
		}else{
			//redireccionando al login
			redirect(base_url("acceso"));
		}
	}//fin de validandoAcceso

	/**
    * @author Gustavo Pérez Cruz
    * @uses Cierra la sesión eliminando las variables de sesión de usuario
    * @return view
    */
	public function closeLogin(){
		$usuario_data = array(
				                    'userId',
				                    'correoElectronico',
				                    'nombre',               
				                    'logueado'
	                				);
		$this->session->unset_userdata($usuario_data);
		if($this->session->userdata('logueado') == FALSE)
			{
				redirect(base_url());
			}
	}


    /**
    * @author Gustavo Pérez Cruz
    * @uses Despliega vista de registro para el usuario
    * @return view
    */

	public function registro()
	{
		//comprobando si existe sesión para mostrar la vista
		if((empty(!$this->session->userdata('logueado'))) == FALSE || $this->session->userdata('logueado') == NULL){
			$this->load->helper("formularios");
			//Definiendo el error si existe en una variable de sesión
			$msg = (!empty($this->session->flashdata('errorContrasena')))?$this->session->flashdata('errorContrasena'):null;
			$data = array(
						'dataPage', array('title' => 'Ingresar',
						'description' => 'Ingresar al Dashboard de administración'),
						'regitems'=>regitems(),
						'error' => $msg
						);
			$this->load->view('registro', $data);
		}else{
			redirect(base_url('Admin/Dashboard'));
		}
	}//fin de registro

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
				$this->load->library('Acceso/LibAcceso');
				//obteniendo los datosq ue se reciben por post e imprimiendolos
				$usuario['nombres'] = $this->input->post('nombres');
				$usuario['apellidoPaterno'] = $this->input->post('apellidoPaterno');
				$usuario['apellidoMaterno'] = $this->input->post('apellidoMaterno');
				$usuario['correo'] = $this->input->post('correo');
				$usuario['contrasena'] =$this->input->post('contrasena');
				$usuario['contrasena2'] =$this->input->post('contrasena2');
				$usuario['origen'] = 'registro';

				//buscando si ya existe el usuario
				$acceso = $this->libacceso->validarAcceso($usuario);

				//confirmado que las contraseñas sean identicas
				if($usuario['contrasena'] == $usuario['contrasena2']){
					$usuario['contrasena'] = password_hash($this->input->post('contrasena'), PASSWORD_DEFAULT);		
					
					$acceso = $this->libacceso->registrarUsuario($usuario);
					//redireccionando al Dashboard			
					redirect(base_url('admin/Dashboard/'));

				}else{
					//usando flash data para marcar el error en un salto de pagina
					$msg = 'Las contraseñas no coinciden, vuelve a intentar';
					$this->session->set_flashdata('errorContrasena', $msg);					
					redirect(base_url('acceso/registro/'));
				}
			}

		}else{
			//redireccionando al login
			redirect(base_url("acceso/registro"));
		}
    }//fin de registrarUsuario



}//fin del login