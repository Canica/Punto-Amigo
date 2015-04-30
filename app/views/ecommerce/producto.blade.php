@extends('ecommerce.layout')


@section('cart')

<div class="producto_solo row">
    <div class="img_product columns small-12 medium-3 large-3">
        <img src="{{url('/')}}/img/productos/{{$producto[0]->imagen}}" alt="{{$producto[0]->titulo}}" class="small-12 medium-12 large-12" />
    </div>
    <div class="productInfo columns small-12 medium-9 large-9">
        <div class="infoText large-7 left">
            <h1>{{$producto[0]->titulo}}</h1>
            <div class="description">
                {{$producto[0]->description}}
            </div>
        </div>
        <div class="infoTools small-12 medium-5 large-5 left">
            <div class="costo">
                {{$producto[0]->costo}} <i>puntos</i>
            </div>
            <div class="tools productTools small-12">
                <ngcart-addtocart id="{{ $producto[0]->id }}" name="{{ $producto[0]->titulo }}" price="{{ $producto[0]->costo }}" quantity="1" quantity-max="5" data="item" userpoints="2000" img="{{url('/')}}/img/productos/{{$producto[0]->imagen}}" stock="{{$producto[0]->stock}}" >Añadir al carrito</ngcart-addtocart>
            </div>
        </div>
    </div>
</div>
<div class="prod_mc">
    {{$mascanjeados}}
</div>

@stop