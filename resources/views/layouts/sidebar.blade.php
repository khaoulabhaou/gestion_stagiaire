<header class="header" id="header">
    <div class="header_toggle">
        <i class="bx bx-menu" id="header-toggle"></i>
    </div>
    <div class="header_img">
        <img src="https://scontent.fccu2-3.fna.fbcdn.net/v/t39.30808-6/373611637_2003925126646573_1171042221997763294_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=5f2048&_nc_ohc=EAqcT2FLHl4AX91Pdji&_nc_ht=scontent.fccu2-3.fna&oh=00_AfBLAGK4oYl8MD_ntFjH1V_7R-cE4DAlF4ixUm0YzbjjXw&oe=653B84F0" alt="">
    </div>
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
                    {{-- <i class="fa-solid fa-house nav_icon"></i> --}}
                    <i class="material-icons">home</i> 
                    <span>Accueil</span>
                </p>
                <p class="nav_link">
                    {{-- <i class="fa-solid fa-user nav_icon"></i> --}}
                    <i class="fa-solid fa-user" style="margin-left: 0.29rem"></i>
                    <span>Stagiaires</span>
                </p>
                <p class="nav_link">
                    {{-- <i class="fa-solid fa-user-tie nav_icon"></i> --}}
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