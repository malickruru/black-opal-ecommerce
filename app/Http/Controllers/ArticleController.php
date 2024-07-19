<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $query = Produit::query();
            //On récupère tous les Article
        if ($request->has('s') && !empty($request->input('s'))) {
            $searchTerm = $request->input('s');
            $query = $query->where('nom', 'like', '%' . $searchTerm . '%');
        }
        $article =$query->paginate(20);

        // On transmet les article à la vue
        return view("article.index", compact("article"));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorie = Categories::get();
        return view('article.create' , compact('categorie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->photo;
        $filename = time().'.'.$request->photo->extension();
        
        $destinationPath = public_path() . '/img'; 
        $file->move($destinationPath, $filename);

        // $path=$request->photo->storeAs('img', $filename);



        Produit::create([
            "nom" => $request->name,
            'category_id'=> $request->categorie_id,
            'description'  =>$request->content,
            'prix'  =>$request->price,
            'photo'=> 'img' . '/' . $filename
        ]);

        return redirect(route("article.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $article)
    {
        return view("article.show", compact("article"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $article)
    {
        $categorie = Categories::get();
        return view("article.edit", compact(['article','categorie']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $article)
    {
        $filename =  $article->photo;


        if($request->isNewImage){
            $file = $request->photo;
            $filename = time().'.'.$request->photo->extension();
            
            $destinationPath = public_path() . '/img'; 
            $file->move($destinationPath, $filename);
            $filename =  'img' . '/' .$filename;
        }

        

        $article ->update([
            "nom" => $request->name,
            'category_id'=> $request->categorie_id,
            'description'  =>$request->content,
            'prix'  =>$request->price,
            'photo'=> $filename,
            'active'=>$request->active,
            ]) ;


        return redirect(route("article.index"));
    }

    public function delete(Produit $article){
        return view('article.delete', compact("article"));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $article)
    {
        unlink($article->photo);
        // Storage::delete($article->photo);
        $article->delete(); 
        return redirect(route("article.index"));
    }

}
