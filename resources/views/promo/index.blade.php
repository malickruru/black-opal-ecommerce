@extends('layout')
@section('content')
    @include('Partials.header');

    <div class="container mb-3">
        @include('Partials.message')

        <h1 class="text-center text-4xl">Vos promotions disponibles </h1>

        <div class="center h-96 flex-col">
            @if ($promos->count() == 0)
                <p class="text-xl m-1"><i class="bi bi-emoji-frown"></i> vous n'avez aucune promotion</p>
                
            @else
                @foreach ($promos as $p)
                    <p class="text-xl m-1 ">{{ $p->code->code }} ..... -10%</p>
                    <div class="divider"></div> 
                @endforeach
            @endif
        </div>

        <div class="rounded bg-base-200 w-1/3 p-0 m-auto">
            <form method="POST" action="{{ route('promo.create') }}" class="flex justify-between">
                @csrf
              
                    <input type="text" name="code" placeholder="ajouter le code promos" class="input focus:outline-none bg-none w-full max-w-xs text-accent-content placeholder-neutral-content">
                    <button type="submit" class="btn bg-none rounded-none rounded-r-sm text-neutral-focus hover:text-neutral-content">Envoyer</button>
            </form>
        </div>

    </div>
    @include('Partials.footer')
@endsection
