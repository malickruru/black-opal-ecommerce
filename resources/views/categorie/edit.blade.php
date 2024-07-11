@extends('layout')
@section('content')
    <x-auth-card-custom>

        
        <form method="POST" action="{{ route('categorie.update',$categorie) }}" >
            @csrf
                @method('PUT')
            <!-- Name -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Modifier un produit
            </h2>
            <div>
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ isset($categorie->nom) ? $categorie->nom : old('nom') }}"  />
            </div>

            <div>
                <x-input-label for="active" :value="__('Visible pour les clients ?')" />
                <label>
                    <input type="radio" name="active" @checked($categorie->active == 1) value="1">
                    Oui
                </label>
                <label>
                    <input type="radio" name="active" value="0"  @checked($categorie->active == 0)>
                    Non
                </label>
            </div>

            <div class="my-3 flex justify-center">
                <x-primary-button class="ml-4">
                    {{ __('Modifier') }}
                </x-primary-button>
            </div>

                
            </div>
        </form>

    </x-auth-card-custom>
