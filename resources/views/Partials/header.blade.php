<style>
    .logo{
        height: 40px;
        margin: 0;
    }
</style>
<div class="navbar bg-primary text-neutral-content ">
    <div class="flex-1">
        <div class="dropdown block lg:hidden">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h8m-8 6h16" />
              </svg>
            </div>
            <ul
              tabindex="0"
              class="menu menu-sm dropdown-content bg-base-100 text-slate-900 rounded-box z-[1] mt-3 w-52 p-2 shadow">
              <li><a id="toggle-sidebar2">Catégorie</a></li>
            @if (Auth::check() && Auth::user()->isAdmin)
                <li><a href="{{ route('admin.panel') }}">Admin</a></li>
            @endif

            @if (Auth::check())
          
                <li class="text-slate-900" >
                    <details>
                    <summary   class=" ">
                        Bonjour {{ Auth::user()->prenom }}
                      
                    </summary>
                    <ul   class="p-2  bg-base-100 bg-neutral-focus  z-10 dropdown-content">
                       
                        <li><a href="{{ route('promo.index') }}">Mes promotions</a></li>
                        <li><a href="{{ route('commande.index') }}">Mes commandes</a></li>
                        <li><a href="{{ route('envie.index') }}">Ma liste d'envie</a></li>
                        <li>
                            <a href="{{ route('password') }}">Modifier mot de passe</a>
                        </li>
                        <li class="bg-error"><a href="{{ route('logout') }}">Déconnexion</a></li>
                    </ul>
                    <details>
                </li>
               
                <li><a href="{{ route('panier.index') }}">Mon panier<i class="bi bi-cart"></i></a></li>
            @else
                <li><a href="{{ route('login') }}">Se connecter</a></li>
            @endif
            </ul>
          </div>

         
        <a href="/" class="btn btn-ghost normal-case text-xl aboreto-font">
            <img class="logo invert" src="{{URL::to('images/logo.png')}}" alt="">
        </a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1 ">
            <li class="hidden md:block"><a id="toggle-sidebar3">Catégorie</a></li>
            @if (Auth::check() && Auth::user()->isAdmin)
                <li class="hidden md:block"><a href="{{ route('admin.panel') }}">Admin</a></li>
            @endif

            @if (Auth::check())
                <li class=" dropdown hidden md:block" >
                    <a  tabindex="0" class=" focus:text-white">
                        Bonjour {{ Auth::user()->prenom }}
                        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 24 24">
                            <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                        </svg>
                    </a>
                    <ul  tabindex="0" class="p-2 bg-base-100 bg-neutral-focus text-slate-900 z-10 dropdown-content">
                       
                        <li><a href="{{ route('promo.index') }}">Mes promotions</a></li>
                        <li><a href="{{ route('commande.index') }}">Mes commandes</a></li>
                        <li><a href="{{ route('envie.index') }}">Ma liste d'envie</a></li>
                        <li>
                            <a href="{{ route('password') }}">Modifier mot de passe</a>
                        </li>
                        <li class="bg-error"><a href="{{ route('logout') }}">Déconnexion</a></li>
                    </ul>
                </li>
                <li class="hidden md:block"><a href="{{ route('panier.index') }}"><i class="bi bi-cart"></i></a></li>
            @else
                <li class="hidden md:block"><a href="{{ route('login') }}">Se connecter</a></li>
            @endif
            <li >
                <a id="playBtnWrapper">
                <i id="playBtn" class="bi "></i>
                </a>
            </li>
        </ul>

    
        

        


    </div>
</div>
