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
    $categories = Categories::where('active', 1)->get();

    $query = Produit::where('active', 1);

    if ($request->has('s') && !empty($request->input('s'))) {
        $searchTerm = $request->input('s');
        $query = $query->where('nom', 'like', '%' . $searchTerm . '%');
    }

    $produits = $query->paginate(9);

    return view('welcome', compact('produits', 'categories'));
}

    public function categorie($id)
    {
        $produits =  Categories::find($id)->produits()->where('active',1)->paginate(9); 
        $categories = Categories::where('active',1)->get();
        return view('welcome',compact("produits","categories"));
    }


}
