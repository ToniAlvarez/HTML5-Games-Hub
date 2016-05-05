<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => $faker->userName,
                'email' => $faker->userName.'@gmail.com',
                'password' => bcrypt($faker->randomDigit),
                'tipo' => $faker->randomElement(array('admin', 'dev', 'user')),
            ]);
        }
    }
}
