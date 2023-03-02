@extends('layout')
@section('content')
    @include('Partials.header');
 
    <div class="container">
        <h1 class="text-4xl text-center my-3">Donner votre avis sur {{$produit->nom}}</h1>
        <div class="row mb-3">
            <div class="col-md-6">
                <img src="{{ URL::to($produit->photo) }}" width="300px" alt="">
            </div>
            <div class="col-md-6">
                <form method="POST" action="{{ route('avis.create') }}">
                    @csrf
                    <input type="hidden" name="produit_id" value="{{$produit->id}}">
                    <div class="form-group">
                        <label for="note">Votre note:</label>
                            <div class="rating rating-md">
                                <input type="radio" name="note" class="mask mask-star-2 " value="1" checked/>
                                <input type="radio" name="note" class="mask mask-star-2 " value="2"/>
                                <input type="radio" name="note" class="mask mask-star-2 " value="3"/>
                                <input type="radio" name="note" class="mask mask-star-2 " value="4"/>
                                <input type="radio" name="note" class="mask mask-star-2 " value="5"/>
                              </div>
                    </div>
                    <div class="form-group">
                        <label for="commentaire">Commentaire:</label><br>
                        <textarea name="commentaire" id="commentaire" class="textarea textarea-bordered m-2" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline m-3 ">Enregistrer</button>
                </form>
            </div>
        </div>

       
    </div>
@endsection
