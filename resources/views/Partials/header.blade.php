<div class="navbar bg-neutral text-neutral-content ">
    <div class="flex-1">
        <a href="/" class="btn btn-ghost normal-case text-xl aboreto-font">Black Opal</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
            @if (Auth::check())
                <li tabindex="0">
                    <a>
                        Bonjour {{ Auth::user()->prenom }}
                        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 24 24">
                            <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                        </svg>
                    </a>
                    <ul class="p-2 bg-base-100 bg-neutral-focus z-10">
                        <li>
                            <a href="{{ route('profil') }}">Mon Profil</a>
                        </li>
                        <li><a href="{{ route('promo.index') }}">Mes promotions</a></li>
                        <li><a href="{{ route('commande.index') }}">Mes commandes</a></li>
                        <li><a href="{{ route('envie.index') }}">Ma liste d'envie</a></li>
                        <li><a href="{{ route('logout') }}">Déconnexion</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('panier.index') }}"><i class="bi bi-cart"></i></a></li>
            @else
                <li><a href="{{ route('login') }}">Se connecter</a></li>
            @endif
        </ul>
    </div>
</div>
