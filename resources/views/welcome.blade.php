@extends('layout')
@section('content')
    @include('Partials.header')
    @include('Partials.sidebar')

    <main>



        <!-- Marketing messaging and featurettes
                          ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container marketing mt-5">
            @include('Partials.message')
            <div class=" flex justify-center">
                {{-- search bar --}}
                <div class="rounded bg-base-200 w-1/2 md:w-1/3  p-0">
                    <form action="{{ route('index') }}" method="GET" class="flex justify-between bg-white">

                        <input
                            class="input focus:outline-none focus:border-none bg-none w-full max-w-xs text-accent-content placeholder-neutral"
                            type="text" name="s" placeholder="Rechercher..." />
                        <button type="submit"
                            class="btn btn-neutral rounded-none rounded-r-sm text-neutral-focus hover:text-neutral-content"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg></button>

                    </form>
                </div>





            </div>
            <!-- Three columns of text below the carousel -->
            
            @if (count($produits) == 0)
            <div class="text-center h-80 flex items-center justify-center">
                Aucun résultat :/
            </div>
            @else

            <div class="row my-5">

                @foreach ($produits as $p)
                    {{-- {{dd($p->avis())}} --}}
                    <?php
                    $obj = [
                        'user' => -1,
                        'produit' => $p,
                        'moyenne' => $p->moyenne(),
                        'commentaire' => [],
                    ];
                    foreach ($p->avis() as $avis) {
                        array_push($obj['commentaire'], ['avis' => $avis, 'user' => $avis->user()->get()]);
                    }
                    if (Auth::check()) {
                        $obj['user'] = Auth::user()->id;
                    }
                    ?>

                    <div class="col-lg-4 flex justify-center align-center">
                        <div class=" custom-card card card-compact w-72 bg-base-100 shadow-xl relative">
                            <figure><img src="{{ URL::to($p->photo) }}"  /></figure>
                            <div class="card-body ">
                                <div class="flex justify-between">
                                    <div>
                                        <h2 class="card-title">{{ $p->nom }}</h2>

                                        <span class="text-left">{{ number_format($p->prix, -1, ',', ' ') }} F CFA</span>
                                    </div>
                                    <div>

                                        <button class="btn btn-neutral rounded-none p-1" onclick='show({{ json_encode($obj) }})'>Voir article</button>
                                    </div>
                                </div>
                                

                            </div>
                            <div class="bg-neutral p-2 px-3  absolute -right-6 top-1/2">
                                <form action="{{ route('envie.toggleEnvie', ['produit' => $p]) }}" method="post">
                                    @csrf

                                    @if (Auth::check() &&
                                            Auth::user()->envie()->where('produit_id', $p->id)->exists())
                                        <button type="submit" class=" text-pink-600 ">
                                            <i class="bi bi-heart-fill" ></i>
                                        </button>
                                    @else
                                        <button type="submit" class="text-base-200 ">
                                            <i class="bi bi-heart"></i>
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </div>

                        
                    </div>
                    <!-- /.col-lg-4 -->
                @endforeach
            </div><!-- /.row -->


            <div class="flex justify-end">
                {{ $produits->links('custom.pagination') }}
            </div>

            @endif
        </div><!-- /.container -->


        <!-- FOOTER -->

        <div class="w-10 fixed right-3 bottom-20 bg-base-content text-base-200 p-2 flex justify-center"><a href="#"><i class="bi bi-arrow-up"></i></a></div>



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
                {{-- <button onclick="toggleComment()" id="toggleComment" class="btn btn-outline">
                    voir les commentaires
                </button> --}}




                <div id="info" class="md:p-5 ">
                    <h1 id="c-nom" class="e text-4xl p-1 aboreto-font">NOM</h1>
                    <h6 id="c-prix" class="e font-thin p-1">PRIX</h6>
                    <p id="c-desc" class="e p-1">description</p>
                    <div class="flex justify-around flex-col md:flex-row">
                        <form action="{{ route('panier.create') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" id="panier_produit_id">
                            <input type="hidden" name="price" id="panier_produit_price">
                            <button type="submit" class="my-5 e bg-none hover-underline-animation flex aboreto-font gap-1">
                                <i class="bi bi-basket mx-1"></i>ajout au panier 
                                
                            </button>
                        </form>
    
                        <div id='c-note' class="e my-5 hidden">
    
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

    </main>
    @include('Partials.footer')
@endsection
