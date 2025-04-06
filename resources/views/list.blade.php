<x-app-layout>   
    <body style="padding: 0" class="mt-5">
    <div class="container mt-5" style="padding: 0; margin: 0 0 0 4rem; font-size: 1rem;">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="text-center mx-auto mb-0 mt-2" style="font-weight:300">Stagiaires dans stage : {{ $stagiaires->total() }}</p>
        </div>

        <!-- Search and Add Button Row -->
        <div class="d-flex justify-content-between mb-3">
            <!-- Search Bar -->
            <div class="col-md-4">
                <form action="{{ route('list') }}" method="GET">
                    <div class="input-group">
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Rechercher..." 
                               value="{{ request('search') }}">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('list') }}" class="btn btn-outline-danger">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Add Button -->
            <div>
                <a href="{{ route('stagiaires.create') }}" class="btn btn-success">
                    <i class="fas fa-user-plus"></i> Ajouter Stagiaire
                </a>
            </div>
        </div>

        <!-- Table -->
        <div style="overflow-x: auto;">
            <table class="table table-bordered table-hover table-sm">
                <thead class="table-success">
                    <tr>
                        <th class="text-center">Stagiaire</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Téléphone</th>
                        <th class="text-center">Niveau</th>
                        <th class="text-center">Établissement</th>
                        <th class="text-center">Ville</th>
                        <th class="text-center">Service</th>
                        <th class="text-center">Spécialité</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stagiaires as $stagiaire)
                    <tr>
                        <td class="text-center align-middle">{{ $stagiaire->nom }} {{ $stagiaire->prénom }}</td>
                        <td class="text-center align-middle">{{ $stagiaire->email }}</td>
                        <td class="text-center align-middle">{{ $stagiaire->téléphone }}</td>
                        <td class="text-center align-middle">{{ $stagiaire->niveau }}</td>
                        <td class="text-center align-middle">{{ optional($stagiaire->etablissement)->abréviation }}</td>
                        <td class="text-center align-middle">{{ optional($stagiaire->etablissement)->ville }}</td>
                        <td class="text-center align-middle">{{ optional($stagiaire->service)->nom_service }}</td>
                        <td class="text-center align-middle">{{ $stagiaire->specialite }}</td>
                        <td class="text-center align-middle">
                            <div style="display: flex; justify-content: center; gap: 5px;">
                                <a href="{{ route('stagiaires.edit', $stagiaire->ID_stagiaire) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>        
                                <form action="{{ route('stagiaires.destroy', $stagiaire->ID_stagiaire) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Aucun stagiaire trouvé</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($stagiaires->total() > $stagiaires->perPage())
            <div class="mt-3">
                {{ $stagiaires->appends(['search' => request('search')])->links('vendor.pagination.bootstrap-5') }}
            </div>
        @endif
    </div>
    </body>
</x-app-layout>