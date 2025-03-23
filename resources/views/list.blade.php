<x-app-layout>   
    <body style="padding: 0" class="mt-5">
    <div class="container mt-5" style="padding: 0; margin: 0 0 0 4rem; font-size: 1rem;">
        {{-- <h2 class="text-center mb-4" style="font-size: 2rem">Liste des Stagiaires</h2> --}}

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Button to add a new stagiaire -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('stagiaires.create') }}" class="btn btn-success" style="margin-right: 7px">
                <i class="fa-solid fa-user-plus"></i>
            </a>
        </div>

        <!-- Wrap the table in a scrollable container -->
        <div style="overflow-x: auto;">
            <table class="table table-bordered table-hover table-sm">
                <thead class="table-success">
                    <tr>
                        <th class="text-center">Stagiaire</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Téléphone</th>
                        <th class="text-center">Niveau</th>
                        <th class="text-center">Établissement</th>
                        <th class="text-center">Ville</th>
                        <th class="text-center">Service</th>
                        <th class="text-center">Spécialité</th>
                        <th class="text-center">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stagiaires as $stagiaire)
                    <tr>
                        <td class="text-center align-middle">{{ $stagiaire->nom }} {{ $stagiaire->prénom }}</td>
                        <td class="text-center align-middle">{{ $stagiaire->email }}</td>
                        <td class="text-center align-middle">{{ $stagiaire->téléphone }}</td>
                        <td class="text-center align-middle">{{ $stagiaire->niveau }}</td>
                        <td class="text-center align-middle">{{ optional($stagiaire->etablissement)->abréviation }}</td>
                        <td class="text-center align-middle">{{ optional($stagiaire->etablissement)->ville }}</td>
                        <td class="text-center align-middle">{{ optional($stagiaire->service)->nom_service }}</td>
                        <td class="text-center align-middle">{{ $stagiaire->specialite }}</td>
                        <td class="text-center align-middle">
                            <div style="display: flex; justify-content: center; gap: 5px;">
                                <a href="{{ route('stagiaires.edit', $stagiaire->ID_stagiaire) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>        
                                <form action="{{ route('stagiaires.destroy', $stagiaire->ID_stagiaire) }}" method="POST" onsubmit="return testDelete();">
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

    {{-- <script>
        function testDelete() {
            return confirm("Are you sure you want to delete?");
        }
    </script> --}}

    </body>
</x-app-layout>
