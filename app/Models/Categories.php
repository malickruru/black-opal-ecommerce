<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

protected $table = 'categories';

   protected $fillable = [
        "nom",
        "sexe"
   ];

   public function produits(){
        return $this->hasMany(Produit::class,'category_id'); 
   }
}