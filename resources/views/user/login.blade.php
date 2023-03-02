@extends('layout')
@section('content')

    <div class="container-fluid ">
        <div class="row h-screen">
            <div class="col-md-6 flex items-center justify-content-center flex-col">
                <h1 class="text-4xl">Connexion</h1>
                @include('Partials.message')
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <label for="email" class="label">Adresse email</label>
                    <input id="email" type="email" class="input input-bordered  @error('email') input-error @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    

                    <label for="password" class="label">Mot de passe</label>
                    <input id="password" type="password" class="input input-bordered @error('password') input-error @enderror"
                        name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <button type="submit" class="btn btn-outline my-3">
                        Connexion
                    </button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </form><br>
                <p class="text-center mt-3">Vous n'avez pas de compte ? <a href="{{ route('register') }}"
                        class="link">Inscrivez-vous</a></p>
            </div>
            <div class="col-md-6" style="background-image: url('https://shop.vlisco.com/media/catalog/category/VLS7728.012_BannerDesktop.jpg')">

            </div>
        </div>

    </div>
    @endsection