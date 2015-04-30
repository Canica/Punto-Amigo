@extends('ecommerce.layout')

@section('cart')
	<h1>Mis pedidos</h1>
	<table class="table-cart table-striped ngCart cart large-12">
        <thead>
			<tr>
				<th>ID del pedido</th>
				<th>Productos</th>
				<th>Total</th>
				<th>Fecha del pedido</th>
				<th>Código de barras</th>
				<th>Estado</th>
			 </tr>
		</thead>
		<tbody>
			@foreach($pedidos as $pedido)
				<tr>
					<td>{{$pedido->id}}</td>
					<td>
						<div class="left large-6">
							<ul>
								<?php
									$products_cant = array();
									$cantidadLimpia = substr($pedido->products_quantity, 1, -1);
						            $prod_cant = explode(",", $cantidadLimpia);
						            foreach ($prod_cant as $cant) {
						                array_push($products_cant, $cant);
						            }
								?>
								<li><b>Nombre</b></li>
								@foreach($pedido->productos as $key => $producto)
									<li><a href="{{ route('producto', [$producto->id])}}">{{$producto->titulo}}</a></li>
								@endforeach
							</ul>
						</div>
						<div class="left large-6">
							<ul>
								<li><b>Cantidad</b></li>
								@foreach($products_cant as $key => $cant)
									<li>{{$cant}}</li>
								@endforeach
							</ul>
						</div>
					</td>
					<td>{{$pedido->total_cost}}</td>
					<td>{{$pedido->created_at}}</td>
					<td><img src="{{$pedido->barcode}}"></td>
					<td>{{$pedido->estado}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop