<x-app-layout>
    <header style="margin-top:5rem">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </header>

    <div class="container-fluid custom-container">
        <div class="card p-4 shadow" style="max-width: 1200px; margin: 0 auto; height: 55vh">
            <h2 class="text-center mb-4">Modifier un Stage</h2>

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

            <form action="{{ route('stages.update', $stage->ID_stage) }}" style="margin-top: 2rem" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" name="titre" id="titre" class="form-control" value="{{ $stage->titre }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="date_début" class="form-label">Date de début</label>
                        <input type="date" name="date_début" id="date_début" class="form-control" value="{{ $stage->date_début }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="date_fin" class="form-label">Date de fin</label>
                        <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ $stage->date_fin }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea cols="10" rows="1" name="description" id="description" class="form-control" required>{{ $stage->description }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="ID_service" class="form-label">Service</label>
                        <select name="ID_service" id="ID_service" class="form-control" required>
                            @foreach($services as $service)
                                <option value="{{ $service->ID_service }}" {{ $stage->ID_service == $service->ID_service ? 'selected' : '' }}>
                                    {{ $service->nom_service }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="id_stagiaire" class="form-label">Stagiaire</label>
                        <select name="id_stagiaire" id="id_stagiaire" class="form-control" required>
                            @foreach($stagiaires as $stagiaire)
                                <option value="{{ $stagiaire->ID_stagiaire }}" 
                                        data-service="{{ $stagiaire->ID_service }}" 
                                        {{ $stage->id_stagiaire == $stagiaire->ID_stagiaire ? 'selected' : '' }}>
                                    {{ $stagiaire->nom }} {{ $stagiaire->prénom }}
                                </option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success">Mettre à Jour</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function filterStagiaires() {
            const serviceId = document.getElementById('ID_service').value;
            const stagiaireDropdown = document.getElementById('id_stagiaire');
    
            // Enable all options first
            Array.from(stagiaireDropdown.options).forEach(option => {
                option.style.display = 'block';
            });
    
            // Hide options that don't match the selected service
            if (serviceId) {
                Array.from(stagiaireDropdown.options).forEach(option => {
                    if (option.value && option.getAttribute('data-service') !== serviceId) {
                        option.style.display = 'none';
                    }
                });
            }
        }
    
        // Call the function initially to filter stagiaires based on the selected service
        window.onload = function () {
            filterStagiaires();
        };
    
        // Also, update the list when the service is changed
        document.getElementById('ID_service').addEventListener('change', filterStagiaires);
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
