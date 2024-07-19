<?php 

$sort='id';
$order=0;
$i = 1;
$search ="";
$array=$categorie->sortBy($sort,SORT_REGULAR,$order);



	if(isset($_GET['sort'])){
		$sort=$_GET['sort'];
		$order=$_GET['order'];
		$array=$categorie->sortBy($sort,SORT_REGULAR,$order);
	}

	if(isset($_GET['search'])){
		$search = $_GET['search'];
		$array=[];
		foreach ($categorie as $key ) {
			if(strpos(strtolower($key->nom), strtolower($search) ) !== false){
				array_push($array,$key);
			}
		}
		
	}

function Toggleorder($order){
	if($order == 1){
		return 0;
	}
	return 1;
}


?>

@extends('layout')
@section('content')
	@include('Partials.header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Catégories de produits
        </h2>
    
    
    <div class="container ">
    <p class="my-3">
		<!-- Lien pour créer un nouvel article : "categorie.create" -->
        <x-custom-button :bgcolor="'cyan'" >
            <a href="{{ route('categorie.create') }}" >Créer une nouvelle catégorie +</a>
        </x-custom-button>
        <div class=" w-2/5 my-5 m-auto">
			<x-search-bar placeholder="rechercher une catégorie" val={{$search}} > </x-search-bar>
		</div>
	
    </p>

	<!-- Le tableau pour lister les articles/categorie -->
	<table  class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
		<thead class="text-xs text-gray-700 uppercase bg-gray-100 ">
			<tr>
				<th class="py-3 px-6 border-r " >
					<div class="flex items-center">
						ID
					<a href="?sort=id&order={{Toggleorder($order)}}">
						@include('svg.sorted')
					</a>
					</div>
					
				</th>
				<th class="py-3 px-6 border-r " >
					<div class="flex items-center">
						Nom
					<a href="?sort=nom&order={{Toggleorder($order)}}">
						@include('svg.sorted')
					</a>
					</div>
					
				</th>
                <th class="py-3 px-6 border-r " >
					<div class="flex items-center">
						visible pour les clients
					
					</div>
					
				</th>
				<th class="py-3 px-6" colspan="2" >Opérations</th>
			</tr>
		</thead>
		<tbody>
           
			<!-- On parcourt la collection de item -->
			@foreach ($array  as $item)
				<?php 
				if ($i % 2 == 0) {
					echo '<tr class="bg-gray-100 border-b ">';
				}else{
					echo '<tr class="bg-white border-b ">';
				}
				?>

			
				{{-- <td>
					<!-- Lien pour afficher un item : "categorie.show" -->
					<a href="{{ route('categorie.show', $item) }}" title="Lire l'article" >{{ $item->title }}</a>
				</td> --}}
				<td class="py-4 px-6 border-r">
                    {{$item->id}}
                </td>
                <td class="py-4 px-6 border-r">
                    {{$item->nom}}
                </td>
                <td class="py-4 px-6 border-r">
                    {{$item->active== 1 ? 'oui' : 'non'}}
                </td>
				<td class="py-4 px-6 border-r">
					<!-- Lien pour modifier un item : "categorie.edit" -->
					<a class="underline text-blue-500" href="{{ route('categorie.edit', $item) }}" title="Modifier la categorie" >Modifier</a>
				</td>
				<td class="py-4 px-6">
					<!-- Formulaire pour supprimer un Post : "categorie.destroy" -->
					<a class="underline text-red-500" href="{{ route('categorie.delete', $item) }}" title="Supprimer la catégorie" >Supprimer</a>
				</td>
			</tr>
			<?php $i++ ?>
			@endforeach
		</tbody>
	</table>
    </div>
	
@endsection
