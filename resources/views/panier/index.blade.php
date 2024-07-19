@extends('layout')
@section('content')
    @include('Partials.header')
    <div class=" mt-5 mx-7">
        @include('Partials.message')
        <div class="grid grid-flow-row grid-cols-1 md:grid-cols-3 gap-4 relative">
            <div class="md:col-span-2 row-span-3 ">
                <h1 class="text-4xl my-2">Mon panier</h1>
                <table class="table  w-full ">
                    <thead class="desktop-only ">
                        <tr>
                            <th table-striped scope="col">Image</th>
                            <td>Nom du produit</td>
                            <td>Quantité</td>

                            <th scope="col">Prix</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $product)
                            <tr class="desktop-only">
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
                                        <button class="btn btn-secondary text-white" title="mettre à jour la quantitée"><i
                                                class="bi bi-arrow-down-up"></i></button>
                                    </form>

                                </td>
                                <td>
                                    {{ number_format($itemTotals[$product['id']], 0, ',', ' ') }} F CFA
                                </td>
                                <td>
                                    <form action="{{ route('panier.remove', ['id' => $product['id']]) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-error text-white" title="retirer du panier"><i
                                                class="bi bi-slash-circle"></i></button>
                                    </form>
                                </td>
                            </tr>

                            <div  class="card bg-base-100  shadow-xl md:hidden relative">
                                <figure class=" max-h-32">
                                  <img
                                    src="{{ URL::to($product['option']['photo']) }}"
                                   />
                                </figure>
                                <div class="card-body">
                                  <h2 class="card-title">{{ $product['option']['nom'] }}</h2>
                                  <p>
                                    <span>
                                        {{ number_format($itemTotals[$product['id']], 0, ',', ' ') }} F CFA
                                    </span>
                                    <form action="{{ route('panier.updateQuantity', ['id' => $product['id']]) }}"
                                        method="POST">
                                        @csrf
                                        <input type="number" name="newQuantity" min="1" class="input input-bordered"
                                            value="{{ $product['quantity'] }}">
                                        <button class="btn btn-secondary text-white" title="mettre à jour la quantitée"><i
                                                class="bi bi-arrow-down-up"></i></button>
                                    </form></p>
                                  <div class="card-actions absolute top-2 right-2 justify-end">
                                    <form action="{{ route('panier.remove', ['id' => $product['id']]) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-error text-white" title="retirer du panier"><i
                                                class="bi bi-slash-circle"></i></button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                        @endforeach

                    </tbody>
                </table>
                <form action="{{ route('panier.clearCart') }}" method="POST">
                    @csrf

                    <button class="btn btn-active btn-error m-3" title="vider le panier"><i
                            class="bi bi-trash"></i></button>
                </form>

            </div>
            <div class="md:col-span-1 row-span-1 border-dashed border-2 border-neutral p-3 right-0 bg-slate-50">
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
                   
                    <div class="divider divider-neutral"></div>
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
                            <input type="submit" value="valider le paiement" class="btn btn-success text-white">
                        </div>
                    </form>
                </div>
            </div>
        </div>
       
    </div>
   
@endsection
