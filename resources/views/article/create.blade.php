@extends('layout')
@section('content')
    <x-auth-card-custom>

        <form method="POST" action="{{ route('article.store') }}" enctype="multipart/form-data"  >
            @csrf
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajouter un produit
            </h2>
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required  />
               
            </div>
             <!-- categorie_id -->
             <div>
                <x-input-label for="name" :value="__('Categorie')" />
                <select id="categorie" name="categorie_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 ">
                    <option selected>Choisir une categorie</option>
                    @foreach ($categorie as $cat)
                        <option value={{$cat ->id }}>{{$cat ->nom }}</option>
                    @endforeach
                  </select>
               
            </div>
             <!-- content -->
             <div>
                <x-input-label for="content" :value="__('Description')" />
                <textarea name="content" id="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 " placeholder="Description de l'article..."></textarea>

            </div>
             <!-- price -->
             <div>
                <x-input-label for="price" :value="__('Prix')" />
                <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" required  />
               
            </div>
             <!-- is dicount -->
             {{-- <div>
                <x-input-label for="name" :value="__('Le produit est il en promo ?')" />
               
            <div class="flex items-center mb-4">
                <input id="default-radio-1" type="radio" value=1 name="is_discount" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 ">
                <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 ">OUI</label>
            </div>
            <div class="flex items-center">
                <input checked id="default-radio-2" type="radio" value=0 name="is_discount" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 ">
                <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 ">NON</label>
            </div>

               
            </div> --}}
             <!-- discount -->
            
             <!-- Stock -->
             <div>
                <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo"   />
               
            </div>
            <div class="my-3 flex justify-center">
                <x-primary-button class="ml-4">
                    {{ __('Ajouter') }}
                </x-primary-button>
            </div>

                
            </div>
        </form>
    </x-auth-card-custom>
    @endsection