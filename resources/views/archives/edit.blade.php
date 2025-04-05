<x-app-layout>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Modifier Stagiaire Archivé</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .custom-container {
                margin-top: 50px;
            }
            .card {
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body>
        <div class="container-fluid custom-container">
            <div class="card p-4 shadow" style="max-width: 1200px; margin: 0 auto;">
                <h2 class="text-center mb-4">Modifier Stagiaire Archivé</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('archives.update', $archive->ID_stagiaire) }}" method="POST" style="margin-top: 2rem">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <!-- Personal Information -->
                        <div class="col-md-4">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" 
                                   value="{{ old('nom', $archive->nom) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label for="prénom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prénom" name="prénom" 
                                   value="{{ old('prénom', $archive->prénom) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ old('email', $archive->email) }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="téléphone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="téléphone" name="téléphone" 
                                   value="{{ old('téléphone', $archive->téléphone) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label for="ID_service" class="form-label">Service</label>
                            <select class="form-control" id="ID_service" name="ID_service" required>
                                <option value="">Sélectionner un service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->ID_service }}" 
                                        {{ old('ID_service', $archive->ID_service) == $service->ID_service ? 'selected' : '' }}>
                                        {{ $service->nom_service }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="nom_etablissement" class="form-label">Établissement</label>
                            
                            <!-- Visible text input for editing the name -->
                            <input type="text" class="form-control" id="nom_etablissement" 
                                   name="nom_etablissement"
                                   value="{{ old('nom_etablissement', $archive->etablissement->nom_etablissement ?? '') }}" 
                                   required>
                            
                            <!-- Hidden input to store the actual ID -->
                            <input type="hidden" name="ID_etablissement" 
                                   value="{{ old('ID_etablissement', $archive->ID_etablissement) }}">
                        </div>
                        
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Période de Stage</label>
                            <input type="text" class="form-control" value="@foreach($archive->stages as $stage){{ \Carbon\Carbon::parse($stage->date_fin)->format('d/m/Y') }}-{{ \Carbon\Carbon::parse($stage->date_début)->format('d/m/Y') }}@endforeach">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('archive') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                        <button type="submit" class="btn btn-success">
                           Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

        <script>
            // Format phone number input
            document.getElementById('téléphone').addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10);
            });

            // Initialize form controls
            document.addEventListener('DOMContentLoaded', function() {
                // You can add any initialization code here if needed
            });
        </script>
    </body>
    </html>
</x-app-layout>