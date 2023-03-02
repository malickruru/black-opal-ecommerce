@extends('layout')
@section('content')
    @include('Partials.header');

    <div class="container">
        @include('Partials.message')
        <h1 class="text-4xl text-center">Ma liste d'envie</h1>
        @if ($produits->count() == 0)
        <p><i class="bi bi-emoji-frown"></i> c'est vide ici</p>
        @endif

        @foreach ($produits as $item)
        <div class="d-flex justify-content-around align-items-center">

        
            <img src="{{ URL::to($item->photo) }}" width="100px" alt="">
            <p>{{ $item->nom }}</p>
            <form action="{{route('panier.create')}}" method="post">
                @csrf
                <input type="hidden" name="id" id="panier_produit_id" value="{{$item->id}}">
                <input type="hidden" name="price" id="panier_produit_price" value="{{$item->prix}}">
                <button type="submit" class="btn btn-outline flex">
                    ajout au panier &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-cart4" viewBox="0 0 16 16">
                        <path
                            d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                    </svg>
                </button>
            </form>
            <form action="{{route('envie.toggleEnvie',['produit' => $item])}}" method="post">
                @csrf
                
                <div class="bg-error rounded">
                    <button type="submit" class="btn btn-error">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                
                
            
            </form>
        </div>
            <hr>
        @endforeach
    </div>
    @include('Partials.footer')
    @endsection
