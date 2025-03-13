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
                <p class="nav_link flex" style="padding: 0">
                    <img width="30%" style="margin: 9.5%;padding:0" src="https://i.postimg.cc/TwQ8RCyY/Whats-App-Image-2025-l02-11-at-10-38-33-526755f1-1-Copy-removebg-preview-removebg-preview.png" alt="" srcset="">
                    <span style="font-size: 16px">l'Agence Urbain</span>
                </p>
                <p class="nav_link">
                    <i class="material-icons">home</i> 
                    <span>Accueil</span>
                </p>
                <p class="nav_link">
                    <i class="fa-solid fa-user" style="margin-left: 0.29rem"></i>
                    <span>Stagiaires</span>
                </p>
                <p class="nav_link">
                    <i class="fa-solid fa-user-tie" style="margin-left: 0.29rem"></i>
                    <span>Encadrants</span>
                </p>
                <p class="nav_link">
                    <i class="material-icons">badge</i>
                    <span>Stages</span>
                </p>
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
