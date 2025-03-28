<x-app-layout>
    <header style="margin-top: 2.5rem">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    </header>

    <div class="container text-center">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('encadrants.create') }}" class="btn btn-success" style="margin-right: 7px">
                <i class="fa-solid fa-user-plus"></i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-success">
                    <tr>
                        <th class="text-center">Nom</th>
                        <th class="text-center">Prénom</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Service</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($encadrants as $encadrant)
                        <tr>
                            <td class="align-middle">{{ $encadrant->nom }}</td>
                            <td class="align-middle">{{ $encadrant->prenom }}</td>
                            <td class="align-middle">{{ $encadrant->email }}</td>
                            <td class="text-center align-middle">{{ $encadrant->service->nom_service}}</td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('encadrants.edit', $encadrant->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="{{ route('encadrants.destroy', $encadrant->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet encadrant ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>