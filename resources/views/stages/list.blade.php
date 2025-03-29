<x-app-layout>
    <header style="margin-top: 2.5rem">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    </header>

    <div class="container text-center">
        <!-- Display success message if any -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Button to add a new stagiaire -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('stages.create') }}" class="btn btn-success" style="margin-right: 7px">
                <i class="fa-solid fa-user-plus"></i>
            </a>
        </div>

        <!-- Bootstrap Table -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-success">
                    <tr>
                        <th class="text-center">Titre</th>
                        <th class="text-center">Stagiaire</th>
                        <th class="text-center">Encadrant</th>
                        <th class="text-center">Service</th>
                        <th class="text-center">Date de début</th>
                        <th class="text-center">Date de fin</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stages as $stage)
                        <tr>
                            <td class="align-middle">{{ $stage->titre }}</td>
                            <td class="align-middle">{{ $stage->stagiaire->nom }} {{ $stage->stagiaire->prénom }}</td>
                            <td class="align-middle">
                                @foreach($stage->encadrants as $encadrant)
                                    {{ $encadrant->nom }} {{ $encadrant->prenom }}
                                @endforeach
                            </td>
                            <td class="align-middle">{{ $stage->service->nom_service }}</td>
                            <td class="align-middle">{{ $stage->date_début }}</td>
                            <td class="align-middle">{{ $stage->date_fin }}</td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('stages.edit', $stage->ID_stage) }}" class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('stages.destroy', $stage->ID_stage) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce stage ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
