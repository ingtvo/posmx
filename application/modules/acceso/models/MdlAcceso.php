<?php
//Se evita que alguien ejecute directamente el script
if(!defined('BASEPATH')) exit('No se permite el acceso directo al script');
/**
* @copyright
* @package CodeIgniter
* @category Model
* @uses Lectura de los datos para identificar a los cursos asi como
*       su contenido interno
*/

class MdlAcceso extends CI_Model{
    /**
    * @author 
    * @todo Constructor de clase
    * @uses CI_Controller::__construct() para inicializar los métodos y atributos de la clase padre.
    */
	function __construct() {
		parent::__construct();
    }


    public function buscarUsuario($correo, $contrasena){

        $lectura = $this->load->database('default', TRUE);
        $lectura->select('id_usuario,correo_electronico,password, nombre');
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
                'nombre'=>$row->nombre
            ];           

            return $tmp;
        }
        else
            return null;
    }


    public function registrarUsuario($datos){
        $lectura = $this->load->database('default', TRUE);
        if(!$lectura->insert('usuario',$datos)){
            $r = 0;
        }
        else{
            $r = $lectura->insert_id();
        }
        $lectura->close();
        return $r;
    }


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
                $tmp[$row->id_usuario]['password']=$row->nombre;
            }

            return $tmp;
        }
        else
            return [];
    }

}//fin del modelo