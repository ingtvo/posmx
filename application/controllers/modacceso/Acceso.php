<?php
/**
* @copyright POS-MX-ESIME
* @package  CodeIgniter
* @subpackage  IPN
* @category module controller
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Acceso extends CI_Controller {

    function __construct() {    	

        parent::__construct();
		$this->load->helper("acceso/formularios");
		$this->load->library("session");
		$this->load->library('Acceso/LibAcceso');
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
			$this->load->view('acceso/login', $data);			
        }else{
        	redirect(base_url('admin/Dashboard'));
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
				
				$acceso = $this->libacceso->validarAcceso($usuario);
		//$this->rest->debug();
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
					var_dump($msg);
					$this->session->set_flashdata('errorContrasena', $msg);
					redirect('/modacceso/Acceso');
				}					
			}
		}else{
			//redireccionando al login
			redirect(base_url("/modacceso/Acceso"));
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
			$this->load->helper("acceso/formularios");
			//Definiendo el error si existe en una variable de sesión
			$msg = (!empty($this->session->flashdata('errorContrasena')))?$this->session->flashdata('errorContrasena'):null;
			$data = array(
						'dataPage', array('title' => 'Ingresar',
						'description' => 'Registro del usuario en la plataforma'),
						'regitems'=>regitems(),
						'error' => $msg
						);
			$this->load->view('acceso/registro', $data);
		}else{
			redirect(base_url('admin/Dashboard'));
		}
	}//fin de registro

	/**
    * @author Gustavo Pérez Cruz
    * @uses Registra al usuario
    * @return view
    */
    public function registrarUsuario(){
    	//validando que existan datos recibidos por post
		if(!$this->input->post("submit") == true){
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
				$data = array(
						'dataPage', array('title' => 'Ingresar',
						'description' => 'Registro del usuario en la plataforma'),
						'regitems'=>regitems()	
						);
				$this->load->view('acceso/registro', $data);
			}else{
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


				if($acceso->success == true){
					//confirmado que las contraseñas sean identicas
					if($usuario['contrasena'] == $usuario['contrasena2']){
						$usuario['contrasena'] = password_hash($this->input->post('contrasena'), PASSWORD_DEFAULT);		
						
						$acceso = $this->libacceso->registrarUsuario($usuario);
						echo 'redireccionando al Dashboard';		
						redirect(base_url('admin/Dashboard/'));

					}else{
						//usando flash data para marcar el error en un salto de pagina
						$msg = 'Las contraseñas no coinciden, vuelve a intentar';
						$this->session->set_flashdata('errorUsuario', $msg);	
						echo $msg;				
						redirect(base_url('modacceso/Acceso/registro/'));
					}
				}else{
					//usando flash data para marcar el error en un salto de pagina					
					$this->session->set_flashdata('errorUsuario', $acceso->response);	
					redirect(base_url('modacceso/Acceso/registro/'));
				}
			}

		}else{
			//redireccionando al login
			redirect(base_url("modacceso/Acceso/registro"));
		}
    }//fin de registrarUsuario

	/**
    * @author Gustavo Pérez Cruz
    * @uses Recupera la contraseña del usuario y se la envia por correo
    * @return view
    */
    public function recuperarContrasena(){
    	//verificando si existe sesión para redirigir al usuario
    	if((empty(!$this->session->userdata('logueado'))) == FALSE || $this->session->userdata('logueado') == NULL){
            $data = array(
					'dataPage', array('title' => 'Recuperar Contraseña',
									'description' => 'Recupera la contraseña de usuario'),
					'recuperaritems' => logitems(),
					);

				//redireccionando a la vista para recuperar contraseña
				$this->load->view('acceso/recuperarContrasena', $data);
            
        }else{
        	//como hay sesion de usuario no necesita recupera contraseña y se regresa al dashboard
        	redirect(base_url('admin/Dashboard'));
        }
    }

    public	function enviarContrasena(){
    //validando que existan datos recibidos por post
			if(!$this->input->post("submit")){
				//agregando el helper para validar los campos delformulario
				$this->load->helper("security");

				$this->form_validation->set_rules("correo", "Correo", "required|trim|valid_email|xss_clean");

				$this->form_validation->set_message("required", "El campo %s es requerido");
				$this->form_validation->set_message("valid_emal", "El campo %s no es un correo válido");
				$this->form_validation->set_message("min_length", "El campo %s debe contener almenos 6 caracteres");
				$this->form_validation->set_message("max_length", "El campo %s no sobrepasar de 50 caracteres");

				if(! $this->form_validation->run()){
					//refrescando
					redirect(base_url('modacceso/Acceso/recuperarContrasena'));
				}else{
					//obteniendo los datos  que se reciben por post e imprimiendolos
					$usuario['correo'] = $this->input->post('correo');
					$usuario['origen'] = 'recuperarContrasena';
						
					
					$acceso = $this->libacceso->validarAcceso($usuario);
				//	var_dump($acceso);

					if(!empty($acceso->success) &&  $acceso->success == true){
						$this->load->library('Sistema/LibSeguridad');
						$token = $this->libseguridad->generarToken($usuario['correo']);
						//var_dump($token);

						//Estableciendo datos de sesion de usuario
						$usuario_data = array(
					                    'userId' => $acceso->usuario->id_usuario,
					                    'correoElectronico' => $acceso->usuario->correo,
					                    'nombre' => $acceso->usuario->nombres,                  
					                    'logueado'=>$acceso->success,
					                    'token' => $token
		                				);

						$logginLink = base_url().'modacceso/Acceso/nuevaContrasena/'.$acceso->usuario->id_usuario.'/'.$token->token;
/*
						$mensaje = '<table>
									  <caption>Cambia tu contraseña</caption>
									  <tr>
									    <td>John Lennon</td>
									    <td>Rhythm Guitar</td>
									  </tr>
									  <tr>
									    <td>'.$logginLink.'</td>
									    <td>Enlace</td>
									  </tr>
									  <tr>
									    <td>--</td>
									    <td>--</td>
									  </tr>
									  <tr>
									    <td>/td>
									    <td></td>
									  </tr>
									</table>';

						$this->load->library('Sistema/LibMail');
		    			$envioExito =$this->libmail->enviarMail($usuario_data['correoElectronico'], 'Cambiar contraseña', $mensaje);*/
$envioExito=true;
		                if($envioExito){
		                    $msg= "¡Mensaje enviado correctamente!";//"¡Mensaje enviado correctamente!";
		                }else{
		                    $msg= "Error en el envío: ";
		                }

		                $msg = $acceso->response;
						$this->session->set_flashdata('msjUsuario', $msg);
						redirect(base_url('modacceso/Acceso/recuperarContrasena'));				
					}else{
						$msg = $acceso->response;
						$this->session->set_flashdata('errorUsuario', $msg);
						redirect(base_url('modacceso/Acceso/recuperarContrasena'));
					}					
				}
			}else{
				//redireccionando a la vista para recuperar contraseña
				$this->load->view('acceso/recuperarContrasena', $data);
			}    	
    }

	//vista para cambiar contraseña
    public function nuevaContrasena($idUsuario=false, $token=false){
    	$tmpidUsuario = (!empty($this->session->userdata('userId')))?$this->session->userdata('userId'):$idUsuario;
    	$tmpToken = (!empty($this->session->userdata('token')))?$this->session->userdata('token'):$token;
  /*  	var_dump($tmpidUsuario);
    	echo '<br>';
    	var_dump($tmpToken);*/

    	if ((!empty($this->session->userdata('logueado'))) == TRUE && $this->session->userdata('userId') != NULL){
    		//hay sesion de usuario
    		$data = array(
						'dataPage', array('title' => 'Recuperar Contraseña',
										'description' => 'Recupera la contraseña de usuario'),
						'resetitems' => resetitems()
						);
					//redireccionando a la vista para recuperar contraseña
					$this->load->view('acceso/nuevaContrasena', $data);//=>cambiarContrasena
    	}elseif($tmpidUsuario!=false && $tmpToken!=false){//comprobar si existe el token

    		//El usuario tiene idUsuario y Token
    		$this->load->library('Sistema/LibSeguridad');
    		$tokenValido=$this->libseguridad->leerToken($tmpidUsuario);

    		if($tokenValido->success == true){

	    		if($tmpToken == $tokenValido->data->token){
	    			$this->session->set_flashdata('tokenIdUsuario', $tmpidUsuario);
	    			$data = array(
							'dataPage', array('title' => 'Nueva Contraseña',
											'description' => 'Cambia la contraseña de usuario'),
							'resetitems' => resetitems()
							); 			
	 				$this->load->view('acceso/nuevaContrasena', $data);

	    		}else{
	    			$msj= 'El token no es válido';
	    			$this->session->set_flashdata('errorUsuario',$msj);
	    			redirect(base_url('modacceso/Acceso/recuperarContrasena'));
	    		}
    		}else{
    			$msj= 'El token no es válido';
    			$this->session->set_userdata('errorUsuario',$msj);
    			redirect(base_url('modacceso/Acceso/recuperarContrasena'));
    		}

    	}else{
    		redirect(base_url('modacceso/Acceso/recuperarContrasena'));
    	}    	
    }//fin de nuevaContrasena()


//funcion que cambia la contraseña y redirecciona o manda mensaje
    public function cambiarContrasena(){    	
    	//var_dump($this->input->post("inputIdUsuario"));
			if(!empty($this->input->post("inputIdUsuario")) == true){
				//agregando el helper para validar los campos delformulario
				$this->load->helper("security");
				$this->form_validation->set_rules("inputIdUsuario", "id_Usuario", "required");
				$this->form_validation->set_rules("contrasena", "Contraseña", "required|trim|min_length[6]|max_length[50]|xss_clean");
				$this->form_validation->set_rules("contrasena2", "Contraseña", "required");

				$this->form_validation->set_message("required", "El campo %s es requerido");
				$this->form_validation->set_message("valid_emal", "El campo %s no es un correo válido");
				$this->form_validation->set_message("min_length", "El campo %s debe contener almenos 6 caracteres");
				$this->form_validation->set_message("max_length", "El campo %s no sobrepasar de 50 caracteres");

				if($this->form_validation->run() == false){
						$this->session->set_flashdata('idUsuario', $this->input->post("inputIdUsuario"));
						$data = array(
							'dataPage', array('title' => 'Nueva Contraseña',
											'description' => 'Cambia la contraseña de usuario'),
							'resetitems' => resetitems()
							); 			
	 					$this->load->view('acceso/nuevaContrasena', $data);
					//redirect(base_url('acceso/recuperarContrasena'));					
				}else{
					//obteniendo los datos  que se reciben por post e imprimiendolos
					$usuario['contrasena'] = $this->input->post('contrasena');
					$usuario['contrasena2'] = $this->input->post('contrasena2');
					$usuario['idUsuario'] = $this->input->post('inputIdUsuario');
					   

					if($usuario['contrasena'] == $usuario['contrasena2'])
					{
						$usuario['contrasena'] = password_hash($this->input->post('contrasena'), PASSWORD_DEFAULT);	
						
						$datos['idUsuario'] = $usuario['idUsuario'];
						$datos['contrasena'] = $usuario['contrasena'];
						$cambioOK = $this->libacceso->cambiarContrasena($datos);						
						$this->session->set_flashdata('msjUsuario', $cambioOK->response);
						$this->load->view('acceso/mensajes');
						
					}else{
						echo 'se regresa a recuperar contraseña con mensaje de que no son identicas';
						$msj='Las contraseñas no son identicas';
						$this->session->set_flashdata('errorUsuario', $msj);
						$this->session->set_flashdata('inputIdUsuario', $usuario['idUsuario']);
						$data = array(
							'dataPage', array('title' => 'Nueva Contraseña',
											'description' => 'Cambia la contraseña de usuario'),
							'resetitems' => resetitems()
							); 			
	 					$this->load->view('acceso/nuevaContrasena', $data);

						//redirect(base_url('acceso/nuevaContrasena'));
					}			
				}
			}else{
				$data = array(
						'dataPage', array('title' => 'Nueva Contraseña',
										'description' => 'Recupera la contraseña de usuario'),
						'resetitems' => resetitems()
						); 			
 				$this->load->view('nuevaContrasena', $data);
				//redireccionando a la vista para recuperar contraseña
				$msg='No se recibieron los campos';
				$this->session->set_flashdata('errorUsuario', $msg);
				redirect(base_url('modacceso/Acceso/nuevaContrasena'));
			}                        

    }//fin de cambiarContraseña


}//fin del login