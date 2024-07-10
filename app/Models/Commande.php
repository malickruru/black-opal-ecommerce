<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'black_opal_commandes';

    protected $fillable = [
        'user_id',
        'total',        
    ];

    public function produit(){
        return $this->belongsToMany(Produit::class,'pivot_commande_produit','commande_id','produit_id');
    }
}
