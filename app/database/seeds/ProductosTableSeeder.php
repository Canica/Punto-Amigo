<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProductosTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 500) as $index)
		{
			$name = $faker->word;
			Productos::create([
				'category_id' 	=> $faker->randomElement([1, 2, 3, 4]),
				'titulo' 		=> $name,
               	'slug'     		=> Str::slug($name),
               	'description'   => $faker->text(200),
               	'imagen'  		=> 'no-image.jpg',
               	'costo'      	=> $faker->randomElement([100, 200, 300, 400, 500, 600]),
               	'stock'      	=> $faker->randomElement([1, 10, 20, 30, 40, 50]),
               	'estado'      	=> true
			]);
		}
	}

}
