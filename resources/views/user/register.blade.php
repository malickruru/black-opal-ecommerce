@extends('layout')
@section('content')
    {{-- {{dd( $errors )}} --}}
    {{-- {{dd( $errors->first('password') )}} --}}
    <div class="container center h-screen">
        <div class="card w-96 bg-neutral text-neutral-content">
            <div class="card-body items-center text-center">
                <h2 class="card-title">Inscription</h2>
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
        </div>
    </div>
    </div>
@endsection
