<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8">
		<title>Andalucia</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		@section('styles')
			{{HTML::style('css/style.css')}}
			{{HTML::style('css/foundation.css')}}
			{{HTML::script('js/vendor/modernizr.js')}}
			{{HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js')}}
			{{HTML::script('js/foundation.min.js')}}
			{{HTML::script('js/foundation/foundation.reveal.js')}}
		@show
	</head>

	<body>
		<div class="content">
			@yield('content')
		</div>

		@yield('scripts')
			
			<script>
				$(document).foundation();
			</script>
		@show
	</body>
</html>