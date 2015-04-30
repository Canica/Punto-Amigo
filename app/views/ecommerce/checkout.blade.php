<div class="row comprobante">
	<h1>Comprobante</h1>
	<p>Estimado cliente diríjase a cualquier agencia de la Cooperativa Andalucía con su <b>libreta de ahorros, cédula y este comprobante</b>.<br> 
		Genere un PDF precionando en el botón inferior "Imprimir Comprobante" el cual podrá imprimir o guardar en su ordenador.</p>
	<p>Recuerde que a partir de este momento su comprobante tiene una <b>vigencia de 72 horas</b>.</p>
	<p>Puede acceder al <b>historial de sus pedidos</b> en el menú junto a su nombre en la barra superior si desea imprinr el comprobante más tarde</p>

	<a href="{{ route('pdf', [$the_id])}}" class="button success imprimir" target="_black">Imprimir Comprobante</a>
	
	<ul>
		@foreach($resultado as $key => $comp)
			@if ($key === 'user_id')
				<li><b>Cliente:</b> {{$comp}}</li>
			@elseif ($key === 'id')
				<li><b>ID del pedido:</b> {{$comp}}</li>
			@elseif ($key === 'totalCost')
				<li><b>Costo en puntos:</b> {{$comp}}</li>
			@elseif ($key === 'estado')
				<li><b>Estado:</b> {{$comp}}</li>
			@endif
			<?php
				if(is_array($comp)){
					echo '<li><b>Producto:</b><table><thead>
					<tr>
				      <th>ID</th>
				      <th>Nombre</th>
				      <th>Costo en puntos</th>
				      <th>Cantidad</th>
				      <th>Total</th>
				    </tr>
					</thead><tbody><tr>';
					foreach ($comp as $key => $value) {
						if($key != 'imagen'){
							echo '<td>';
							echo  $value;
							echo '</td>';
						}
					}
					echo '</tr></tbody></table></li>';
				}
			?>

		@endforeach
		<li><img alt="barcode" src="{{$barcode}}" /></li>
	</ul>
</div>
<a href="{{ route('pdf', [$the_id])}}" class="button success imprimir" target="_black">Imprimir Comprobante</a>
