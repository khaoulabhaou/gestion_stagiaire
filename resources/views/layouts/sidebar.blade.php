<header class="header" id="header">
    <div class="header_toggle">
        <i class="bx bx-menu" id="header-toggle"></i>
    </div>

    <div class="header_img">
        <img src="https://scontent.fccu2-3.fna.fbcdn.net/v/t39.30808-6/373611637_2003925126646573_1171042221997763294_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=5f2048&_nc_ohc=EAqcT2FLHl4AX91Pdji&_nc_ht=scontent.fccu2-3.fna&oh=00_AfBLAGK4oYl8MD_ntFjH1V_7R-cE4DAlF4ixUm0YzbjjXw&oe=653B84F0" alt="">
    </div>

    <!-- User Dropdown Menu on the Right -->
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div>{{ Auth::user()->name }}</div>

                <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link style="text-decoration: none" :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-dropdown-link>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link style="text-decoration: none" :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</header>

<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <div class="nav_list">
                <p class="nav_link flex" style="padding: 0;margin-bottom:3rem">
                    <img width="30%" style="margin: 9.5% 0 0 3.9%;padding:0" src="https://i.postimg.cc/TwQ8RCyY/Whats-App-Image-2025-l02-11-at-10-38-33-526755f1-1-Copy-removebg-preview-removebg-preview.png" alt="" srcset="">
                    <span style="font-size: 16px;margin-top:10%">l'Agence Urbain de Lâayoune</span>
                </p>
                
                <a href="{{ route('dashboard') }}" class="nav_link flex" style="text-decoration: none">
                    <i class="fa-solid fa-house" style="margin-left: 0.4%"></i> <!-- Font Awesome home icon -->
                    <span>Accueil</span>
                </a>                   
                
                <!-- Stagiaires Dropdown -->
                <div class="nav_link dropdown" style="padding : 23px">
                    <div class="flex">
                        <i class="fa-solid fa-user" style="margin-left: 0.29rem"></i>
                        <span>Stagiaires</span>
                    </div>
                    <div class="dropdown-content">
                        <a href="{{ route('stagiaires.create') }}">Ajouter Stagiaire</a>
                        <a href="{{ route('list') }}">List de Stagiaires</a>
                        {{-- <a href="{{ route('stagiaires.archive') }}">Archive</a> --}}
                    </div>
                </div>
                <!-- Encadrants Dropdown -->
                <div class="nav_link dropdown" style="padding : 22px">
                    <div class="flex">
                        <i class="fa-solid fa-user-tie" style="margin-left: 0.45rem"></i>
                        <span>Encadrants</span>
                    </div>
                    <div class="dropdown-content">
                        <a href="#">Ajouter Encadrant</a>
                        <a href="#">List d'Encadrant</a>
                    </div>
                </div>
                <!-- Stages Dropdown -->
                <div class="nav_link dropdown" style="padding : 23px">
                    <div class="flex" style="margin-left: 0.45rem">
                        <i class="fa-solid fa-calendar"></i>
                        <span>Stages</span>
                    </div>
                    <div class="dropdown-content">
                        <a href="{{ route('stages.create')}}">Ajouter Stage</a>
                        <a href="{{ route('stages.index')}}">List de Stage</a>
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav_link" style="border: none; background: none; cursor: pointer;">
                <i class="bx bx-log-out nav_icon"></i>
                <span>Sign Out</span>
            </button>
        </form>        
    </nav>
</div>

<!-- Add some CSS for the dropdown -->
<style>
    .dropdown {
        position: relative;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        left: 7%; /* Move dropdown 7% to the right */
        top: 100%;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .flex {
        display: flex;
        align-items: center;
        gap: 0.5rem; /* Adjust the gap between icon and text */
    }
</style>