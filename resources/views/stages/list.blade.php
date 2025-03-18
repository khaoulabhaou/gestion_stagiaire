<x-app-layout>
    <header class="mt-5">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    </header>
    <div class="container">
        <h2>Liste des Stages</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Description</th>
                    <th>Service</th>
                    <th>Stagiaire</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stages as $stage)
                    <tr>
                        <td>{{ $stage->ID_stage }}</td>
                        <td>{{ $stage->titre }}</td>
                        <td>{{ $stage->date_début }}</td>
                        <td>{{ $stage->date_fin }}</td>
                        <td>{{ $stage->description }}</td>
                        <td>{{ $stage->service->nom_service ?? 'N/A' }}</td>
                        <td>{{ $stage->stagiaire->nom ?? 'N/A' }} {{ $stage->stagiaire->prénom ?? '' }}</td>
                        <td>
                            <a href="{{ route('stages.edit', $stage->ID_stage) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('stages.destroy', $stage->ID_stage) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stage ?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>