<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attestation Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    {{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Bienvenue") }}  {{ Auth::user()->name }} {{ __("") }} 
        </h2>
    </x-slot> --}}
    <div class="container mt-5">
        <div class="card p-4">
            <h2 class="text-center mb-4">Demande de stage</h2>

            <form>
                <!-- Première ligne : Nom, Prénom, Email -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" placeholder="Nom">
                    </div>
                    <div class="col-md-4">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" placeholder="Prénom">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                </div>

                <!-- Deuxième ligne : Téléphone, Date de naissance, Niveau -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="telephone" placeholder="Téléphone">
                    </div>
                    <div class="col-md-4">
                        <label for="dateNaissance" class="form-label">Date de Naissance</label>
                        <input type="date" class="form-control" id="dateNaissance">
                    </div>
                    <div class="col-md-4">
                        <label for="niveau" class="form-label">Niveau</label>
                        <input type="text" class="form-control" id="niveau" placeholder="Niveau">
                    </div>
                </div>

                <!-- Troisième ligne : Nom établissement, Ville, Abréviation -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="etablissement" class="form-label">Nom Établissement</label>
                        <input type="text" class="form-control" id="etablissement" placeholder="Nom Établissement">
                    </div>
                    <div class="col-md-4">
                        <label for="ville" class="form-label">Ville</label>
                        <input type="text" class="form-control" id="ville" placeholder="Ville">
                    </div>
                    <div class="col-md-4">
                        <label for="abreviation" class="form-label">Abréviation</label>
                        <input type="text" class="form-control" id="abreviation" placeholder="Abréviation">
                    </div>
                </div>

                <!-- Quatrième ligne : Service, Date début, Date fin -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="service" class="form-label">Service</label>
                        <input type="text" class="form-control" id="service" placeholder="Service">
                    </div>
                    <div class="col-md-4">
                        <label for="dateDebut" class="form-label">Date Début de stage</label>
                        <input type="date" class="form-control" id="dateDebut">
                    </div>
                    <div class="col-md-4">
                        <label for="dateFin" class="form-label">Date Fin de stage</label>
                        <input type="date" class="form-control" id="dateFin">
                    </div>
                </div>

                <div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Valider</button>
                </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
{{-- </x-app-layout> --}}
</html>