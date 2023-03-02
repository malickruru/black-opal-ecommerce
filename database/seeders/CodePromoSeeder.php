<?php

namespace Database\Seeders;

use App\Models\Codepromo;
use Illuminate\Database\Seeder;

class CodePromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $codePromo = [
            [
                "code"=>"STVALENTIN",
            ], 
            [
                "code"=>"PAQUINOU",
            ],
            [
                "code"=>"REDUX",
            ],
        ];

        foreach ($codePromo as $c) {
            Codepromo::create($c);
            }
    }
}