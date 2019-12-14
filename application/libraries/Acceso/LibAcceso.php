<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class LibAcceso{

	function __construct(){
        $this->ci =& get_instance();

        //Credenciales de accesos para la api
        $this->ci->load->library('rest', 
            array(
                'api_key' => 'REST API',
                'api_name' => 'X-API-KEY',
                'http_user'       => 'esimio_cli',
                'http_pass'       => '4rdu1n0',
                'http_auth'       => 'basic'
                //'ssl_verify_peer' =>$this->ci->config->item('ssl'),
                //'ssl_cainfo' =>$this->ci->config->item('cert')
            )
        );
    }

    /**
     * @author Gustavo Pérez Cruz
     * @param arreglo $data con los campos a verificar
     * @uses valida si existe el usuario en la bd
     * @return json con datos del usuario
     */

    public function validarUsuario($data)
    {
        $this->ci->rest->initialize(array('server' => base_url().'acceso/Api/'));
        $data = $this->ci->rest->post('buscarUsuario',$data,'json');
        $this->ci->rest->debug();
        return $data;
    }


    /**
     * @author Gustavo Pérez Cruz
     * @param arreglo $data con los campos a verificar
     * @uses Registra al usuario
     * @return json con datos del usuario
     */

    public function regiustrarUsuario($data)
    {
        $this->ci->rest->initialize(array('server' => base_url().'acceso/Api/'));
        $data = $this->ci->rest->post('registrarUsuario',$data,'json');
        $this->ci->rest->debug();
        return $data;
    }

}//fin de LibAcceso
