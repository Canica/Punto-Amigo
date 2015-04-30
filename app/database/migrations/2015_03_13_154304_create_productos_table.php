<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productos', function($table)
        {
            $table->increments('id');

            $table->integer('category_id');
            $table->text('titulo');
            $table->string('slug');
            $table->longText('description');
            $table->string('imagen');
            $table->integer('costo');
            $table->integer('stock');
            $table->boolean('estado');

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
		Schema::drop('productos');
	}

}
