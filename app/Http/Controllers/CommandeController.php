<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Panier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends PanierController
{

    // public function __construct()
    // {
    //     $this->middleware('checkLogin', ['only' => ['showCreateForm','index','add']]);
        
    // }
    
    public function  showCreateForm(){
        $cart = session('panier_' . Auth::user()->id);
        // appeler la méthode getCartItemTotals pour récupérer le prix total (quantité * prix ) de chaque produit
        $itemTotals = $this->getCartItemTotals($cart);

        // appeler la méthode getCartTotal pour récupérer le prix total du panier
        $cartTotal = $this->getCartTotal($cart);

        // ajouter les éventuelles réduction
        $reduction = $this->promotion($cartTotal);

    return view('commande.create', ['cart' => $cart, 'itemTotals' => $itemTotals, 'reduction' => $reduction]);    }
    
    public function  create(){
        $cart = session('panier_' . Auth::user()->id);

        if (!$cart) {
            $cart = [];
        }

       
        $cartTotal = $this->getCartTotal($cart);
        // ajouter les éventuelles réduction
        $reduction = $this->promotion($cartTotal);
        
        // 1.créer une commande 
        $commande = Commande::create([
            'user_id' => Auth::user()->id,
            'total' => $reduction['total'],
        ]);
        // 2 .lier tous les produit du panier a une commande
        
        foreach ($cart as $item){
            $commande->produit()->attach($item['id']);
        }

        // 3. vider le panier 
        $this->clearCart();

        // 4. turn promo active to 0
        
        foreach (User::find(Auth::user()->id)->lienPromo()->where('active', 1)->limit(9)->get() as $promo){
            $promo->active = 0;
            $promo->save();
        }
        // 5. retourne à index
        return redirect()->route('index')->with('success', 'Votre paiement à été valider');
    }

    public function index(){
        $commandes = User::find(Auth::user()->id)->commande()->get();
        return view('commande.index',compact('commandes'));
    }

    public function add(  $id){
        
        $commande = Commande::find($id);
        $cart = session('panier_' . Auth::user()->id);
         // 1 .vider le panier ou en créer un nouveau
        if (!$cart) {
            $this->initCart();
        }else{
            session(['panier_' . Auth::user()->id => []]);
        }

        // $cart = session('panier_' . Auth::user()->id);
       
        
        // 2.lier tous les produit de la commande au panier avec une quantité de un
        
        
        foreach ($commande->produit  as $produit){
            $item = [
                'id' => $produit->id,
                'price' => intval(str_replace(' ', '', $produit->prix)),
                'quantity' => 1,
                'option' => $produit,
            ];
            array_push($cart, $item);
        }
      
        session(['panier_' . Auth::user()->id => $cart]);
        // 3.retourne la vue panier
        // appeler la méthode getCartItemTotals pour récupérer le prix total (quantité * prix ) de chaque produit
        $itemTotals = $this->getCartItemTotals($cart);

        // appeler la méthode getCartTotal pour récupérer le prix total du panier
        $cartTotal = $this->getCartTotal($cart);

        // ajouter les éventuelles réduction
        $reduction = $this->promotion($cartTotal);
        $recommandation  = User::find(Auth::user()->id)->recommandation();

    return view('panier.index', ['cart' => $cart, 'itemTotals' => $itemTotals, 'reduction' => $reduction,'recommandation' => $recommandation]);
    }

}
