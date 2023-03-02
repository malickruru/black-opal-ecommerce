<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                "nom"=>"Robe",
                "sexe"=>"f",
            ],
            [
                "nom"=>"Combinaison",
                "sexe"=>"f",
            ],
            [
                "nom"=>"Ensemble",
                "sexe"=>"m",
            ], 
            [
                "nom"=>"Chemise",
                "sexe"=>"m",
            ],
        ];

        foreach ($categories as $c) {
            Categories::create($c);
            }
    }
}
