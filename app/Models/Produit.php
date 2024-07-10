<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'black_opal_produits';

    protected $fillable = [
        'nom',
        'description',
        'prix','photo'
    ];

    public function avis(){
        return $this->hasMany(Avis::class,'produit_id')->get()->sortBy('created_at',SORT_REGULAR,true);
    }

    public function moyenne() {
        return $this->avis()->avg('note');
    }
}
