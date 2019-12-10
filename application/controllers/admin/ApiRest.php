<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class ApiRest extends REST_Controller{


    function __construct() {
        parent::__construct();
        
        //$this->config->load("settings");
        //$this->load->library('Sistema/libSeguridad');
    }



    public function listaUsuarios_get()
    {

        $data = [
            'success'=> true,
            'message'=> '',
            'response'=> ''
        ];


        $this->load->model('Modulo/ModUsuarios');
        $listaUsuarios = $this->ModUsuarios->listaUsuarios();

        if (!is_null($listaUsuarios))
        {
            $data['success']=true;
            $data['message']='Se encontraron los siguientes usuarios';
            $data['listaUsuarios'] = $listaUsuarios;
            $this->set_response($data, REST_Controller::HTTP_OK);

        }            
        else
        {
            $data['success']=false;
            $data['message']='No se encuentra el curso deseado.';
            $this->set_response($data, REST_Controller::HTTP_NOT_FOUND);
        }


    }


}//fin de ApiRest