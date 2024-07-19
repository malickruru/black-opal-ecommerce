@extends('layout')
@section('content')
    <x-auth-card-custom>

        <form method="POST" action="{{ route('article.update',$article) }}" enctype="multipart/form-data" >
            @csrf
                @method('PUT')
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"  value="{{ isset($article->nom) ? $article->nom : old('nom') }}"  />
               
            </div>
             <!-- categorie_id -->
             <div>
                <x-input-label for="name" :value="__('Categorie')" />
                <select id="categorie" name="categorie_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 ">
                    <option selected>Choisir une categorie</option>
                    @foreach ($categorie as $cat)
                        <option {{$cat ->nom == $article->categorie->nom ? 'selected' : ''}} value={{$cat ->id }}>{{$cat ->nom }}</option>
                    @endforeach
                  </select>
               
            </div>
             <!-- content -->
             <div>
                <x-input-label for="content" :value="__('Description')" />
                <textarea name="content" id="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 " placeholder="Description de l'article..." >{{ isset($article->description) ? $article->description : old('description') }}</textarea>

            </div>
             <!-- price -->
             <div>
                <x-input-label for="price" :value="__('Prix')" />
                <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" value="{{ isset($article->prix) ? $article->prix : old('prix') }}"  />
               
            </div>

            <div>
                <x-input-label for="name" :value="__('Modifier l\'image ?')" />
               
            <div class="flex items-center mb-4">
                <input id="default-radio-1" onclick="toggleImg(1)" type="radio" value=1 name="isNewImage" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 ">
                <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 ">OUI</label>
            </div>
            <div class="flex items-center">
                <input checked id="default-radio-2" onclick="toggleImg(0)" type="radio" value=0 name="isNewImage" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 ">
                <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 ">NON</label>
            </div>

            <div id='updateImg' style="display: none">
                <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo"   />
            </div>
            <div id="prevImg" >
                <img src="{{ URL::to($article->photo) }}" alt="" srcset="">
            </div>


            <div>
                <x-input-label for="active" :value="__('Visible pour les clients ?')" />
                <label>
                    <input type="radio" name="active" @checked($article->active == 1) value="1">
                    Oui
                </label>
                <label>
                    <input type="radio" name="active" value="0"  @checked($article->active == 0)>
                    Non
                </label>
            </div>

               
            </div>
        

                
            <div class="my-3 flex justify-center">
                <x-primary-button class="ml-4">
                    {{ __('Modifier') }}
                </x-primary-button>
            </div>

                
            </div>
        </form>

        <script>
            function toggleImg(v){
                if (v) {
                    document.getElementById('updateImg').style.display = "";
                    document.getElementById('prevImg').style.display = "none";
                }else{
                    document.getElementById('updateImg').style.display = "none";
                    document.getElementById('prevImg').style.display = "";
                }
            }
          
        </script>

    </x-auth-card-custom>
@endsection