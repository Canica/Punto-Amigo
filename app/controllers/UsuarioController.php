<?php

class UsuarioController extends BaseController {

	public function postIndex() {

		$validator = Usuario::getValidatorLogin(Input::all());

		if($validator -> fails()) {
			return Redirect::to('/')->withErrors($validator)->withInput();
		} else {
            $input = Input::all();
            $esSocio = false;
            $esSocio = Usuario::validaUsuario($input);
              
            if($esSocio)
            {
                Session::put('cedula', $input['cedula']);
                $socio = Usuario::where('cedula', $input['cedula'])->first();

                if(!empty($socio))
                {
                    Session::put('socio_id', $socio->id);

                    return Redirect::to('/actualizar-informacion');
                }  
                else
                {
                    //asignamos un valor al socio_id para que no entre
                    Session::put('socio_id', 0);
                    return Redirect::route('/');
                }  
            }
			else
			{
				//no es socio
				return Redirect::to('/')->with('message','Usuario no encontrado, por favor ingrese sus datos correctamente.');
			}
		}
	}

	public function postActualizacion() {
		$validator = Usuario::getValidarActualizacion(Input::all());

		if($validator -> fails()) {
			return Redirect::to('/actualizar-informacion')->withErrors($validator)->withInput();
		} else {
			$socio_id = Session::get('socio_id');
			$socio = Usuario::find($socio_id);

			$socio->telefono_domicilio = Input::get('telefono_domicilio');
			$socio->telefono_celular = Input::get('telefono_celular');
			$socio->email = Input::get('email');
			$socio->ciudad = Input::get('ciudad');
			$socio->completo = '1';
			$socio->save();

			return Redirect::to('/categoria/1');
		}
	}

	public function getLogout() {
		Session::flush();
		return Redirect::to('/');
	}

	public function getActualizacion()
	{
		$socio_id = Session::get('socio_id');
		$socio = Usuario::find($socio_id);

		if($socio->completo == 1)
			return Redirect::to('/categoria/1');

		return View::make('actualizacion', array(
			'cedula' => $socio->cedula,
			'nombre' => $socio->nombre,
			'apellido' => $socio->apellido
		));
	}

}