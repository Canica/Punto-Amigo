@extends('layout')

@section('scripts')

{{HTML::script('js/angular.min.js')}}
{{HTML::script('js/dist/ngCart.js')}}

{{HTML::script('js/scroll/ng-infinite-scroll.js')}}

{{HTML::script('js/cart.js')}}
{{HTML::style('css/cart.css')}}

@endsection

@section('content')
<div ng-app="CarritoApp" ng-controller="cart">

	<header>
		<div class="logo left">
			<a href="{{url('/')}}">Andalucía Logo</a>
		</div>
		<div class="catFilter left small-6 medium-4 large-4">
	    	{{$categoryfilter}}
	    </div>


	    <div class="summary right">
		    <a ui-sref="site.summary" style="padding: 5px 0 0 0; width:150px" href="{{ route('summary') }}">
		        <div class="left"><ngcart-summary></ngcart-summary></div>
		        <div class="button tiny reclamar right">
		        	<span class="hide-for-large-up">
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16">
							<path fill="#fff" d="M15.5 8l-7.5-7.5v4.5h-8v6h8v4.5z"></path>
						</svg>
					</span>
					<span class="show-for-large-up">Reclamar mis premios</span>
		        </div>
		    </a>
		</div>
		
	    <div class="userInfo right">

	    	<a href="#" class="button split tiny">
	    		<div data-dropdown="drop" class="Avatar left" style="background-image:url({{url('/')}}/img/avatars/nicolas.jpg);">
		    	</div>
		    	<div class="userData left show-for-large-up">
		    		<div class="name"><i>Bienvenido</i> <b>{{ $socio->nombre }}</b></div>
		    		<div class="userPoints"><i>Tienes <b>2000</b> puntos</i></div>
		    	</div>
	    		<span data-dropdown="drop" class="show-for-large-up"></span>
	    	</a><br>
			<ul id="drop" class="f-dropdown" data-dropdown-content>
			  <li><a href="#">Editar mi perfil</a></li>
			  <li><a href="{{ route('pedidos') }}">Mis pedidos</a></li>
			  <li><a href="{{url('/')}}/logout">Salir</a></li>
			</ul>
				    </div>
	</header>
	<section class="contenido row">
		<div class="carritoContent large-9 columns">
    		@yield('cart')
    	</div>
		<div class="wishlist large-3 columns show-for-large-up">
			<div class="wishlistinner">
				<ngcart-wishlist></ngcart-wishlist>
			</div>
		</div>

    </section>
    <footer>
    	<div class="logo">
			<a href="{{url('/')}}">Andalucía Logo</a>
		</div>

		<dl class="sub-nav">
		  <dd><a href="#">¿Quienes Sómos?</a></dd>
		  <dd><a href="#">Téminos Legales</a></dd>
		  <dd><a href="#">¿Cómo reclamar los premios?</a></dd>
		</dl>
    	
    </footer>
</div>

@stop
