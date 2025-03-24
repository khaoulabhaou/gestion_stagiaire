<x-app-layout>

    <!-- Main Content -->
    <div class="container" style="margin-top: 100px;">
        <!-- Welcome Message -->
        <div class="text-center mt-5">
            <h1 class="display-4">Bienvenue sur la Plateforme d'Administration</h1>
            <p class="lead">Gérez vos stagiaires, encadrants et stages en toute simplicité.</p>
        </div>

        <!-- Cards Section -->
        <div class="row mt-5">
            <!-- Ajouter Stagiaire Card -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-user-plus fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Ajouter Stagiaire</h5>
                        <p class="card-text">Ajoutez un nouveau stagiaire à la plateforme.</p>
                        <a href="{{ route('stagiaires.create') }}" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>

            <!-- Ajouter Encadrant Card -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-user-tie fa-3x mb-3 text-success"></i>
                        <h5 class="card-title">Ajouter Encadrant</h5>
                        <p class="card-text">Ajoutez un nouvel encadrant à la plateforme.</p>
                        <a href="{{ route('encadrants.create') }}" class="btn btn-success">Accéder</a>
                    </div>
                </div>
            </div>

            <!-- Ajouter Stage Card -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-plus fa-3x mb-3 text-warning"></i>
                        <h5 class="card-title">Ajouter Stage</h5>
                        <p class="card-text">Ajoutez un nouveau stage à la plateforme.</p>
                        <a href="{{ route('stages.create') }}" class="btn btn-warning">Accéder</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional: Statistics Section -->
        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x mb-3 text-info"></i>
                        <h5 class="card-title">Stagiaires</h5>
                        <p class="card-text">Total : {{ $stagiairesCount }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-user-tie fa-3x mb-3 text-secondary"></i>
                        <h5 class="card-title">Encadrants</h5>
                        <p class="card-text">Total : {{ $encadrantsCount }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-alt fa-3x mb-3 text-danger"></i>
                        <h5 class="card-title">Stages</h5>
                        <p class="card-text">
                             Total : {{ $stagesCount }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    {{-- <footer class="bg-success text-white text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Plateforme d'Administration. Tous droits réservés.</p>
        </div>
    </footer> --}}

    <!-- Font Awesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>