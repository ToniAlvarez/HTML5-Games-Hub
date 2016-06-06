<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

use Faker\Factory as Faker;

use App\Models\User;
use App\Models\Juego;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Vaciar las tablas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Valoracion::truncate();
        \App\Models\Juego::truncate();
        \App\Models\User::truncate();

        $faker = Faker::create();

        DB::table('users')->insert([
            'name' => 'Pepito',
            'email' => 'pepito@pepe.com',
            'password' => bcrypt('pepe'),
            'avatar' => 'avatar_' . $faker->numberBetween($min = 0, $max = 1) . $faker->numberBetween($min = 0, $max = 9) . '.png',
            'tipo' => 'Administrador',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        for ($i = 0; $i < 100; $i++) {
            DB::table('users')->insert([
                'name' => $faker->unique()->userName,
                'email' => $faker->unique()->userName . '@mail.com',
                'password' => bcrypt($faker->randomDigit),
                'avatar' => 'avatar_' . $faker->numberBetween($min = 0, $max = 1) . $faker->numberBetween($min = 0, $max = 9) . '.png',
                //'tipo' => $faker->randomElement(array('Desarrollador', 'Usuario')),
                'tipo' => 'Usuario',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

        DB::table('juegos')->insert([
            'url' => 'buscaminas',
            'nombre' => 'Buscaminas',
            'descripcion' => 'Clasico juego de Microsoft',
            'imagen' => 'buscaminas.png',
            'user_id' => 1,
            'created_at' => $faker->dateTimeThisYear($max = 'now')
        ]);

        //Recuperar todos los IDs de usuarios y juegos para crear valoraciones aleatorias.
        $usuarios = User::pluck('id')->all();
        $juegos = Juego::pluck('id')->all();

        for ($i = 0; $i < 90; $i++) {
            DB::table('valoracions')->insert([
                'puntuacion' => $faker->numberBetween($min = 1, $max = 5),
                'comentario' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'user_id' => $faker->unique()->randomElement($usuarios),
                'juego_id' => $faker->randomElement($juegos),
                'created_at' => $faker->dateTimeThisMonth($max = 'now')
            ]);
        }
    }
}
