@extends('layout')

@section('content')

	<section class="login">

		<div class="row">
			<div data-alert class="alert-box warning text-center">
				Antes de continuar debe actualizar su información personal.
			</div>
		</div>

		{{ Form::open(array('url' => '/actualizar-informacion', 'role' => 'form', 'autocomplete'=>'off')) }}

		<div class="row">
			<div class="form-group <?php echo $errors->has('cedula') ? 'has-error' : '' ?>">
				<div class="large-3 columns">
					{{ Form::label('cedula', 'Número de cédula:',array('id' => 'lb_cedula', 'class' => 'right inline')) }}
				</div>
				<div class="large-9 columns">
				{{ Form::text('cedula', $cedula, array('disabled' => 'disabled', 'class' => 'form-control', 'id' => 'cedula') ) }}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group <?php echo $errors->has('nombre') ? 'has-error' : '' ?>">
				<div class="large-3 columns">
				{{ Form::label('nombre', 'Nombre:',array('id' => 'lb_cedula', 'class' => 'right inline')) }}
				</div>
				<div class="large-9 columns">
				{{ Form::text('nombre', $nombre, array('disabled' => 'disabled', 'class' => 'form-control', 'id' => 'nombre') ) }}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group <?php echo $errors->has('apellido') ? 'has-error' : '' ?>">
				<div class="large-3 columns">
				{{ Form::label('apellido', 'Apellido:',array('id' => 'lb_cedula', 'class' => 'right inline')) }}
				</div>
				<div class="large-9 columns">
				{{ Form::text('apellido', $apellido, array('disabled' => 'disabled', 'class' => 'form-control', 'id' => 'apellido') ) }}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group <?php echo $errors->has('telefono_domicilio') ? 'has-error' : '' ?>">
				<div class="large-3 columns">
					{{ Form::label('telefono_domicilio', 'Teléfono Domicilio:',array('id' => 'lb_cedula', 'class' => 'right inline')) }}
				</div>
				<div class="large-9 columns">
					{{ Form::text('telefono_domicilio', null, array('class' => 'form-control', 'id' => 'telefono_domicilio') ) }}
					<label class="error">{{ $errors->first('telefono_domicilio') }}</label>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group <?php echo $errors->has('telefono_celular') ? 'has-error' : '' ?>">
				<div class="large-3 columns">
					{{ Form::label('telefono_celular', 'Teléfono Celular:',array('id' => 'lb_cedula', 'class' => 'right inline')) }}
				</div>
				<div class="large-9 columns">
					{{ Form::text('telefono_celular', null, array('class' => 'form-control', 'id' => 'telefono_celular') ) }}
					<label class="error">{{ $errors->first('telefono_celular') }}</label>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group <?php echo $errors->has('email') ? 'has-error' : '' ?>">
				<div class="large-3 columns">
				{{ Form::label('email', 'Email:',array('id' => 'lb_cedula', 'class' => 'right inline')) }}
				</div>
				<div class="large-9 columns">
					{{ Form::text('email', null, array('class' => 'form-control', 'id' => 'email') ) }}
					<label class="error">{{ $errors->first('email') }}</label>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group <?php echo $errors->has('ciudad') ? 'has-error' : '' ?>">
				<div class="large-3 columns">
					{{ Form::label('ciudad', 'Ciudad:',array('id' => 'lb_cedula', 'class' => 'right inline')) }}
				</div>
				<div class="large-9 columns">
					{{ Form::text('ciudad', null, array('class' => 'form-control', 'id' => 'ciudad') ) }}
					<label class="error">{{ $errors->first('ciudad') }}</label>
				</div>
			</div>
		</div>

		<div class="row">
			{{ Form::submit('Ingresar', array('class' => 'button success radius small')) }}
		</div>

		{{ Form::close() }}

	</section>

@stop