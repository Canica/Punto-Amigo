<?php


class CategoriasTableSeeder extends Seeder {

	public function run()
	{

			Categorias::create([
	           'id'   => 1,
	           'name' => 'Categoría Uno',
	           'slug' => 'categoria-uno',
	           'tipo' => 'general',
	           'estado' => true
	        ]);

	        Categorias::create([
	           'id'   => 2,
	           'name' => 'Categoría Dos',
	           'slug' => 'categoria-dos',
	           'tipo' => 'general',
	           'estado' => true
	        ]);

	        Categorias::create([
	           'id'   => 3,
	           'name' => 'Categoría Tres',
	           'slug' => 'categoria-tres',
	           'tipo' => 'promocion',
	           'estado' => true
	        ]);

	        Categorias::create([
	           'id'   => 4,
	           'name' => 'Categoría Cuatro',
	           'slug' => 'categoria-cuatro',
	           'tipo' => 'promocion',
	           'estado' => true
	        ]);

	}

}
