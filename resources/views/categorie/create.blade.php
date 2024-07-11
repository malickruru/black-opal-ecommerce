@extends('layout')
@section('content')
    <x-auth-card-custom>

        <form method="POST" action="{{ route('categorie.store') }}" >
            @csrf
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajouter une catégorie
            </h2>
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
            </div>

            <div class="my-3 flex justify-center">
                <x-primary-button class="ml-4">
                    {{ __('Ajouter') }}
                </x-primary-button>
            </div>

                
            </div>
        </form>
    </x-auth-card-custom>
