<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller{


    function __construct() {
        parent::__construct();
        
        //$this->config->load("settings");
        //$this->load->library('Sistema/libSeguridad');
    }



    public function buscarUsuario_post()
    {
        $correo = $this->input->input_stream('correo');
        $contrasena = $this->input->input_stream('contrasena');

        $data = [
            'success'=> false,
            'response'=> ''
        ];

        $this->load->model('MdlAcceso');
        $usuario = $this->MdlAcceso->buscarUsuario($correo,$contrasena);

        if (!is_null($usuario))
        {
            $data['success']=true;
            $data['response']='Se encontro el siguiente usuario';
            $data['usuario'] = $usuario;
            $this->set_response($data, REST_Controller::HTTP_OK);
        }            
        else
        {
            $data['success']=false;
            $data['response']='El usuario no existe.';
            $this->set_response($data, REST_Controller::HTTP_NOT_FOUND);
        }
    }


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
            $data['response']='Se encontro el siguiente usuario';
            $data['usuario'] = $usuario;
            $this->set_response($data, REST_Controller::HTTP_OK);
        }            
        else
        {
            $data['success']=false;
            $data['response']='El usuario no existe.';
            $this->set_response($data, REST_Controller::HTTP_NOT_FOUND);
        }
    }


}//fin de ApiRest