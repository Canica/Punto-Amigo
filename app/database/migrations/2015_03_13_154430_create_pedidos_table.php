<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedidos', function($table)
        {
            $table->increments('id');

			$table->integer('user_id');
			$table->longText('products_id');
			$table->longText('products_quantity');
			$table->integer('total_cost');
			$table->string('barcode');
			$table->enum('estado', ['pendiente', 'canjeado', 'cancelado']);
            

            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pedidos');
	}

}
