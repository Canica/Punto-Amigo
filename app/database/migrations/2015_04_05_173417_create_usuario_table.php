<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cedula');
			$table->integer('cuenta');
			$table->string('nombre');
			$table->string('apellido');
			$table->string('telefono_domicilio');
			$table->string('telefono_celular');
			$table->string('dieccion');
			$table->string('email');
			$table->string('avatar');
			$table->string('ciudad');
			$table->integer('completo');
			$table->boolean('bloqueado');
			$table->enum('tipo', ['general', 'referido', 'admin']);
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
		Schema::drop('usuario');
	}

}