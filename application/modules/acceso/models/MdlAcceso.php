<?php
/**
* @copyright POS-MX-ESIME
* @package  CodeIgniter
* @subpackage  IPN
* @category model
*/

//Se evita que alguien ejecute directamente el script
if(!defined('BASEPATH')) exit('No se permite el acceso directo al script');
/**
* @copyright
* @package CodeIgniter
* @category Model
* @uses 
*/

class MdlAcceso extends CI_Model{
    /**
    * @author Gustavo Pérez Cruz
    * @uses CI_Controller::__construct() para inicializar los métodos y atributos de la clase padre.
    */
	function __construct() {
		parent::__construct();
    }

    /**
    * @author Gustavo Pérez Cruz
    * @uses Busca al usuario por correo
    * @param Recibe correo y contraseña para buscar al usuario
    * @return array de los campos de la consulta
    */
    public function buscarUsuario($correo, $contrasena){

        $lectura = $this->load->database('default', TRUE);
        $lectura->select('id_usuario,correo_electronico,password, nombres');
        $lectura->from('usuario');
        $lectura->where('correo_electronico',$correo);
        $query = $lectura->get();
        $lectura->close();

        $arreglo = [];
        if(!empty($query->result()))
        {
            $row = $query->row();
            $tmp=[
                'id_usuario'=>$row->id_usuario,
                'correo'=>$row->correo_electronico,
                'contrasena'=>$row->password,
                'nombres'=>$row->nombres
            ];           

            return $tmp;
        }
        else
            return null;
    }

    /**
    * @author Gustavo Pérez Cruz
    * @uses Registra al usuario
    * @param array con los datos del usuario a registrar
    * @return id del usuario registrado
    */
    public function registrarUsuario($datos){
        //Selecciona la base de datos a consultar <<default>>
        $lectura = $this->load->database('default', TRUE);
        if(!$lectura->insert('usuario',$datos)){
            $tmp = 0;
        }
        else{
            $tmp = $lectura->insert_id();
        }
        $lectura->close();
        return $tmp;
    }

    /**
    * @author Gustavo Pérez Cruz
    * @uses Registra al usuario
    * @param array con los datos del usuario a registrar
    * @return id del usuario registrado
    */
    public function listaUsuarios()
    {
        $lectura = $this->load->database('default', TRUE);
        $lectura->select('*');
        $lectura->from('usuario');
        $lectura->order_by('id_usuario', 'ASC');
        $query = $lectura->get();
        $lectura->close();

        $arreglo = [];
        if(!empty($query->result()))
        {
            foreach ($query->result() as $row)
            {
                $tmp[$row->id_usuario]['idusuario']=$row->id_usuario;
                $tmp[$row->id_usuario]['correo']=$row->correo_electronico;
                $tmp[$row->id_usuario]['password']=$row->password;
                $tmp[$row->id_usuario]['nombres']=$row->nombre;
            }

            return $tmp;
        }
        else
            return [];
    }

}//fin del modelo