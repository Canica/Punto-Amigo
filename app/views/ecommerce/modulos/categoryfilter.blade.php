
<button href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="button dropdown tiny left">
	<span class="hide-for-large-up">
		<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16">
			<path fill="#fff" d="M6 1h10v2h-10v-2zM6 7h10v2h-10v-2zM6 13h10v2h-10v-2zM0 2c0-1.105 0.895-2 2-2s2 0.895 2 2c0 1.105-0.895 2-2 2s-2-0.895-2-2zM0 8c0-1.105 0.895-2 2-2s2 0.895 2 2c0 1.105-0.895 2-2 2s-2-0.895-2-2zM0 14c0-1.105 0.895-2 2-2s2 0.895 2 2c0 1.105-0.895 2-2 2s-2-0.895-2-2z"></path>
		</svg>
	</span>
	<span class="show-for-large-up">Categorías</span>
</button>
<ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true">
  	@foreach($categorias as $cat)
		<li><a href="{{ route('categoria',[$cat->id]) }}">{{$cat->name}}</a></li>
	@endforeach
</ul>
<div class="search left">
	<a href="#" data-reveal-id="buscador" class="boton_icon lupita">
		<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
			<path fill="#008CBA" d="M31.008 27.231l-7.58-6.447c-0.784-0.705-1.622-1.029-2.299-0.998 1.789-2.096 2.87-4.815 2.87-7.787 0-6.627-5.373-12-12-12s-12 5.373-12 12 5.373 12 12 12c2.972 0 5.691-1.081 7.787-2.87-0.031 0.677 0.293 1.515 0.998 2.299l6.447 7.58c1.104 1.226 2.907 1.33 4.007 0.23s0.997-2.903-0.23-4.007zM12 20c-4.418 0-8-3.582-8-8s3.582-8 8-8 8 3.582 8 8-3.582 8-8 8z"></path>
		</svg>
	</a>
	<a href="#" data-reveal-id="Recomendados" class="boton_icon estrellita">
	<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
		<path fill="#008CBA" d="M32 12.408l-11.056-1.607-4.944-10.018-4.944 10.018-11.056 1.607 8 7.798-1.889 11.011 9.889-5.199 9.889 5.199-1.889-11.011 8-7.798z"></path>
	</svg>
	</a>

	<a href="#" data-reveal-id="wishlist" class="boton_icon wish_icon">
		<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
			<path fill="#008CBA" d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
		</svg>
	</a>
	
	<div id="wishlist" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
		<ngcart-wishlist></ngcart-wishlist>
		<a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>

	<div id="buscador" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
	  <div>
	  	{{ Form::open(array('route' => 'buscar', 'role' => 'form', 'autocomplete'=>'on')) }}
	  		@if($errors->first())
		  		<script type="text/javascript">
					$('#buscador').foundation('reveal', 'open');
				</script>
			@endif
		  	<h3>Busca un producto</h3>
		  	<div>
		  		{{ Field::text('keyword', '', ['placeholder' => 'Buscar...', 'class' => 'search_input']) }}
		  	</div>
		  	<div>
	  			{{ Field::input('number', 'min', '', ['placeholder' => 'Rango Mínimo de puntos', 'class' => 'search_points_input left']) }}
	  			{{ Field::input('number', 'max', '', ['placeholder' => 'Rango Máximo de puntos', 'class' => 'search_points_input left']) }}
		  		<div class="search_button">
		  			{{ Form::submit('Buscar', array('class' => 'button success radius tiny')) }}
				</div>
			</div>
		{{ Form::close() }}
	  </div>
	  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>

	<div id="Recomendados" class="reveal-modal contenido" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
		<div class="categoria row">
		    <h4>Nuestras recomendaciones para tí</h4>
		    @foreach($recomendados as $index => $prod)
	            <div class="producto small-6 medium-3 large-3 columns infinite-item">
	                <div class="img_product">
	                    <img src="{{url('/')}}/img/productos/{{$prod->imagen}}" alt="{{$prod->titulo}}" />
	                </div>
	                <div class="panel">
	                    <h3>{{$prod->titulo}}</h3>
	                    <div class="costo">
	                        {{$prod->costo}} <i>puntos</i>
	                    </div>
	                </div>
	                <div class="tools">
	                    <ngcart-addtocart id="{{ $prod->id }}" name="{{ $prod->titulo }}" price="{{ $prod->costo }}" quantity="1" quantity-max="5" data="item" userpoints="2000"  img="{{url('/')}}/img/productos/{{$prod->imagen}}" stock="{{$prod->stock}}" userstate="{{ $socio->bloqueado }}">
	                        <div class="show-for-small-only">Añadir al carrito</div>
	                        <div class="show-for-medium-up"><img src="{{url('/')}}/img/anadir.png"></div>
	                    </ngcart-addtocart>
	                </div>
	                <div class="description">
	                    <div class="texto">
	                        {{$prod->description}}
	                    </div>
	                </div>
	            </div>
		    @endforeach
		</div>
		<a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div> 
</div>
