<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envie extends Model
{
    use HasFactory;

    protected $table = 'envies';
    protected $fillable = [
        'user_id',
        'produit_id',
    ];

    
}
