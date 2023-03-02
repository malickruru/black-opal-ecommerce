<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'numero',
        'adresse',
        'photo',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function envie(){
       return $this->belongsToMany(Produit::class,'envies','user_id','produit_id');
    }

    // recupérer tout les code promos
    public function promo(){
        return $this->belongsToMany(Codepromo::class,'pivot_user_codepromo','user_id','codepromo_id');
    }

    // récupérer tous les lien promos
    public function lienPromo(){
        return $this->hasMany(LienPromo::class,'user_id');
    }

    public function commande(){
        return $this->hasMany(Commande::class,'user_id');
    }

    // // retourne tous les produit du panier
    // public function panier(){
    //     return $this->belongsToMany(Produit::class,'panier','user_id','produit_id');
    // }

    // // retourne toute les relations du panier
    // public function lienPanier(){
    //     return $this->hasMany(Panier::class,'user_id');
    // }

    public function avis(){
        return $this->hasMany(Avis::class,'user_id');
    }

    public function GetAvis($id){
        return $this->avis()->where('produit_id',$id)->first();
    }

    public function recommandation(){
        // selectionner les utilisateurs similaire
        $friends = $this->hasMany(SimilarityMatrix::class,'user_id_1')->where('similarity_score','>',0.3)->get();
        // return $friends;
        $products = [];
        foreach ($friends as $f) {
            foreach ($f->user2->envie as $item) {
                if (!$this->envie()->where('produit_id', $item->id)->exists()) {
                    array_push($products,$item);
                }
                
            }
        }

        return collect($products)->unique('id')->take(3) ;

    }
}
