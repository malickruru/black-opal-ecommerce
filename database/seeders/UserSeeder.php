<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run(Faker $faker)
    {
        
        DB::table('users')->insert([
            'nom' => 'Mensah',
            'prenom' => 'Rubens',
            'email' => 'rubs99rstd@gmail.com',
            'password' => bcrypt('password'),
            'photo' => '/images/users/1676314347.jpg'
        ]);
        

        for ($i = 0; $i < 20; $i++) {
            DB::table('users')->insert([
                'nom' => $faker->firstName,
                'prenom' => $faker->lastName,
                'email' => $faker->email,
                'password' => bcrypt('password'),
                'photo' => "https://picsum.photos/id/".$faker->numberBetween(1, 500)."/200/300"
            ]);
        }
    }
}
