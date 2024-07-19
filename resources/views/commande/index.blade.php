@extends('layout')
@section('content')
    @include('Partials.header');

    <div class=" mx-7">
        <h1 class="text-4xl text-center">Historique de mes commandes</h1>
        @foreach ($commandes as $item)
            <div class="flex">
                <div>
                    <p>
                        <b>Id commande :</b> {{ $item->id }}
                    </p>
                    <p>
                        <b>Prix total de la commande : </b> {{ number_format($item->total, 0, ',', ' ') }} F CFA
                    </p>
                    <p>
                        <b>date :</b> {{ $item->created_at }}
                    </p>
                    <b>Vous aviez commandé les produits suivants :</b>
                    <div class="d-flex ">
                        @foreach ($item->produit as $produit)
                            <div class="m-4">
                                <img src="{{ URL::to($produit->photo) }}" width="100px" alt="">
                                <p>{{ $produit->nom }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
    
                <form action="{{ route('commande.add', ['id' => $item->id]) }}" method="post" class="center w-72">
                    @csrf
                    <div class="bg-success">
                        <input value="recommander" class=" btn btn-success "  type="submit">
                    </div>
                </form>
            </div>
            <div class=" divider divider-neutral"></div>
        @endforeach
    </div>
    @include('Partials.footer')
@endsection
