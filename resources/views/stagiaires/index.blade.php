<x-app-layout>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Liste des Stagiaires</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <h2 class="text-center mb-4">Liste des Stagiaires</h2>
    
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
    
            <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Date de Naissance</th>
                <th>Niveau</th>
                <th>Établissement</th>
                <th>Abréviation</th>
                <th>Ville</th>
                <th>Service</th>
                <th>Spécialité</th>
                <th>Option</th> <!-- Nouvelle colonne -->
            </tr>
        </thead>
        <tbody>
            @foreach($stagiaires as $stagiaire)
            <tr>
                
                <td>{{ $stagiaire->nom }}</td>
                <td>{{ $stagiaire->prénom }}</td>
                <td>{{ $stagiaire->email }}</td>
                <td>{{ $stagiaire->téléphone }}</td>
                <td>{{ $stagiaire->date_naissance }}</td>
                <td>{{ $stagiaire->niveau }}</td>
                <td>{{ $stagiaire->etablissement->nom_etablissement }}</td>
                <td>{{ $stagiaire->etablissement->abréviation }}</td>
                <td>{{ $stagiaire->etablissement->ville }}</td>
                <td>{{ $stagiaire->service->nom_service }}</td>
                <td>{{ $stagiaire->specialite }}</td>
                <td>
                    <a href="{{ route('stagiaires.edit', ['id' => $stagiaire->ID_stagiaire]) }}" class="btn btn-warning btn-sm">Modifier</a>        
                    <form action="{{ route('stagiaires.destroy', $stagiaire->ID_stagiaire) }}" method="POST" onsubmit="return testDelete();">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                    
                    <script>
                    function testDelete() {
                        console.log("Delete button clicked!");
                        return confirm("Are you sure you want to delete?");
                    }
                    </script>
                    
                    
                    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
            <a href="{{ route('stagiaires.create') }}" class="btn btn-primary">Ajouter un Stagiaire</a>
        </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    </x-app-layout>