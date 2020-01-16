<?php
/**
* @copyright POS-MX-ESIME
* @package CodeIgniter
* @subpackage IPN
* @category SERVER REST
*/
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class RestUsuarios extends REST_Controller{


    function __construct() {
        parent::__construct();
        
        //$this->config->load("settings");
        //$this->load->library('Sistema/libSeguridad');
    }

    /**
     * @author Gustavo Pérez Cruz
     * @param datos por obtenidos por post
     * @uses Consulta si existe el usuario al logiarse o registrarse
     * @return array
     */
    public function validarAcceso_post()
    {
        //obteniendo datos del formulario
        $correo = $this->input->input_stream('correo');
        $contrasena = $this->input->input_stream('contrasena');
        $origen = $this->input->input_stream('origen');

        //definiendo el arreglo de respuesta
        $data = [
            'success'=> false,
            'response'=> ''
        ];

        //Realizando una consulta al modelo de datos para encontrar el usuario
        $this->load->model('MdlAcceso');
        $usuario = $this->MdlAcceso->buscarUsuario($correo,$contrasena);

        //Decidiendo el tipo de respuesta segun el origen de la petición
        if (!is_null($usuario))
        {            
            switch ($origen)
            {
               case 'login':
                   if(password_verify($contrasena, $usuario['contrasena']) && $usuario['correo'] == $correo){
                        $data['success'] = true;
                        $data['response'] = 'Se encontro el siguiente usuario.2';
                        $data['usuario'] = $usuario;
                        $this->set_response($data, REST_Controller::HTTP_OK);  
                    }else{
                        $data['success']=false;
                        $data['response']='La contraseña es incorrecta.';
                        $this->set_response($data, REST_Controller::HTTP_NOT_FOUND);  
                    } 
                   break;
                case 'registro':
                    if($usuario['correo'] == $correo){
                        $data['success'] = false;
                        $data['response'] = 'Este usuario ya existe.';
                        $this->set_response($data, REST_Controller::HTTP_NOT_FOUND);   
                    }else{
                        $data['success'] = false;
                        $data['response'] = 'No se encontro ningun usuario.';
                        $this->set_response($data, REST_Controller::HTTP_NOT_FOUND);  
                    }
                    break;
                case 'recuperarContrasena':
                        if($usuario['correo'] == $correo){
                        $data['success'] = true;
                        $data['response'] = 'Revisa tu correo, para renovar tu contraseña';
                        $data['usuario'] = $usuario;
                        $this->set_response($data, REST_Controller::HTTP_NOT_FOUND);   
                    }else{
                        $data['success'] = false;
                        $data['response'] = 'El usuario no existe.';
                        $this->set_response($data, REST_Controller::HTTP_NOT_FOUND);  
                    }
                    break;                        
               default:
                    $data['success'] = false;
                    $data['response'] = 'El usuario no existe.';
                    $this->set_response($data, REST_Controller::HTTP_NOT_FOUND); 
                   break;
           }           
        }            
        else
        {
            $data['success']=false;
            $data['response']='El usuario no existe.';
            $this->set_response($data, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    /**
     * @author Gustavo Pérez Cruz
     * @param datos por obtenidos por post
     * @uses Registra un usuario con los datos obtenidos
     * @return array
     */
    public function registrarUsuario_post()
    {    
        $datos['correo_electronico'] = $this->input->input_stream('correo');
        $datos['password'] = $this->input->input_stream('contrasena');
        $datos['nombres'] = $this->input->input_stream('nombres');
        $datos['apellidoPaterno'] = $this->input->input_stream('apellidoPaterno');
        $datos['apellidoMaterno'] = $this->input->input_stream('apellidoMaterno');

        
        $data = [
            'success'=> false,
            'response'=> ''
        ];

        $this->load->model('MdlAcceso');
        $usuario = $this->MdlAcceso->registrarUsuario($datos);

        if (!is_null($usuario))
        {
            $data['success']=true;
            $data['response']='Se registo exitosamente.';
            ;
            $data['usuario'] = $usuario;
            $this->set_response($data, REST_Controller::HTTP_OK);
        }            
        else
        {
            $data['success']=false;
            $data['response']='No se pudo realizar el registro.';
            $this->set_response($data, REST_Controller::HTTP_NOT_FOUND);
        }
    }


    /**
     * @author Gustavo Pérez Cruz
     * @param datos por obtenidos por post
     * @uses Registra un usuario con los datos obtenidos
     * @return array
     */
    public function cambiarContrasena_post()
    {    
        $contrasena = $this->input->input_stream('contrasena');
        $idUsuario = $this->input->input_stream('idUsuario');

        
        $data = [
            'success'=> false,
            'response'=> ''
        ];

        $this->load->model('MdlAcceso');
        $cambioOk = $this->MdlAcceso->cambiarContrasena($idUsuario, $contrasena);

        if ($cambioOk)
        {
            $data['success']=true;
            $data['response']='Se Cambio exitosamente.';            
            $this->set_response($data, REST_Controller::HTTP_OK);
        }            
        else
        {
            $data['success']=false;
            $data['response']='No se pudo realizar el cambio.';
            $this->set_response($data, REST_Controller::HTTP_NOT_FOUND);
        }
    }


    /**
     * @author Gustavo Pérez Cruz
     * @param datos por obtenidos por post
     * @uses 
     * @return array
     */
    public function generarToken_post()
    {    
        $correo = $this->input->input_stream('correo');
        $token = $this->input->input_stream('token');
        
        $data = [
            'success'=> false,
            'response'=> ''
        ];

        $this->load->model('MdlAcceso');
        $tokenId = $this->MdlAcceso->generarToken($correo, $token);

        if ($tokenId)
        {
            $data['success']=true;
            $data['response']='Se generó token exitosamente.';
            $data['token'] = $tokenId;        
            $this->set_response($data, REST_Controller::HTTP_OK);
        }            
        else
        {
            $data['success']=false;
            $data['response']='No se pudo crear el token.';
            $this->set_response($data, REST_Controller::HTTP_NOT_FOUND);
        }
    }

        /**
     * @author Gustavo Pérez Cruz
     * @param datos por obtenidos por post
     * @uses 
     * @return array
     */
    public function leerToken_post()
    {    
        $idUsuario = $this->input->input_stream('idUsuario');      
        
        $data = [
            'success'=> false,
            'response'=> ''
        ];

        $this->load->model('MdlAcceso');
        $tokenId = $this->MdlAcceso->leerToken($idUsuario);

        if ($tokenId)
        {
            $data['success'] = true;
            $data['response']='Se obtubo el token correctamente.';   
            $data['data'] = $tokenId;
            $this->set_response($data, REST_Controller::HTTP_OK);
        }            
        else
        {
            $data['success']=false;
            $data['response']='No se pudo obtener el token.';
            $this->set_response($data, REST_Controller::HTTP_NOT_FOUND);
        }
    }


}//fin de ApiRest