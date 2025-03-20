<x-app-layout>
    <header style="margin-top:5rem">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    </header>
    <div class="container">
        <h2>Ajouter un Stage</h2>

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

        <form action="{{ route('stages.store') }}" method="POST" class="container" onsubmit="return validateDates()">
            @csrf

            <div class="row mt-4">
                <div class="col-4 mb-3">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" name="titre" id="titre" class="form-control" required>
                </div>
                <div class="col-4">
                    <label for="date_debut" class="form-label">Date de début</label>
                    <input type="date" name="date_début" id="date_début" class="form-control" required>
                </div>
                <div class="col-4 mb-3">
                    <label for="date_fin" class="form-label">Date de fin</label>
                    <input type="date" name="date_fin" id="date_fin" class="form-control" required>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-4">
                    <label for="description" class="form-label">Description</label>
                    <textarea cols="10" rows="1" name="description" id="description" class="form-control" required></textarea>
                </div>
                <!-- Service (Foreign Key) -->
                <div class="col-4 mb-3">
                    <label for="ID_service" class="form-label">Service</label>
                    <select name="ID_service" id="ID_service" class="form-control" required onchange="filterStagiaires()">
                        <option value="">Sélectionner un service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->ID_service }}" {{ $selectedService == $service->ID_service ? 'selected' : '' }}>
                                {{ $service->nom_service }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Stagiaire (Foreign Key) -->
                <div class="col-4 mb-3">
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
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-success mt-4">Ajouter Stage</button>
        </form>
    </div>

    <!-- Add the filterStagiaires function here -->
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

        // Call the function initially to filter stagiaires based on the selected service (if any)
        filterStagiaires();

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
</x-app-layout>