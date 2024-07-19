@extends('layout')
@section('content')
    @include('Partials.header')
    {{-- @include('Partials.sidebar') --}}

    <main>



        <!-- Marketing messaging and featurettes
                        ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container marketing mt-5 min-h-screen">
            @include('Partials.message')
            <div class="row flex justify-center ">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Tableau de bord
                </h2>
            </div>

            <div class="row flex gap-2 p-5 " >
                <a class="card bg-neutral-100 w-96 shadow-xl cursor-pointer block" href="{{ route('categorie.index') }}">
                    <div class="card-body">
                    <h2 class="card-title text-center">Catégories</h2>
                    </div>
                </a>

                <a class="card bg-neutral-100 w-96 shadow-xl cursor-pointer block" href="{{ route('article.index') }}">
                    <div class="card-body">
                    <h2 class="card-title text-center">Produits</h2>
                    </div>
                </a>

                {{-- <div class="card bg-neutral-100 w-96 shadow-xl cursor-pointer">
                    <div class="card-body">
                    <h2 class="card-title text-center">Clients</h2>
                    </div>
                </div> --}}


            </div>

        </div><!-- /.container -->


    </main>
    @include('Partials.footer')
@endsection

