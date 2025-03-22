{{-- <x-app-layout> --}}

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Encadrants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Liste des Encadrants</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($encadrants as $encadrant)
                <tr>
                    <td>{{ $encadrant->id }}</td>
                    <td>{{ $encadrant->nom }}</td>
                    <td>{{ $encadrant->prenom }}</td>
                    <td>{{ $encadrant->email }}</td>
                    <td>
                        <form action="{{ route('encadrants.destroy', $encadrant->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet encadrant ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucun encadrant trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('encadrants.create') }}" class="btn btn-primary">Ajouter un encadrant</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

{{-- </x-app-layout> --}}