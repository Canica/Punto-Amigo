@extends('ecommerce.layout')

@section('cart')
    <div class="categoria row infinite-container" id="categoria" change="1">

        <h1>{{$categoria[0]->name}}</h1>
        @foreach($productos as $prod)
            <div class="producto small-12 medium-4 large-2 columns infinite-item">
                <div class="img_product">
                    <img src="{{ route('home') }}/img/productos/{{$prod->imagen}}" alt="{{$prod->titulo}}" />
                </div>
                <div class="panel">
                    <h3>{{$prod->titulo}}</h3>
                    <div class="costo">
                        {{$prod->costo}} <i>puntos</i>
                    </div>
                </div>
                <div class="tools">
                    <ngcart-addtocart id="{{ $prod->id }}" name="{{ $prod->titulo }}" price="{{ $prod->costo }}" quantity="1" quantity-max="5" data="item" userpoints="2000"  img="{{ route('home') }}/img/productos/{{$prod->imagen}}">
                        <div class="show-for-small-only">Añadir al carrito</div>
                        <div class="show-for-medium-up"><img src="{{ route('home') }}/img/anadir.png"></div>
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

    {{$productos->links()}}
@stop