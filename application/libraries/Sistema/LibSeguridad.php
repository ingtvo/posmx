<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* @copyright
* @since
* @version 
*/

class LibSeguridad {
	private $clavePrivada;
	private $clavePublica;
	/**
    * @author Gustavo Pérez 
    * @todo Constructor de clase
    * @uses CI_Controller::__construct() para inicializar los métodos y atributos de la clase padre.
    */
	public function __construct()
	{
		$this->ci =& get_instance();
		$this->clavePrivada=$this->ci->config->item('clavePrivada');
		$this->clavePublica=$this->ci->config->item('clavePublica');

		$this->ci->load->library('encryption');
	}

	/**
    * @author Gustavo Pérez
    * @uses Encripta los datos de sesion de un usuario
    * @return array
    */
	public function datosSesion()
	{
		$datos=[];
		if(!empty($this->ci->session->logueado) && $this->ci->session->logueado == true)
		{
			$datos['idUduario']            =$this->ci->session->userdata('idUsuario');
			$datos['nombre']            =$this->ci->session->userdata('nombre');
			$datos['correoElectronico'] =$this->ci->session->userdata('correoElectronico');
			$datos['logueado'] 		    =$this->ci->session->userdata('logueado');	
		}

		$strSesion=json_encode($datos);
		$this->ci->encryption->initialize(
		array(
				'cipher' => 'aes-128',
				'mode' => 'ctr',
				'key' => $this->clavePublica
			)
		);
		
		$datosSesion=$this->ci->encryption->encrypt($strSesion);
		return $datosSesion;
    }


    /**
    * @author Gustavo Pérez
    * @uses Encripta los datos que recibe
    * @param [datos] arreglo de datos a cifrar
    * @return array
    */
	public function dataEncriptaDatos($info)
	{
		$data = json_encode($info);
		
		$this->ci->encryption->initialize(
		array(
				'cipher' => 'aes-128',
				'mode' => 'ctr',
				'key' => $this->clavePublica
			)
		);
		
		$result = $this->ci->encryption->encrypt($data);
		return $result;
    }


    /**
    * @author Gustavo Pérez
    * @uses Desencripta datos
    * @param [clave] cadena con datos encriptados
    */
	public function desEcnciptaDatos($datos)
	{	
		$this->ci->encryption->initialize(
		array(
				'cipher' => 'aes-128',
				'mode' => 'ctr',
				'key' => $this->clavePublica
			)
		);	
		$result=$this->ci->encryption->decrypt($datos);
		if($result){
			return $result;	
		}else{
			return false;
		}
	}//fin de desEncriptaDatos

	/**
    * @author Gustavo Pérez
    * @uses genera un token para usuario de migracion o invitado
    * @return string
    */
    public function generarToken($correoElectronico)
    {
    	$data['correo'] = $correoElectronico;
    	$data['token']=md5($correoElectronico.date("Y-m-d H:i:s"));
    	//$data['token']=$this->ci->encryption->encrypt($correoElectronico.date("Y-m-d H:i:s"));
        //$data['token'] = $this->dataEncriptaDatos($correoElectronico.date("Y-m-d H:i:s"));
        //asignar token a usuario
        $this->ci->rest->initialize(array('server' => base_url().'acceso/rest/RestUsuarios/'));
        $data = $this->ci->rest->post('generarToken',$data,'json');

        return $data;
    }

    /**
    * @author Gustavo Pérez
    * @uses Lectura del token que corresponde a un usuario
    * @param [idUsuario] id del usuario
    * @return array
    */
    public function leerToken($idUsuario)
    {
    	$data['idUsuario'] = $idUsuario;


        $this->ci->rest->initialize(array('server' => base_url().'acceso/rest/RestUsuarios/'));
        $data = $this->ci->rest->post('leerToken',$data,'json');

        //$this->ci->rest->debug();
        if(((!empty($data->success)) && $data->success == true)){
        
            return $data;
        }else{
        	return null;
        }
    }

}//fin de la biblioteca