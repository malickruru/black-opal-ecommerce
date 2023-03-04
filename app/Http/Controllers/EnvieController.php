<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class EnvieController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('checkLogin', ['only' => ['toggleEnvie', 'index']]);
    // }


    public function toggleEnvie(Produit $produit)
    {
        User::find(Auth::user()->id)->envie()->toggle($produit->id);
        // Artisan::call('similarity:calculate');

        if (User::find(Auth::user()->id)->envie()->where('produit_id', $produit->id)->exists()) {
            
            return redirect()->back()->with('success', "vous avez ajouté " . $produit->nom . " à votre liste d'envie ")->withInput();
        }
        
        return redirect()->back()->with('error', "vous avez retiré " . $produit->nom . " de votre liste d'envie ")->withInput();
    }

    public function index()
    {
        $produits = User::find(Auth::user()->id)->envie()->get();
        return view('envie.index', compact('produits'));
        
    }
}
