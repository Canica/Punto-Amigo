<div class="losMasVotados categoria row">
    <h4>Los más Canjeados</h4>
    @foreach($productos2 as $index => $prod)
        @if($index < 4)
            <div class="producto small-12 medium-3 large-3 columns infinite-item">
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
        @endif
    @endforeach
</div>

