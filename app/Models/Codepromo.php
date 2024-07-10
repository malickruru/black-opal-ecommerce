<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codepromo extends Model
{
    use HasFactory;

    protected $table = 'black_opal_codepromos';

    protected $fillable = [
        'code',
    ];
}
