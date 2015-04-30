<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Usuario extends Eloquent {

	protected $table = 'usuario';

	//reglas de validacion form login
	public static function getValidatorLogin($input) {
		$rules = array(	
			'cedula' => 'required',
			'cuenta' => array('required','digits:10')
		);

		$validator = Validator::make($input, $rules);

		return $validator;
	}

	//valida si socio existe en base
	public static function validaUsuario($input) {
		$cedula = $input['cedula'];
		$cuenta = $input['cuenta'];

		$usuario = DB::connection('mysql')->select('	select 	count(1) as count
													from 	usuario
													where 	cedula = ?
													and 	cuenta = ?',
													array($cedula, $cuenta)
		);

		if($usuario[0]->count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//valida si socio existe en base
	public static function getValidarActualizacion($input) {
		$rules = array(	
			'telefono_domicilio' => 'required',
			'telefono_celular' => 'required',
			'email' => array('required', 'email'),
			'ciudad' => 'required',
		);

		$validator = Validator::make($input, $rules);

		return $validator;
	}

}