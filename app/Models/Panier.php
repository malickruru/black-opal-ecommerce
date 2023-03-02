<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    protected $table = 'paniers';

    protected $fillable = [
        'user_id',
        'produit_id',
        'quantite'        
    ];

    public function produit(){
        return $this->belongsTo(Produit::class,'produit_id');
    }
}
