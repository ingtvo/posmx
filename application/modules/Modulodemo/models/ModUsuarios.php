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

class ModUsuarios extends MX_Controller{
    /**
    * @author 
    * @todo Constructor de clase
    * @uses CI_Controller::__construct() para inicializar los métodos y atributos de la clase padre.
    */
	function __construct() {
		parent::__construct();
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