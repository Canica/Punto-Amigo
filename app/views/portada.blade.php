@extends('layout')

@section('content')

	<section class="portada">
		<div class="infoportada">
			<div class="logo left">
				<a href="{{ route('home') }}">Andalucía Logo</a>
				<a href="#" data-reveal-id="login" class="button right">Ingresar</a>
			</div>
			<a href="#" class="button">Registrarse</a>
		</div>
	</section>
	<div id="login" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
		
		@if(Session::has('message'))
			<div data-alert class="alert-box alert round">
				{{ Session::get('message') }}
				<a href="#" class="close">&times;</a>
			</div>
		@endif

		{{ Form::open(array('url' => ' ', 'role' => 'form', 'autocomplete'=>'off')) }}
			@if($errors->first('cedula') || $errors->first('cuenta') || Session::has('message'))
				<script type="text/javascript">
					$('#login').foundation('reveal', 'open');
				</script>
			@endif
			<div class="form-group <?php echo $errors->has('cedula') ? 'has-error' : '' ?>">
				<label class="error">{{ $errors->first('cedula') }}</label>
				{{ Form::label('cedula', 'Ingrese su número de cédula:',array('id' => 'lb_cedula')) }}
				{{ Form::input('number', 'cedula', null, array('class' => 'form-control', 'id' => 'cedula') ) }}
			</div>

			<div class="form-group <?php echo $errors->has('cuenta') ? 'has-error' : '' ?>">
				<label class="error">{{ $errors->first('cuenta') }}</label>
				{{ Form::label('cuenta', 'Ingrese su número de socio:',array('id' => 'lb_cuenta')) }}
				{{ Form::input('number', 'cuenta', null,array('class' => 'form-control', 'maxlength' => '10') )}}
			</div>	
			{{ Form::submit('Ingresar', array('class' => 'button success radius')) }}

		{{ Form::close() }}
		<a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>

	<footer>
		<a href="#" class="button">Cómo participar</a>
		<a href="#" class="button">Quiénes somos?</a>
	</footer>
@stop

<style type="text/css">
	.login{
		background: #DEDEDE;
		padding: 5%;
	}
</style>