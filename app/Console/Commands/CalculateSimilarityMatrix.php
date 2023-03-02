<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateSimilarityMatrix extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'similarity:calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        DB::table('similarity_matrix')->truncate();
        // 1. Récupérer les données de comportement utilisateur à partir de la table envie
        $data = DB::table('envies')->select('user_id', 'produit_id')->get();

        // 2. Créer une matrice utilisateur-produit
        $matrix = [];
        foreach ($data as $row) {
            $userId = $row->user_id;
            $produitId = $row->produit_id;

            if (!isset($matrix[$userId])) {
                $matrix[$userId] = [];
            }

            $matrix[$userId][$produitId] = 1;
        }

        // 3. Calculer la similarité entre les utilisateurs
        $similarityMatrix = [];
        foreach ($matrix as $userId1 => $products1) {
            foreach ($matrix as $userId2 => $products2) {
                // Si les deux utilisateurs sont identiques, ignorez la comparaison
                if ($userId1 === $userId2) {
                    continue;
                }

                // Calculer la similarité cosinus entre les deux utilisateurs
                $dotProduct = 0;
                $normA = 0;
                $normB = 0;
                foreach ($products1 as $produitId => $valueA) {
                    if (isset($products2[$produitId])) {
                        $valueB = $products2[$produitId];
                        $dotProduct += $valueA * $valueB;
                    }
                    $normA += pow($valueA, 2);
                }
                foreach ($products2 as $produitId => $valueB) {
                    $normB += pow($valueB, 2);
                }
                $similarity = $dotProduct / (sqrt($normA) * sqrt($normB));

                // Stocker la similarité entre les deux utilisateurs dans la matrice de similarité
                $similarityMatrix[$userId1][$userId2] = $similarity;
            }
        }

        // 4. Stocker la matrice de similarité dans votre base de données MySQL
        // Supposons que vous ayez une table "similarity_matrix" avec les champs "user1_id", "user2_id" et "similarity"
        foreach ($similarityMatrix as $userId1 => $similarities) {
            foreach ($similarities as $userId2 => $similarity) {
                DB::table('similarity_matrix')->insert([
                    'user_id_1' => $userId1,
                    'user_id_2' => $userId2,
                    'similarity_score' => $similarity,
                ]);
            }
        }


        return Command::SUCCESS;
    }
}
