<x-app-layout>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ajouter un Stage</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .custom-container {
                margin-top: 100px;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid custom-container">
            <div class="card p-4 shadow" style="max-width: 1200px; margin: 0 auto;height:55vh">
                <h2 class="text-center mb-4">Ajouter un Stage</h2>

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

                <form action="{{ route('stages.store') }}" style="margin-top: 2rem" method="POST" onsubmit="return validateDates()">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="titre" class="form-label">Titre</label>
                            <input type="text" name="titre" id="titre" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="date_début" class="form-label">Date de début</label>
                            <input type="date" name="date_début" id="date_début" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="date_fin" class="form-label">Date de fin</label>
                            <input type="date" name="date_fin" id="date_fin" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3"> 
                        <div class="col-md-4">
                            <label for="ID_service" class="form-label">Service</label>
                            <select name="ID_service" id="ID_service" class="form-control" required onchange="filterOptions()">
                                <option value="">Sélectionner un service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->ID_service }}" {{ $selectedService == $service->ID_service ? 'selected' : '' }}>
                                        {{ $service->nom_service }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="id_stagiaire" class="form-label">Stagiaire</label>
                            <select name="id_stagiaire" id="id_stagiaire" class="form-control" required>
                                <option value="">Sélectionner un stagiaire</option>
                                @if(isset($stagiaires))
                                    @foreach($stagiaires as $stagiaire)
                                        <option value="{{ $stagiaire->ID_stagiaire }}" data-service="{{ $stagiaire->ID_service }}">
                                            {{ $stagiaire->nom }} {{ $stagiaire->prénom }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="id_encadrant" class="form-label">Encadrant</label>
                            <select name="id_encadrant" id="id_encadrant" class="form-control" required>
                                <option value="">Sélectionner un encadrant</option>
                                @if(isset($encadrants))
                                    @foreach($encadrants as $encadrant)
                                    <option value="{{ $encadrant->id }}" data-service="{{ $encadrant->ID_service }}">
                                        {{ $encadrant->nom }} {{ $encadrant->prenom }}
                                    </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-success">Ajouter Stage</button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            function filterOptions() {
                const serviceId = document.getElementById('ID_service').value;
                const stagiaireDropdown = document.getElementById('id_stagiaire');
                const encadrantDropdown = document.getElementById('id_encadrant');

                // Filter stagiaires
                Array.from(stagiaireDropdown.options).forEach(option => {
                    if (!option.value) return; // Skip the default "Select" option
                    
                    if (!serviceId || option.getAttribute('data-service') == serviceId) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                        if (option.selected) option.selected = false; // Deselect if hidden
                    }
                });
        
                // Filter encadrants
                Array.from(encadrantDropdown.options).forEach(option => {
                    if (!option.value) return; // Skip the default "Select" option
                    
                    if (!serviceId || option.getAttribute('data-service') == serviceId) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                        if (option.selected) option.selected = false; // Deselect if hidden
                    }
                });
            }
        
            // Call the function initially to filter options based on the selected service (if any)
            filterOptions();
        
            // Date Validation Function
            function validateDates() {
                const dateDebut = document.getElementById('date_début').value;
                const dateFin = document.getElementById('date_fin').value;
        
                if (dateDebut && dateFin && dateDebut >= dateFin) {
                    alert('La date de début doit être strictement avant la date de fin.');
                    return false; // Prevent form submission
                }
                return true; // Allow form submission
            }
        </script>
    </body>
    </html>
</x-app-layout>