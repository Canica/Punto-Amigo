<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('CategoriasTableSeeder');
        $this->call('ProductosTableSeeder');
        $this->call('UsuarioTableSeeder');
	}

}
