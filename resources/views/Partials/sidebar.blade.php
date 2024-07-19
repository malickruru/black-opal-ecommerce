<div class="sidebar bg-primary text-base-content relative pt-5">

    <button id="toggle-sidebar" class=" text-white absolute top-2 right-2 p-2 ">
        <i class="bi bi-x-circle"></i>
</button>


    <h1 class="m-5 text-3xl">Les Catégories</h1>
    <div class="row  w-96">
        <div class='col-sm-6 offset-sm-3'>
            
            @foreach ($categories as $c)
                @if ($c->active)
                <ul class="my-2">
                    <li>
                        <a class="link " href={{ url('/categorie', ['id' => $c->id]) }}>
                            {{ $c->nom }}
                        </a>
                    </li>
                   
                </ul>
                    
                @endif
            @endforeach

        </div>
        
    </div>
</div>


