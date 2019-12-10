<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class LibDemo{

	function __construct(){
        $this->ci =& get_instance();

        //configuraciones
       // $this->ci->load->library('Sistema/libSeguridad');
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


    public function listaUsuarios()
    {
/*
        $permiso = [
            'idCurso'=>$idCurso,
            'cifrado'=>[
                'datos'=>$this->ci->libseguridad->datosSesion(),
                'sistema'=>$this->ci->config->item("MFE","mfe_settings"),
                'usuario'=>'usr_mfe'
            ]
        ];
*/
        $this->ci->rest->initialize(array('server' => base_url().'admin/ApiRest/'));
        $data = $this->ci->rest->get('listaUsuarios','json');
        $this->ci->rest->debug();
        return $data;


    }


/*
	private	$username;
	private $password;

	public function __get($var)
	{
		return get_instance()->$var;
	}

	public function __construct($userdata)
	{
		$this->load->library("encryption");
		$this->username = $userdata["username"];
		$this->password = $userdata["password"];
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function getEncryptedPassword()
	{
		return $this->encryption->encrypt($this->password);
	}

	public function getDecryptedPassword()
	{
		return $this->encryption->decrypt($this->getEncryptedPassword());
	}
*/
}//fin de LibDemo