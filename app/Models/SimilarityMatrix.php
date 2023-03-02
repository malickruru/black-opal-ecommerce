<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimilarityMatrix extends Model
{
    use HasFactory;

    protected $table = 'similarity_matrix';

    protected $fillable = [
        'user_id_1',
        'user_id_2',
        'similarity_score',
    ];

    public function user1()
    {
        return $this->belongsTo(User::class, 'user_id_1');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user_id_2');
    }
}
