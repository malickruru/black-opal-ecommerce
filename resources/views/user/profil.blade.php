@extends('layout')
@section('content')

    {{-- {{dd($success)}} --}}
    @include('Partials.header');
    <div class="container">
        @include('Partials.message')
    </div>
    <div class="container center-start mb-3">
        
        
        <ul class="menu bg-neutral w-56 text-neutral-content ">
            <li class="hover-bordered"><a href="{{ route('password') }}">Mettre à jour votre mot de passe</a></li>
            <li class="hover-bordered"><a href="{{ route('photo') }}">Mettre à jour votre photo de profil</a></li>
          </ul>
    <div class="card w-96 bg-neutral text-neutral-content rounded-none rounded-b-lg rounded-tr-lg">
        
        <div class="card-body items-center text-center">
            <h2 class="card-title">Modifier votre profil</h2>
            
            <form action="{{ route('profil.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nom">Nom</label><br>
                    <input type="text" class="input input-bordered text-primary-content" id="nom" name="nom"
                        value="{{ auth()->user()->nom }}">
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom</label><br>
                    <input type="text" class="input input-bordered text-primary-content" id="prenom" name="prenom"
                        value="{{ auth()->user()->prenom }}">
                </div>

                <div class="form-group">
                    <label for="numero">Numéro</label><br>
                    <input type="text" class="input input-bordered text-primary-content" id="numero" name="numero"
                        value="{{ auth()->user()->numero }}">
                </div>

                <div class="form-group">
                    <label for="adresse">Adresse</label><br>
                    <textarea class="textarea textarea-bordered text-primary-content" id="adresse" name="adresse">{{ auth()->user()->adresse }}</textarea>
                </div>

                <button type="submit" class="btn btn-outline">Mettre à jour</button>
            </form>


        </div>
    </div>
</div>
@include('Partials.footer')
@endsection
