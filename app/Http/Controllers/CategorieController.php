<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    $query = Categories::query();
            //On récupère tous les Article
        if ($request->has('s') && !empty($request->input('s'))) {
            $searchTerm = $request->input('s');
            $query = $query->where('nom', 'like', '%' . $searchTerm . '%');
        }
        $categorie =$query->paginate(20);

    // On transmet les Categorie à la vue
    return view("categorie.index", compact("categorie"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Categories::create([
            "nom" => $request->name,
            "sexe" => 'U'
        ]);

        return redirect(route("categorie.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categorie)
    {
        return view("categorie.edit", compact("categorie"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $categorie)
    {
        $categorie->update([
            "nom" => $request->name,
            "active" => $request->active
        ]);

        return redirect(route("categorie.index"));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function delete(Categories $categorie){
        return view('categorie.delete', compact("categorie"));
    }

    public function destroy(Categories $categorie)
    {
        $categorie->delete(); 
        return redirect(route("categorie.index"));
    } 
}
