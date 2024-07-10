@extends('layout')
@section('content')
    <x-auth-card-custom>

        
        <form method="POST" action="{{ route('categorie.update',$categorie) }}" >
            @csrf
                @method('PUT')
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ isset($categorie->name) ? $categorie->name : old('name') }}"  />
            </div>

            <div>
                <x-input-label for="active" :value="__('Visible pour les clients ?')" />
                <x-text-input id="active" class="block mt-1 w-full" type="checkbox" name="active" value="{{ isset($categorie->active) ? $categorie->active : old('active') }}"  /> (Cocher si oui)
            </div>

            <div class="my-3 flex justify-center">
                <x-primary-button class="ml-4">
                    {{ __('Modifier') }}
                </x-primary-button>
            </div>

                
            </div>
        </form>

    </x-auth-card-custom>
