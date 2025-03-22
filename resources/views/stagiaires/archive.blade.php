<x-app-layout>
    <header style="margin-top:5rem">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    </header>
    <div class="container">
        <h2>Archive des Stagiaires</h2>

        <!-- Display archived stagiaires in a table -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Date de Naissance</th>
                    <th>Service</th>
                    <th>Établissement</th>
                    <th>Niveau</th>
                    <th>Spécialité</th>
                </tr>
            </thead>
            <tbody>
                @foreach($archivedStagiaires as $stagiaire)
                    <tr>
                        <td>{{ $stagiaire->ID_stagiaire }}</td>
                        <td>{{ $stagiaire->nom }}</td>
                        <td>{{ $stagiaire->prénom }}</td>
                        <td>{{ $stagiaire->email }}</td>
                        <td>{{ $stagiaire->téléphone }}</td>
                        <td>{{ $stagiaire->date_naissance }}</td>
                        <td>{{ $stagiaire->service->nom_service }}</td>
                        <td>{{ $stagiaire->etablissement->nom_etablissement }}</td>
                        <td>{{ $stagiaire->niveau }}</td>
                        <td>{{ $stagiaire->specialite }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>