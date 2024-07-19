@extends('layout')
@section('content')

    <div class="container-fluid ">
        <div class="row h-screen">
            <div class="col-md-6 flex items-center justify-content-center flex-col">
                <h1 class="text-4xl">Inscription</h1>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group mt-2">
                        <label for="nom">Nom:</label><br>
                        <input type="text" id="nom" name="nom" class="input input-bordered text-primary-content "
                            required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom:</label><br>
                        <input type="text" id="prenom" name="prenom"
                            class="input input-bordered text-primary-content" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label><br>
                        <input type="email" id="email" name="email"
                            class="input input-bordered text-primary-content" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe:</label><br>
                        <input type="password" id="password" name="password"
                            class="input input-bordered text-primary-content" required>

                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Confirmez votre mot de passe</label><br>
                        <input id="password-confirm" type="password" class="input input-bordered text-primary-content"
                            name="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-outline my-3">S'inscrire</button>
                </form>

            </div>
            <div class="col-md-6" style="background-image: url('images/motif3.jpeg') ; background-size : cover">

            </div>
        </div>

    </div>
    @endsection
