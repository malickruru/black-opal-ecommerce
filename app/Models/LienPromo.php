<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LienPromo extends Model
{
    use HasFactory;
    protected $table = 'pivot_user_codepromo';

    protected $fillable = [
        'user_id',
        'active',
    ];

    public function code(){
        return $this->belongsTo(Codepromo::class,'codepromo_id');
    }
}
