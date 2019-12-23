<?php
/**
* @copyright POS-MX-ESIME
* @package CodeIgniter
* @subpackage IPN
* @category library
*/
defined('BASEPATH') OR exit('No direct script access allowed');

Class LibAcceso{

	function __construct(){
        $this->ci =& get_instance();

        //Credenciales de accesos para los servicios REST
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
     * @param arreglo $data con los campos necesarios para buscar un usuario en cuestion y validar sus datos
     * @uses valida si existe el usuario en la bd
     * @return json con datos del usuario
     */
    public function validarAcceso($data)
    {
        $this->ci->rest->initialize(array('server' => base_url().'acceso/rest/RestUsuarios/'));       
        $tmp = $this->ci->rest->post('validarAcceso',$data,'json'); 
        return $tmp;
    }


    /**
     * @author Gustavo Pérez Cruz
     * @param arreglo $data con los campos a registrar
     * @uses Registra al usuario
     * @return json con datos del usuario
     */

    public function registrarUsuario($data)
    {
        //inicializa la peticion al servidor REST para usar un metodo
        $this->ci->rest->initialize(array('server' => base_url().'acceso/rest/RestUsuarios/'));
        //consulta el servicio registrarUsuario() con los parametros solicitados
        $datos = $this->ci->rest->post('registrarUsuario',$data,'json');
        return $datos;
    }


    /**
     * @author Gustavo Pérez Cruz
     * @uses verifica si existe sesión, si no lo redirige al home
     * @return view
     */
    public function validarSesion(){
        if((empty(!$this->ci->session->userdata('logueado'))) == FALSE || $this->ci->session->userdata('logueado') == NULL){
            redirect(base_url());
        }
    }

}//fin de LibAcceso
