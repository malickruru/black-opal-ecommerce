@extends('layout')
@section('content')
    @include('Partials.header')
    <div class="container mt-5">
        @include('Partials.message')
        <div class="row relative">
            <div class="col-md-8 ">
                <h1 class="text-4xl my-2">Mon panier</h1>
                <table class="table  w-full ">
                    <thead>
                        <tr>
                            <th table-striped scope="col">Image</th>
                            <td>Nom du produit</td>
                            <td>Quantité</td>

                            <th scope="col">Prix</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $product)
                            <tr>
                                <td>
                                    <img src="{{ URL::to($product['option']['photo']) }}" width="100px" alt="">
                                </td>
                                <td>
                                    {{ $product['option']['nom'] }}
                                </td>
                                <td>
                                    <form action="{{ route('panier.updateQuantity', ['id' => $product['id']]) }}"
                                        method="POST">
                                        @csrf
                                        <input type="number" name="newQuantity" min="1" class="input input-bordered"
                                            value="{{ $product['quantity'] }}">
                                        <button class="btn btn-secondary" title="mettre à jour la quantitée"><i
                                                class="bi bi-arrow-down-up"></i></button>
                                    </form>

                                </td>
                                <td>
                                    {{ number_format($itemTotals[$product['id']], 0, ',', ' ') }} F CFA
                                </td>
                                <td>
                                    <form action="{{ route('panier.remove', ['id' => $product['id']]) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-error" title="retirer du panier"><i
                                                class="bi bi-slash-circle"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <form action="{{ route('panier.clearCart') }}" method="POST">
                    @csrf

                    <button class="btn btn-active btn-error m-3" title="vider le panier"><i
                            class="bi bi-trash"></i></button>
                </form>

            </div>
            <div class="col-md-4 border-dashed border-2 border-neutral  right-0 bg-slate-50">
                <h1 class="text-2xl text-center m-2">Ma facture</h1>

                @foreach ($cart as $product)
                <div class="flex justify-between">
                    <span>
                        {{ $product['option']['nom'] }}
                    </span>
                    <span>
                        {{ number_format($itemTotals[$product['id']], 0, ',', ' ') }} F CFA
                    </span>
                </div>
                   
                    <div class="divider"></div>
                @endforeach
                @if (!$reduction['reduction'])
                <div class="flex justify-between">
                    <b>
                        Total
                    </b>
                    <b>
                        {{ number_format($reduction['total'], 0, ',', ' ') }} F CFA
                    </b>
                </div>
                @else
                    <b>
                        code de promotion
                    </b>
                    <br>
                    @foreach ($reduction['promo_utilise'] as $item)
                    <div class="flex justify-between mt-2">
                        <span class="text-success">
                            {{ $item->code->code }}
                        </span>
                        <span class="text-success">
                            10 %
                        </span>
                    </div>
                        <div class="divider"></div>
                    @endforeach
                    <div class="flex justify-between ">
                    <b>
                        total réduction
                    </b>
                    <span class="text-success">
                        - {{ $reduction['montant_reduction'] }} F CFA
                    </span>
                </div>
                    <div class="divider"></div>
                    <div class="flex justify-between">
                        <b>
                            Total
                        </b>
                        <b>
                            {{ number_format($reduction['total'], 0, ',', ' ') }} F CFA
                        </b>
                    </div>
                @endif
                <div class="center">
            
                    <form action="{{route('commande.create')}}" method="post">
                        @csrf
                        <div class="bg-success m-2">
                            <input type="submit" value="valider le paiement" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="divider"><h1 class='text-4xl'>Les utilisateurs aiment aussi</h1></div>
            

            <div class="flex mx-5 justify-around p-4">
                @foreach ($recommandation as $produit)
                    <?php
                    $obj = [
                        'user' => -1,
                        'produit' => $produit,
                        'moyenne' => $produit->moyenne(),
                        'commentaire' => [],
                    ];
                    foreach ($produit->avis() as $avis) {
                        array_push($obj['commentaire'], ['avis' => $avis, 'user' => $avis->user()->get()]);
                    }
                    if (Auth::check()) {
                        $obj['user'] = Auth::user()->id;
                    }
                    ?>

                    <div class="recommandation" onclick='show({{ json_encode($obj) }})'>
                        <img src="{{ URL::to($produit->photo) }}" width="200px" alt="">
                        <p class="text-xl text-center bold">{{ $produit->nom }}</p>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <div class="overlay">
        <div class="overlay__row"></div>
        <div class="overlay__row"></div>

    </div>
    <div class="content">
        <div class="oh c-img-container">
            <img src="" alt="" id="c-img">
        </div>

        {{-- info --}}
        <div class="right p-5">
            <button onclick="toggleComment()" id="toggleComment" class="btn btn-outline">
                voir les commentaires
            </button>




            <div id="info" class="p-5">
                <h1 id="c-nom" class="e text-4xl p-1 aboreto-font">NOM</h1>
                <h6 id="c-prix" class="e font-thin p-1">PRIX</h6>
                <p id="c-desc" class="e p-1">description</p>
                <div class="flex justify-around">
                    <form action="{{ route('panier.create') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="panier_produit_id">
                        <input type="hidden" name="price" id="panier_produit_price">
                        <input type="hidden" name="like" value="true">
                        <button type="submit" class="my-5 e bg-none hover-underline-animation flex aboreto-font">
                            ajout au panier &nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cart4" viewBox="0 0 16 16">
                                <path
                                    d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                            </svg>
                        </button>
                    </form>

                    <div id='c-note' class="e my-5">

                    </div>
                </div>
                


                <button class="my-2 e bg-none " onclick="closeShow()">
                    <i class="bi bi-arrow-left-square exit"></i> </button>
            </div>


            <div id='comment' class="d-none">
                <div id="comment_header" class="flex justify-between p-3">
                    <h1 class="text-4xl p-1 aboreto-font">commentaires</h1>
                    <div id="comment-header-right">
                        
                    </div>
                </div>
                
                <div id="fils">

                </div>
            </div>

        </div>


    </div>
@endsection
