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
 			'origen' => array( 				
				'type' => 'text',
 				'id' => 'origen',
 				'name' => 'origen',
 				'class' => 'form-control invisible',
 				'value' => 'login'
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
 			'contrasena2' => array( 				
				'type' => 'password',
 				'id' => 'contrasena2',
 				'name' => 'contrasena2',
 				'class' => 'form-control',
 				'placeholder' => 'contraseña',
 			), 			
 			'origen' => array( 				
				'type' => 'text',
 				'id' => 'origen',
 				'name' => 'origen',
 				'class' => 'form-control invisible',
 				'value' => 'registro',
 			),
 			'registrar' => array( 				
				'type' => 'submit',
				'value' => 'Registrarme',
 				'class' => 'btn btn-primary btn-lg btn-block', 				
 			),
		);
	}

/**
 * @author Gustavo Pérez Cruz
 * @uses Define los campos recuperar la contraseña
 */
function recuperaritems(){
		return array(
			'correo' => array(
				'type' => 'email',				
				'id' => 'correo',
				'name' => 'correo',
				'class' => 'form-control',
				'placeholder' => 'Correo Electrónico',
				'required' => 'required',
				'autofocus' => 'autofocus'
			),
 			'ingresar' => array( 				
				'type' => 'submit',
				'value' => 'Recuperar',
 				'class' => 'btn btn-primary btn-block',
 			),
		);
	}

/**
 * @author Gustavo Pérez Cruz
 * @uses Define los campos recuperar la contraseña
 */
function resetitems(){
		return array(
			'contrasena' => array(
				'type' => 'password',				
				'id' => 'contrasena',
				'name' => 'contrasena',
				'class' => 'form-control',
				'required' => 'required',
				'autofocus' => 'autofocus'
			),
			'contrasena2' => array(
				'type' => 'password',				
				'id' => 'contrasena2',
				'name' => 'contrasena2',
				'class' => 'form-control',
				'required' => 'required'
			),			
			'inputIdUsuario' => array(
				'type' => 'text',				
				'id' => 'inputIdUsuario',
				'name' => 'inputIdUsuario',
				'class' => 'form-control sr-only',
				'readonly' =>'readonly'
			), 			
 			'origen' => array( 				
				'type' => 'text',
 				'id' => 'origen',
 				'name' => 'origen',
 				'class' => 'form-control invisible',
 				'value' => 'registro'
 			),
 			'guardar' => array( 				
				'type' => 'submit',
				'value' => 'Guardar',
 				'class' => 'btn btn-primary btn-block',
 			),
		);
	}