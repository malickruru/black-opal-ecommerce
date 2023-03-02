<?php

namespace Database\Seeders;

use App\Models\Avis;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;



class AvisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 180; $i++) {
            $user = User::all()->random();
            $produit = Produit::all()->random();

            if (!Avis::where('user_id', $user->id)->where('produit_id', $produit->id)->exists()) {
                Avis::create([
                    'note' => $faker->numberBetween(1, 5),
                    'commentaire' => $faker->text,
                    'user_id' => $user->id,
                    'produit_id' => $produit->id,
                ]);
            }
    }
}
}