<x-app-layout>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Modifier Stagiaire</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .custom-container {
                margin-top: 100px; 
            }
        </style>
    </head>
    <body>
        <div class="container-fluid custom-container">
            <div class="card p-4 shadow">
                <h2 class="text-center mb-4">Modifier Stagiaire</h2>

                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('stagiaires.update', ['id' => $stagiaire->ID_stagiaire]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Hidden input for ID_etablissement -->
                    <input type="hidden" name="ID_etablissement" value="{{ $stagiaire->etablissement->ID_etablissement }}">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" name="nom" value="{{ $stagiaire->nom }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="prénom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" name="prénom" value="{{ $stagiaire->prénom }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $stagiaire->email }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="téléphone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" name="téléphone" value="{{ $stagiaire->téléphone }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="date_naissance" class="form-label">Date de Naissance</label>
                            <input type="date" class="form-control" name="date_naissance" value="{{ $stagiaire->date_naissance }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="niveau" class="form-label">Niveau</label>
                            <input type="text" class="form-control" name="niveau" value="{{ $stagiaire->niveau }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="nom_etablissement" class="form-label">Nom Établissement</label>
                            <input type="text" class="form-control" name="nom_etablissement" value="{{ $stagiaire->etablissement->nom_etablissement }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="ville" class="form-label">Ville</label>
                            <input type="text" class="form-control" name="ville" value="{{ $stagiaire->etablissement->ville }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="abréviation" class="form-label">Abréviation</label>
                            <input type="text" class="form-control" name="abréviation" value="{{ $stagiaire->etablissement->abréviation }}" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label for="ID_service" class="form-label">Service</label>
                            <select name="ID_service" id="ID_service" class="form-control" required>
                                <option value="">Sélectionner un service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->ID_service }}" {{ $stagiaire->service->ID_service == $service->ID_service ? 'selected' : '' }}>
                                        {{ $service->nom_service }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="specialite" class="form-label">Spécialité</label>
                            <input type="text" class="form-control" name="specialite" value="{{ $stagiaire->specialite }}" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
</x-app-layout> 