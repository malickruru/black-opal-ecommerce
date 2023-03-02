<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkLogin', ['only' => ['show', 'showChangePasswordForm', 'showUpdatePhoto']]);
    }

    public function showRegistrationForm()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Inscription réussie ! Veuillez vous connecter.');
    }


    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // dd(Auth::user());
            return redirect()->intended()->with('success', 'Connexion réussie !');
        }

        return redirect()->back()->with('error', 'Adresse email ou mot de passe incorrect.')->withInput();
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('index')->with('success', 'Déconnexion réussie !');
    }

    // profil

    public function show()
    {

        return view('user.profil');
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->numero = $request->numero;
        $user->adresse = $request->adresse;
        $user->save();
        return redirect()->back()->with('success', 'Votre profil a été mis à jour avec succès');
    }


    // methode pour afficher la vue pour changer le mot de passe
    public function showChangePasswordForm()
    {

        return view('user.password');
    }

    public function changePassword(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'confirmed']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'les mots de passe ne corresponde pas');
        }

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return redirect()->back()->with('error', 'ancien mot de passe incorect');
        }


        // Récupération de l'user connecté
        $user = User::find(Auth::user()->id);

        // Mise à jour du mot de passe
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Votre mot de passe a été mis à jour avec succès');
    }


    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::find(Auth::user()->id);

        // supprimer l'image précédente 
        if ($user->photo != null) {
            $file = public_path() . '/images/users/' . $user->photo;
            if (file_exists($file)) {
                unlink($file);
            }
        }

        $photo = $request->file('photo');
        $filename = time() . '.' . $photo->getClientOriginalExtension();
        $path = $photo->storeAs('public/users', $filename);

        $user->photo = '/images/users/'.$filename;
        $user->save();

        return redirect()->back()->with('success', 'Photo de profil mise à jour avec succès !');
    }

    public function showUpdatePhoto()
    {

        return view('user.update_photo');
    }
}
