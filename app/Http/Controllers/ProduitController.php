<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Categories::all();
    
        
        if ($request->has('s')) {
            $searchTerm = $request->input('s');
    
            if ($searchTerm == "") {
                $produits = Produit::paginate(9);
            } else {
                $produits = Produit::where('nom', 'like', '%' . $searchTerm . '%')->paginate(9);
            }
        } else {
            $produits = Produit::paginate(9);
        }
    
        return view('welcome',compact("produits","categories"));
    }

    public function categorie($id)
    {
        $produits =  Categories::find($id)->produits()->paginate(9); 
        $categories = Categories::all();
        return view('welcome',compact("produits","categories"));
    }


}
