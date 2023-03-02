<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produits = [
            [
                "nom"=>"Robe saki",
                'description' => 'Un toucher plus soyeux, un design inédit et exclusif, un prix doux.',
                'prix' => 25000,
                "photo" => "img/robesaki.jpg",
                "category_id" => 1

            ],
            [
                "nom"=>"Ensemble vespi",
                'description' => 'Un toucher plus soyeux, un design inédit et exclusif, un prix doux.',
                'prix' => 29000,
                "photo" => "img/ensvespi.jpg",
                "category_id" => 3
            ],
            [
                "nom"=>"Robe karda",
                'description' => 'Un toucher plus soyeux, un design inédit et exclusif, un prix doux.',
                'prix' => 29000,
                "photo" => "img/robekarda.jpg",
                "category_id" => 1
            ],
            [
                "nom"=>"Ensemble seck",
                'description' => 'Un toucher plus soyeux, un design inédit et exclusif, un prix doux.',
                'prix' => 29000,
                "photo" => "img/ensseck.jpg",
                "category_id" => 3
            ],
            [
                "nom"=>"Pantalon nerya",
                'description' => 'Un toucher plus soyeux, un design inédit et exclusif, un prix doux.',
                'prix' => 42000,
                "photo" => "img/pannerya.jpg",
                "category_id" => 2
            ],
            [
                "nom"=>"Chemise",
                'description' => 'Un toucher plus soyeux, un design inédit et exclusif, un prix doux.',
                'prix' => 4000,
                "photo" => "img/chemise.jpg",
                "category_id" => 4
            ],
        ];

        foreach ($produits as $produit) {
            Produit::create($produit);
            }
        
        // robe
        for ($i=1; $i < 30; $i++) {
            $produit = new Produit();
            $produit->nom = "robe n° ".$i;
            $produit->description = 'Un toucher plus soyeux, un design inédit et exclusif, un prix doux.';
            $produit->prix = random_int(5, 50)*1000;
            $produit->photo = "img/robe_$i.jpg";
            $produit->category_id = 1;
            $produit->save();
        }

        // Combinaison
        for ($i=1; $i < 10; $i++) {
            $produit = new Produit();
            $produit->nom = "combinaison n° ".$i;
            $produit->description = 'Un toucher plus soyeux, un design inédit et exclusif, un prix doux.';
            $produit->prix = random_int(5, 50)*1000;
            $produit->photo = "img/combinaison_$i.jpg";
            $produit->category_id = 2;
            $produit->save();
        }

        // Ensemble
        for ($i=1; $i < 10; $i++) {
            $produit = new Produit();
            $produit->nom = "ensemble n° ".$i;
            $produit->description = 'Un toucher plus soyeux, un design inédit et exclusif, un prix doux.';
            $produit->prix = random_int(5, 50)*1000;
            $produit->photo = "img/ensemble_$i.jpg";
            $produit->category_id = 3;
            $produit->save();
        }

        // Chemise
        for ($i=1; $i < 4; $i++) {
            $produit = new Produit();
            $produit->nom = "chemise n° ".$i;
            $produit->description = 'Un toucher plus soyeux, un design inédit et exclusif, un prix doux.';
            $produit->prix = random_int(5, 50)*1000;
            $produit->photo = "img/chemise_$i.jpg";
            $produit->category_id = 4;
            $produit->save();
        }
    }
}
