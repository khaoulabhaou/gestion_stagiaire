<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier Stagiaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Modifier Stagiaire</h2>

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
        
            <!-- ✅ Add hidden inputs for ID_etablissement and ID_service -->
            <input type="hidden" name="ID_etablissement" value="{{ $stagiaire->etablissement->ID_etablissement }}">
            <input type="hidden" name="ID_service" value="{{ $stagiaire->service->ID_service }}">
        
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" value="{{ $stagiaire->nom }}" required>
                </div>
                <div class="col-md-6">
                    <label for="prénom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prénom" value="{{ $stagiaire->prénom }}" required>
                </div>
            </div>
        
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $stagiaire->email }}" required>
                </div>
                <div class="col-md-6">
                    <label for="téléphone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control" name="téléphone" value="{{ $stagiaire->téléphone }}" required>
                </div>
            </div>
        
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="date_naissance" class="form-label">Date de Naissance</label>
                    <input type="date" class="form-control" name="date_naissance" value="{{ $stagiaire->date_naissance }}" required>
                </div>
                <div class="col-md-6">
                    <label for="niveau" class="form-label">Niveau</label>
                    <input type="text" class="form-control" name="niveau" value="{{ $stagiaire->niveau }}" required>
                </div>
            </div>
        
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="specialite" class="form-label">Spécialité</label>
                    <input type="text" class="form-control" name="specialite" value="{{ $stagiaire->specialite }}" required>
                </div>
                <div class="col-md-6">
                    <label for="nom_service" class="form-label">Service</label>
                    <input type="text" class="form-control" name="nom_service" value="{{ $stagiaire->service->nom_service }}" required>
                </div>
            </div>
        
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nom_etablissement" class="form-label">Établissement</label>
                    <input type="text" class="form-control" name="nom_etablissement" value="{{ $stagiaire->etablissement->nom_etablissement }}" required>
                </div>
                <div class="col-md-6">
                    <label for="ville" class="form-label">Ville</label>
                    <input type="text" class="form-control" name="ville" value="{{ $stagiaire->etablissement->ville }}" required>
                </div>
            </div>
        
            <div class="row mb-3">
                <div class="md-6">
                    <label for="abréviation" class="form-label">Abréviation</label>
                    <input type="text" class="form-control" name="abréviation" value="{{ $stagiaire->etablissement->abréviation }}" required>
                </div>
                
            </div>
        
            <div class="d-flex justify-content-between">
                <a href="{{ route('stagiaires.index') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </form>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>