<x-app-layout>
    <header style="margin-top: 2.5rem">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </header>

    <div class="container text-center">
        <!-- Display success message if any -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="text-center mx-auto mb-0 mt-2" style="font-weight:300">Stages en cours : {{ $stages->total() }}</p>
        </div>

        <!-- Search and Add Button Row -->
        <div class="d-flex justify-content-between mb-3">
            <!-- Search Bar -->
            <div class="col-md-4">
                <form action="{{ route('stages.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher..." 
                               value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('stages.index') }}" class="btn btn-outline-danger">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Button to add a new stagiaire -->
            <div>
                <a href="{{ route('stages.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Ajouter Stage
                </a>
            </div>
        </div>

        <!-- Bootstrap Table -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-success">
                    <tr>
                        <th class="text-center">Titre</th>
                        <th class="text-center">Stagiaire</th>
                        <th class="text-center">Service</th>
                        <th class="text-center">Date de début</th>
                        <th class="text-center">Date de fin</th>
                        <th class="text-center">Encadrant</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stages as $stage)
                        <tr>
                            <td class="align-middle">{{ $stage->titre }}</td>
                            <td class="align-middle">{{ $stage->stagiaire->nom }} {{ $stage->stagiaire->prénom }}</td>
                            <td class="align-middle">{{ $stage->service->nom_service }}</td>
                            <td class="align-middle">{{ $stage->date_début }}</td>
                            <td class="align-middle">{{ $stage->date_fin }}</td>
                            <td class="align-middle">
                                @foreach($stage->encadrants as $encadrant)
                                    {{ $encadrant->nom }} {{ $encadrant->prenom }}@if(!$loop->last), @endif
                                @endforeach
                            </td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('stages.edit', $stage->ID_stage) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-pen-to-square"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('stages.destroy', $stage->ID_stage) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce stage ?')">
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
                            <td colspan="7" class="text-center">Aucun stage trouvé</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($stages->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $stages->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</x-app-layout>