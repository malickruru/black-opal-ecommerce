<div class="sidebar bg-base-content text-base-200 pt-5">
    <h1 class="m-5 text-3xl">Les Catégories</h1>
    <div class="row  w-96">
        <div class='col-sm-6 '>
            <span class="footer-title">Masculines</span><br>
            @foreach ($categories as $c)
                @if ($c->sexe == 'm')
                <div class="my-2">
                    <a class="link " href={{ url('/categorie', ['id' => $c->id]) }}>
                        {{ $c->nom }}
                    </a>
                </div>
                    
                @endif
            @endforeach
        </div>
        
        <div class='col-sm-6 '>
            <span class="footer-title">Féminines</span><br>
            
                @foreach ($categories as $c)
                    @if ($c->sexe == 'f')
                    <div class="my-2">
                        <a class="link " href={{ url('/categorie', ['id' => $c->id]) }}>
                            {{ $c->nom }}
                        </a>
                    </div>
                    
                    @endif
                @endforeach
            
        </div>
    </div>
</div>

<button id="toggle-sidebar" class="bg-base-content text-base-200 "><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
        class="bi bi-chevron-double-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd"
            d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
        <path fill-rule="evenodd"
            d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
    </svg></button>
