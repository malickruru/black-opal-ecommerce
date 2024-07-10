<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    protected $table = 'black_opal_avis';

    protected $fillable = [
        'user_id',
        'produit_id',
        'note',
        'commentaire'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
