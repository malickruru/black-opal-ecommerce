<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    { 
            //On récupère tous les Article
        $article = User::Where('isAdmin' , 0)->paginate(20);

        // On transmet les article à la vue
        return view("customer.index", compact("customer"));
    } 
}
