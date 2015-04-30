@extends('layout')

@section('content')

<h3>Contacto</h3>

{{ Form::open(['route' => 'sendemail', 'method' => 'POST', 'role' => 'form', 'novalidate']) }}
{{ Field::text('name') }}
{{ Field::email('email') }}
{{ Field::text('subject') }}
{{ Field::textarea('menssage') }}

{{ Form::submit('Envíar', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}

@stop