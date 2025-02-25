<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/vendors/feather/feather.css">
    <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/images/.png" />
</head>
<body>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home" style="margin-right: 11.5%"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false"
                aria-controls="error">
                <i class="fas fa-user" style="margin-right : 11.5%"></i>
                <span class="menu-title">Stagiaires</span>
            </a>
            <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                    <li>
                        <a class="nav-link text-white" href="pages/samples/error-404.html">
                            <i class="fas fa-plus"></i> Ajouter Stagiaires
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white" href="pages/samples/error-500.html">
                            <i class="fas fa-list"></i> List De Stagiaires
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white" href="pages/samples/error-500.html">
                            <i class="fas fa-archive"></i> Archives
                        </a>
                    </li>
                </ul>
                
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }}" data-toggle="collapse"
                href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="fas fa-user-tie" style="margin-right: 11.5%"></i> 
                <span class="menu-title">Encadrants</span>
                
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li>
                        <a class="nav-link text-white" href="pages/samples/error-404.html">
                            <i class="fas fa-plus"></i> Ajouter Encadrant
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white" href="pages/samples/error-500.html">
                            <i class="fas fa-list"></i> List D'Encadrants
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white" href="pages/samples/error-500.html">
                            <i class="fas fa-archive"></i> Archive
                        </a>
                    </li>
                </ul>
                
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false"
                aria-controls="charts">
                <i class="fas fa-flask" style="margin-right: 11.5%"></i>
                <span class="menu-title">Service</span>
                
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li> <a class="nav-link text-white" href="pages/charts/chartjs.html"><i class="fas fa-list"></i> Liste Service</a>
                    </li>
                    <li> <a class="nav-link text-white" href="pages/charts/chartjs.html"><i class="fas fa-plus"></i>Créer Service</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false"
                aria-controls="tables">
                <i class="fas fa-briefcase" style="margin-right: 11.5% "></i>
                <span class="menu-title">Stages</span>
                
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li>
                        <a class="nav-link text-white" href="pages/samples/error-404.html">
                            <i class="fas fa-plus"></i> Ajouter Stage
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white" href="pages/samples/error-500.html">
                            <i class="fas fa-list"></i>List Des Stages
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white" href="pages/samples/error-500.html">
                            <i class="fas fa-archive"></i> Archive
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false"
                aria-controls="icons">
                <i class="fas fa-envelope" style="margin-right: 11.5%"></i>
                <span class="menu-title">Demandes</span>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li> <a class="nav-link text-white" href="pages/icons/mdi.html"><i class="fas fa-plus"></i>Créer Demande</a></li>
                    <li> <a class="nav-link text-white" href="pages/icons/mdi.html"><i class="fas fa-archive"></i>Archive</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
</body>