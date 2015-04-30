<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsuarioTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		$fileName = rand(11111, 99999).'-foto.jpg';

		foreach(range(1, 10) as $index)
		{
			Usuario::create([
	           'cedula' => rand(1111111111, 9999999999),
	           'cuenta' => rand(1111111111, 9999999999),
	           'nombre' => $faker->userName,
	           'apellido' => $faker->lastname,
	           'telefono_domicilio' => rand(1111111111, 9999999999),
	           'telefono_celular' => rand(1111111111, 9999999999),
	           'dieccion' => $faker->text(300),
	           'email' => $faker->text(300),
	           'avatar' => $fileName,
	           'ciudad' => $faker->randomElement(['Quito', 'Guayaquil', 'Cuenca']),
	           'tipo' => $faker->randomElement(['general', 'referido']),
	           'completo' => $faker->randomElement([1,0]),
	           'bloqueado' => false,

			]);
		}

		Usuario::create([
	        'cedula' => '1713555553',
	        'cuenta' => '1033377775',
	        'nombre' => 'kanika',
	        'apellido' => 'rocks',
	        'telefono_domicilio' => '023566328',
	        'telefono_celular' => '0997671615',
	        'dieccion' => $faker->text(300),
	        'email' => 'nicolasvelah@gmail.com',
	        'avatar' => $fileName,
	        'ciudad' => $faker->randomElement(['Quito', 'Guayaquil', 'Cuenca']),
	        'tipo' => 'admin',
	        'completo' => 0,
	        'bloqueado' => true,
		]);
	}

}
