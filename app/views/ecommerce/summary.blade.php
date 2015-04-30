@extends('ecommerce.layout')

@section('cart')

<ngcart-cart></ngcart-cart>

<ngcart-checkout service="http" settings="{ url:'checkout' }">Generar comprobante</ngcart-checkout>

<div id="message"></div>

@stop