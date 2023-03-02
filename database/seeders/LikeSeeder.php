<?php

namespace Database\Seeders;

use App\Models\Produit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 180; $i++) { 
            $user = User::all()->random();
            $produit = Produit::all()->random();
            $user->envie()->syncWithoutDetaching($produit->id); 
        }
    }
}
