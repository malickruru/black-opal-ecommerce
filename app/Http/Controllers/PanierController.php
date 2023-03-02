<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanierController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkLogin', ['only' => ['addToCart','removeFromCart','showCart','updateQuantity','clearCart']]);
    }
    
    public function initCart()
    {
        session(['panier_' . Auth::user()->id => []]);
    }

    public function showCart()
    {
        $cart = session('panier_' . Auth::user()->id);

        if (!$cart) {
            $cart = [];
        }
        // appeler la méthode getCartItemTotals pour récupérer le prix total (quantité * prix ) de chaque produit
        $itemTotals = $this->getCartItemTotals($cart);

        // appeler la méthode getCartTotal pour récupérer le prix total du panier
        $cartTotal = $this->getCartTotal($cart);

        // ajouter les éventuelles réduction
        $reduction = $this->promotion($cartTotal);

        $recommandation  = User::find(Auth::user()->id)->recommandation();

    return view('panier.index', ['cart' => $cart, 'itemTotals' => $itemTotals, 'reduction' => $reduction,'recommandation' => $recommandation]);
}

    public function getCartItemTotals($cart)
    {
        $itemTotals = [];

        foreach ($cart as $item) {
            $itemTotals[$item['id']] = $item['quantity'] * $item['price'];
        }

        return $itemTotals;
    }


    public function getCartTotal($cart)
    {
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['price'];
        }

        return $total;
    }

    public function promotion($total)
    {
        $count = User::find(Auth::user()->id)->lienPromo()->where('active', 1)->limit(9)->count();
        $promo_utilise = User::find(Auth::user()->id)->lienPromo()->where('active', 1)->limit(9)->get() ;
        if($count == 0){
            return ["reduction"=>false,"total" => $total];
        }

        $reduction_pourcentage = 0.1*$count;

        $total_apres_reduction = $total - ($total * $reduction_pourcentage);

        return ["reduction"=>true,"promo_utilise"=>$promo_utilise,"pourcentage" => $reduction_pourcentage,"montant_reduction" => ($total * $reduction_pourcentage),"total" => $total_apres_reduction];
    }


    public function addToCart(Request $request)
    {
       $id = $request->id;
       $price = intval(str_replace(' ', '', $request->price));
       $quantity = 1;

        if (!session('panier_' . Auth::user()->id)) {
            $this->initCart();
        }

        $cart = session('panier_' . Auth::user()->id);
        $itemIndex = -1;

        // Vérifier si le produit est déjà présent dans le panier
        foreach ($cart as $index => $item) {
            if ($item['id'] == $id) {
                $itemIndex = $index;
                break;
            }
        }

        // Si le produit est déjà présent dans le panier, incrémenter la quantité
        if ($itemIndex != -1) {
            $cart[$itemIndex]['quantity'] += $quantity;
        }
        // Sinon, ajouter le produit au panier
        else {
            if ($request->like) {
                User::find(Auth::user()->id)->envie()->toggle($id);
            }
            $item = [
                'id' => $id,
                'price' => $price,
                'quantity' => $quantity,
                'option' => Produit::find($id),
            ];
            array_push($cart, $item);
        }

        session(['panier_' . Auth::user()->id => $cart]);

        return redirect()->back()->with('success', 'Le produit a été ajouté au panier.');
    }
    
    public function removeFromCart($id)
    {
        $cart = session('panier_' . Auth::user()->id);

        // Vérifier si le produit est présent dans le panier
        foreach ($cart as $index => $item) {
            if ($item['id'] == $id) {
                unset($cart[$index]);
                break;
            }
        }

        session(['panier_' . Auth::user()->id => $cart]);

        return redirect()->back()->with('error', 'Le produit a été retiré du panier.');
    }

    // modifier la quantité
    public function updateQuantity($id, Request $request)
    {

        $cart = session('panier_' . Auth::user()->id);

        // Rechercher l'élément correspondant à l'id du produit
        foreach ($cart as $index => $item) {
            if ($item['id'] == $id) {
                $cart[$index]['quantity'] = $request->newQuantity;
                break;
            }
        }

        session(['panier_' . Auth::user()->id => $cart]);

        return redirect()->back()->with('success', 'La quantité du produit a été mise à jour.');
    }

    

    // effacer tous le panier

    public function clearCart()
    {
        session(['panier_' . Auth::user()->id => []]);

        return redirect()->back()->with('error', 'Le panier a été vidé.');
    }

}
