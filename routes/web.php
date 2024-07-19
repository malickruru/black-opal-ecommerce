<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CodePromoController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\EnvieController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\UserController;
use App\Models\Avis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// produit
Route::get('/', [ProduitController::class, 'index'])->name('index') ;
Route::get('/categorie/{id}', [ProduitController::class, 'categorie'])->name('categorie');

// utilisateur
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register',[UserController::class, 'register'] );
Route::get('/login',[UserController::class, 'showLoginForm'] )->name('login');
Route::post('/login',[UserController::class, 'login'] );

Route::middleware('auth')->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/profil', [UserController::class, 'show'])->name('profil');
    Route::post('/profil', [UserController::class, 'update'])->name('profil.update');
    Route::get('/update_password', [UserController::class, 'showChangePasswordForm'])->name('password');
    Route::post('/update_password', [UserController::class, 'changePassword'])->name('password.update');
    Route::get('/update_photo', [UserController::class, 'showUpdatePhoto'])->name('photo');
    Route::post('/update_photo', [UserController::class, 'updatePhoto'])->name('photo.update');


    // avis
    Route::post('/ajout_commentaire', [AvisController::class, 'create'])->name('avis.create');
    Route::get('/ajout_commentaire/{id}', [AvisController::class, 'showFormAvis'])->name('avis.edit');

    // code promo
    Route::post('/ajout_code_promo', [CodePromoController::class, 'create'])->name('promo.create');
    Route::get('/mes_promotions', [CodePromoController::class, 'index'])->name('promo.index');

    // panier
    Route::post('/ajout_panier', [PanierController::class, 'addToCart'])->name('panier.create');
    Route::post('/retrait_panier/{id}', [PanierController::class, 'removeFromCart'])->name('panier.remove');
    Route::get('/panier', [PanierController::class, 'showCart'])->name('panier.index');
    Route::post('/modification_quantite/{id}', [PanierController::class, 'updateQuantity'])->name('panier.updateQuantity');
    Route::post('/supprimer_panier', [PanierController::class, 'clearCart'])->name('panier.clearCart');


    // liste d'envie
    Route::post('/toggle_envie/{produit}', [EnvieController::class, 'toggleEnvie'])->name('envie.toggleEnvie');
    Route::get('/liste_envie', [EnvieController::class, 'index'])->name('envie.index');

    // commandes
    Route::get('/valider_paiement', [CommandeController::class, 'showCreateForm'])->name('commande.showCreateForm'); 
    Route::post('/valider_paiement', [CommandeController::class, 'create'])->name('commande.create');
    Route::get('/mes_commandes', [CommandeController::class, 'index'])->name('commande.index');
    Route::post('/recommander/{id}', [CommandeController::class, 'add'])->name('commande.add');
});

Route::middleware('admin')->group(function () {
    Route::get('/administration', [AdminController::class,'adminPanel'])-> name('admin.panel');
    // categorie
    Route::resource("administration/categorie", CategorieController::class);
    Route::get('administration/categorie/{categorie}/delete', [CategorieController::class, 'delete'])->name('categorie.delete');


    // crud produit
    Route::resource("administration/article", ArticleController::class);
    Route::get('administration/article/{article}/delete', [ArticleController::class, 'delete'])->name('article.delete');

    // Route::get("administration/article/{article}/add_image", [ArticleController::class,'add_image'])->name('article_img.add') ;
// Route::post("administration/article/{article}/add_image", [ArticleController::class,'add_image_create'])->name('article_img.create') ;
// Route::delete("administration/article/destroy_image/{article}", [ArticleController::class,'destroy_image'])->name('article_img.destroy') ;
});





