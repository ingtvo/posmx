<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* @copyright
* @since
* @version 
*/

class LibMail {
	/**
    * @author Gustavo Pérez 
    * @todo Constructor de clase
    * @uses CI_Controller::__construct() para inicializar los métodos y atributos de la clase padre.
    */
	public function __construct()
	{
		$this->ci =& get_instance();		
		$this->ci->load->library('email');
		//$this->ci->load->library('encryption');
	}

	public function enviarMail($mailDestino, $asunto, $mensaje){
		$config['mailtype']='html';
		$this->ci->email->initialize($config);

        $this->ci->email->from('ingtvo@ingtvo.net','POSMX');
        $this->ci->email->to($usuario_data['correoElectronico']);
        //$this->email->cc('otrocorreo@correo.com');
        $this->ci->email->subject($asunto);//PruebaT mejora para ti !!
        $this->ci->email->message($mensaje);
        $envioExito=$this->ci->email->send();

        if($envioExito){
            return true;
        }else{
            return false;
        }
	}

}//fin de la biblioteca