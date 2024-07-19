@extends('layout')
@section('content')
<x-auth-card-custom>
    <div class="container ">
        
        <h3 class="text-center font-semibold text-xl text-gray-800 leading-tight">
            Etes vous sur de vouloir supprimer la catégorie : {{$article ->id}} , {{$article ->nom}}
        </h3>
    <p class="flex justify-center" > <em flex justify-center >Cette action est irréversible</em></p>
        
        <div class="flex justify-center m-5 ">
            <form method="POST" action="{{ route('article.destroy', $article) }}">
                <!-- CSRF token -->
                @csrf
                <!-- <input type="hidden" name="_method" value="DELETE"> -->
                @method("DELETE")
                <input class="cursor-pointer bg-error text-white py-1 px-3 mx-3 rounded" type="submit" value="Oui" >
            </form>
            <a class="py-1 bg-secondary px-3 mx-3" href="{{ route('article.index') }}">Non</a>
        </div>
        
    </div>
</x-auth-card-custom>