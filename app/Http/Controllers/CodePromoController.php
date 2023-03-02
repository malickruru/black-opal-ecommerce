<?php

namespace App\Http\Controllers;

use App\Models\Codepromo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CodePromoController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkLogin', ['only' => [ 'create','index']]);
    }

    public function create(Request $request){
        // le code promo existe t-il
        $promo = Codepromo::where('code',$request->code)->first();
        
        if(!$promo){
            return redirect()->back()->with('error', "ce code promo n'existe pas")->withInput();
        }
        if (User::find(Auth::user()->id)->promo()->where('codepromo_id', $promo->id)->exists()) {
            return redirect()->back()->with('error', "désolé , vous avez déjà profitez de cette promotion")->withInput();
        }

        User::find(Auth::user()->id)->promo()->attach($promo->id);
        return redirect()->back()->with('success', "code promo ajouté avec succès")->withInput();

    }

    public function index(){
        $promos = User::find(Auth::user()->id)->lienPromo->where('active',1);
        return view('promo.index',compact('promos'));
    }
}
