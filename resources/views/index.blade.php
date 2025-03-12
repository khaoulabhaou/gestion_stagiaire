<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/index.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="mainBox">

        <div class="mobileMenu" id="mobileMenuButton">
            <span class="iconify" data-icon="fe:app-menu"></span>
        </div>

        <nav>
            <h1 class="headerText">
                <a href="route:{{'index'}}"><img src="https://i.postimg.cc/JnxyStjv/Whats-App-Image-2025-02-06-at-01-14-58-81ac60ef-removebg-preview-1.png" alt=""></a>
            </h1>
            <div class="menu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="iconify" data-icon="fa6-solid:house"></span>
                        <a class="nav-link" href="#">Overview</a>
                    </li>
                    <li class="nav-item dropdown">
                        <span class="iconify" data-icon="mdi:account"></span>
                        <a class="nav-link dropdown-toggle" href="#" id="statsDropdown" role="button" data-bs-toggle="dropdown">Stagiaire</a>
                        <ul class="dropdown-menu" style="width:20rem">
                            <li><a class="dropdown-item" href="#">Ajouter un Stagiaire</a></li>
                            <li><a class="dropdown-item" href="#">List de Stagaires</a></li>
                            <li><a class="dropdown-item" href="#">Archive</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <span class="iconify" data-icon="mdi:account-tie"></span>
                        <a class="nav-link dropdown-toggle" href="#" id="chatDropdown" role="button" data-bs-toggle="dropdown">Encadrant</a>
                        <ul class="dropdown-menu" style="width:20rem">
                            <li><a class="dropdown-item" href="#">Ajouter un Encadrant</a></li>
                            <li><a class="dropdown-item" href="#">List de Encadrant</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown active">
                        <span class="iconify" data-icon="mdi:school"></span>
                        <a class="nav-link dropdown-toggle" href="#" id="projectsDropdown" role="button" data-bs-toggle="dropdown">Stage</a>
                        <ul class="dropdown-menu" style="width:20rem">
                            <li><a class="dropdown-item" href="#">Ajouter un Stage</a></li>
                            <li><a class="dropdown-item" href="#">List de Stages</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="iconify" data-icon="ic:round-logout"></span>
                        <a class="nav-link" href="{{ route('login') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <section class="mainSec">
            <div class="MainSecHeader">
                <div class="userInfoDiv">
                    <div class="userNameBox">
                        <span>Mohammad Reza</span>
                        <span class="iconify" data-icon="dashicons:arrow-up-alt2"></span>
                    </div>
                    <div class="userNameImage">
                        <img src="assets/images/avatars/avatar0.jpg" alt="User Profile Image">
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/move-box.js') }}"></script>    
</body>
</html>