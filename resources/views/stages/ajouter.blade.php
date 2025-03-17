<x-app-layout>

<header class="mt-5">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
</header>
<div class="container">
    <h2>Ajouter un Stage</h2>

    <form action="{{ route('stages.store') }}" method="POST" class="container">
        @csrf

        <div class="row">
            <div class="col-4 mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" name="titre" id="titre" class="form-control" required>
            </div>
            <div class="col-4">
                <label for="date_debut" class="form-label">Date de début</label>
                <input type="date" name="date_debut" id="date_debut" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-4 mb-3">
                <label for="date_fin" class="form-label">Date de fin</label>
                <input type="date" name="date_fin" id="date_fin" class="form-control" required>
            </div>
            <div class="col-4">
                <label for="description" class="form-label">Description</label>
                <textarea cols="10" rows="1" name="description" id="description" class="form-control" required></textarea>
            </div>
        </div>
        <!-- Service (Foreign Key) -->
        <div class="row">
            <div class="col-4 mb-3">
                <label for="ID_service" class="form-label">Service</label>
                <select name="ID_service" id="ID_service" class="form-control" required>
                    <option value="">Sélectionner un service</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ $selectedService == $service->id ? 'selected' : '' }}>
                            {{ $service->nom_service }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Stagiaire (Foreign Key) -->
            <div class="col-4 mb-3">
                <label for="ID_stagiaire" class="form-label">Stagiaire</label>
                <select name="ID_stagiaire" id="ID_stagiaire" class="form-control" required>
                    <option value="">Sélectionner un stagiaire</option>
                    @if(isset($stagiaires))
                        @foreach($stagiaires as $stagiaire)
                            <option value="{{ $stagiaire->id }}">{{ $stagiaire->nom }} {{ $stagiaire->prénom }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Ajouter Stage</button>
    </form>
</div>
</x-app-layout>