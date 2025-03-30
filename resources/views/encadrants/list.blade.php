<x-app-layout>
    <header style="margin-top: 2.5rem">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </header>

    <div class="container text-center">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search and Add Button Row -->
        <div class="d-flex justify-content-between mb-3">
            <!-- Search Bar -->
            <div class="col-md-4">
                <form action="{{ route('encadrants.list') }}" method="GET">
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
                            <a href="{{ route('encadrants.list') }}" class="btn btn-outline-danger">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Add Button -->
            <div>
                <a href="{{ route('encadrants.create') }}" class="btn btn-success">
                    <i class="fas fa-user-plus"></i> Ajouter Encadrant
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-success">
                    <tr>
                        <th class="text-center">Nom</th>
                        <th class="text-center">Prénom</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Service</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($encadrants as $encadrant)
                        <tr>
                            <td class="align-middle">{{ $encadrant->nom }}</td>
                            <td class="align-middle">{{ $encadrant->prenom }}</td>
                            <td class="align-middle">{{ $encadrant->email }}</td>
                            <td class="text-center align-middle">{{ $encadrant->service->nom_service }}</td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('encadrants.edit', $encadrant->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-pen-to-square"></i>
                                    </a>

                                    <form action="{{ route('encadrants.destroy', $encadrant->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet encadrant ?')">
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
                            <td colspan="5" class="text-center">Aucun encadrant trouvé</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($encadrants->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $encadrants->appends(['search' => request('search')])->links() }}
            </div>
        @endif
    </div>
</x-app-layout>