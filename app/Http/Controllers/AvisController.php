<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkLogin', ['only' => [ 'create','showFormAvis']]);
    }

    public function showFormAvis($id){
        $produit = Produit::find($id);
        return view('avis.create',compact('produit'));
    }

    public function create(Request $request){
        
        $avis = Avis::create([
            'user_id' => Auth::user()->id,
            'produit_id' => $request->produit_id,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return redirect()->route('index')->with('success', 'votre commentaire à été enregistrer');

    }
    
}
