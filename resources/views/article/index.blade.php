<?php 
/*		funtionalité 
	-voire les articles (name,categorie,price,stock)
	-recherche par name
	-tri

*/


$sort='id';
$order=0;
$i = 1;
$search ="";
$array=$article->sortBy($sort,SORT_REGULAR,$order);



	if(isset($_GET['sort'])){
		$sort=$_GET['sort'];
		$order=$_GET['order'];
		$array=$article->sortBy($sort,SORT_REGULAR,$order);
	}

	if(isset($_GET['s'])){
		$search = $_GET['s'];
		// $array=[];
		// foreach ($article as $key ) {
		// 	if(strpos($key->nom, $search) !== false){
		// 		array_push($array,$key);
		// 	}
		// }
		
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
<div class="container">


        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Vos produits
        </h2>
   
    
    <div class="container ">
    <p class="my-3">
		<!-- Lien pour créer un nouvel article : "categorie.create" -->
        <x-custom-button :bgcolor="'cyan'" >
            <a href="{{ route('article.create') }}" >Créer un nouvel article +</a>
        </x-custom-button>
        <div class=" w-2/5 my-5 m-auto">
			<x-search-bar placeholder="rechercher un article" val={{$search}} > </x-search-bar>
		</div>
	
    </p>

	<!-- Le tableau pour lister les articles/categorie -->
	<table  class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
		<thead class="text-xs text-gray-700 uppercase bg-gray-100 ">
			<tr>
				{{-- show --}}
				{{-- <th class="py-3 px-6 border-r " >
								
				</th> --}}
				{{-- id --}}
				<th class="py-3 px-6 border-r " >
					<div class="flex items-center">
						ID
					<a href="?sort=id&order={{Toggleorder($order)}}">
						@include('svg.sorted')
					</a>
					</div>
				</th>
				{{-- nom --}}
				<th class="py-3 px-6 border-r " >
					<div class="flex items-center">
						Nom
					<a href="?sort=name&order={{Toggleorder($order)}}">
						@include('svg.sorted')
					</a>
					</div>
				</th>
				{{-- categorie --}}
				<th class="py-3 px-6 border-r " >
					<div class="flex items-center">
						Catégorie
					<a href="?sort=id_categorie&order={{Toggleorder($order)}}">
						@include('svg.sorted')
					</a>
					</div>
				</th>
				{{-- prix --}}
				<th class="py-3 px-6 border-r " >
					<div class="flex items-center">
						Prix
					<a href="?sort=price&order={{Toggleorder($order)}}">
						@include('svg.sorted')
					</a>
					</div>
				</th>
				{{-- stock --}}
				<th class="py-3 px-6 border-r " >
					<div class="flex items-center">
						Image
					<a href="?sort=stock&order={{Toggleorder($order)}}">
						@include('svg.sorted')
					</a>
					</div>
				</th>
				<th class="py-3 px-6" colspan="2" >Opérations</th>
				
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
					<!-- Lien pour afficher un item : "article.show" -->
					<a href="{{ route('article.show', $item) }}" title="Voir l'article en détail" >
						@include('svg.show')
					</a>
				</td> --}}
				<td class="py-4 px-6 border-r">
                    {{$item->id}}
                </td>
                <td class="py-4 px-6 border-r">
                    {{$item->nom}}
                </td>
				<td class="py-4 px-6 border-r">
                    {{$item->categorie->nom}}
                </td>
				<td class="py-4 px-6 border-r">
                    {{$item->prix}}
                </td>
				<td class="py-4 px-6 border-r">
                    <img src="{{ URL::to($item->photo) }}" class="h-[200px]">
                </td>
				<td class="py-4 px-6 border-r">
					<!-- Lien pour modifier un item : "categorie.edit" -->
					<a class="underline text-blue-500" href="{{ route('article.edit', $item) }}" title="Modifier le produit" >Modifier</a>
				</td>
				<td class="py-4 px-6">
					<!-- Formulaire pour supprimer un Post : "categorie.destroy" -->
					<a class="underline text-red-500" href="{{ route('article.delete', $item) }}" title="Supprimer le produit" >Supprimer</a>
				</td>
			</tr>
			<?php $i++ ?>
			@endforeach
		</tbody>
	</table>
    </div>
	<div class="flex justify-end">
		{{ $article->links('custom.pagination') }}
	</div>
</div>
@endsection
