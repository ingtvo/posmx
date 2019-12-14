<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Gustavo Pérez Cruz
 * @uses Define los campos del formulario de login
 */
function logitems(){
		return array(
			'correo' => array(
				'type' => 'email',				
				'id' => 'correo',
				'name' => 'correo',
				'value' => 'Correo Electrónico',
				'class' => 'form-control',
				'placeholder' => 'Correo Electrónico',
				'required' => 'required',
				'autofocus' => 'autofocus'
			),
 			'contrasena' => array( 				
				'type' => 'password',
 				'id' => 'contrasena',
 				'name' => 'contrasena',
 				'class' => 'form-control',
 				'placeholder' => 'contraseña',
 			),
 			'ingresar' => array( 				
				'type' => 'submit',
				'value' => 'Ingresar',
 				'class' => 'btn btn-primary btn-block',
 			),
		);
	}

/**
 * @author Gustavo Pérez Cruz
 * @uses Define los campos del formulario de registro
 */
function regitems(){
		return array(

 			'nombres' => array( 				
				'type' => 'text',
 				'id' => 'nombres',
 				'name' => 'nombres',
 				'class' => 'form-control',
 				'placeholder' => 'Nombres',
 			),

 			'apellidoPaterno' => array( 				
				'type' => 'text',
 				'id' => 'apellidoPaterno',
 				'name' => 'apellidoPaterno',
 				'class' => 'form-control',
 				'placeholder' => 'Apellido Paterno',
 			),

 			'apellidoMaterno' => array( 				
				'type' => 'text',
 				'id' => 'apellidoMaterno',
 				'name' => 'apellidoMaterno',
 				'class' => 'form-control',
 				'placeholder' => 'Apellido Materno',
 			),
			'correo' => array(
				'type' => 'email',				
				'id' => 'correo',
				'name' => 'correo',
				'value' => 'Correo Electrónico',
				'class' => 'form-control',
				'placeholder' => 'Correo Electrónico',
				'required' => 'required',
				'autofocus' => 'autofocus'
			),
 			'contrasena' => array( 				
				'type' => 'password',
 				'id' => 'contrasena',
 				'name' => 'contrasena',
 				'class' => 'form-control',
 				'placeholder' => 'contraseña',
 			),
 			'registrar' => array( 				
				'type' => 'submit',
				'value' => 'Registrarme',
 				'class' => 'btn btn-primary btn-lg btn-block',
 				
 			),
		);
	}