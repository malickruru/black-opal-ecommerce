
@extends('layout')
@section('content')

    {{-- {{dd($success)}} --}}
    @include('Partials.header');
    <div class="container">
        @include('Partials.message')
    </div>
    <div class="container center  h-screen">
    <div class="card w-96 bg-neutral text-neutral-content">
        <div class="card-body items-center text-center">
            <h2 class="card-title">Changez mot de passe</h2>
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nom">Ancien mot de passe</label>
                    <input type="password" class="input input-bordered text-primary-content " id="nom" name="old_password">
                </div>
                <div class="form-group">
                    <label for="password">Nouveau mot de passe:</label>
                    <input type="password" id="password" name="password" class="input input-bordered text-primary-content " required>
                    
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirmez votre nouveau mot de passe</label>
                    <input id="password-confirm" type="password" class="input input-bordered text-primary-content "
                        name="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-outline mt-3">Valider</button>
            </form>
        </div>
    </div>
</div>
    @include('Partials.footer')
@endsection


