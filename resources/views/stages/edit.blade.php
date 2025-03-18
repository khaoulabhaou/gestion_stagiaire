<x-app-layout>
    <header class="mt-5">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    </header>
    <div class="container">
        <h2>Modifier un Stage</h2>

        <form action="{{ route('stages.update', $stage->ID_stage) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-4 mb-3">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" name="titre" id="titre" class="form-control" value="{{ $stage->titre }}" required>
                </div>
                <div class="col-4">
                    <label for="date_début" class="form-label">Date de début</label>
                    <input type="date" name="date_début" id="date_début" class="form-control" value="{{ $stage->date_début }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="date_fin" class="form-label">Date de fin</label>
                    <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ $stage->date_fin }}" required>
                </div>
                <div class="col-4">
                    <label for="description" class="form-label">Description</label>
                    <textarea cols="10" rows="1" name="description" id="description" class="form-control" required>{{ $stage->description }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="ID_service" class="form-label">Service</label>
                    <select name="ID_service" id="ID_service" class="form-control" required>
                        @foreach($services as $service)
                            <option value="{{ $service->ID_service }}" {{ $stage->ID_service == $service->ID_service ? 'selected' : '' }}>
                                {{ $service->nom_service }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 mb-3">
                    <label for="id_stagiaire" class="form-label">Stagiaire</label>
                    <select name="id_stagiaire" id="id_stagiaire" class="form-control" required>
                        @foreach($stagiaires as $stagiaire)
                            <option value="{{ $stagiaire->ID_stagiaire }}" {{ $stage->id_stagiaire == $stagiaire->ID_stagiaire ? 'selected' : '' }}>
                                {{ $stagiaire->nom }} {{ $stagiaire->prénom }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</x-app-layout>