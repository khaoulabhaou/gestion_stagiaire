<x-app-layout>
    <div class="container mt-5" style="padding: 0; font-size: 1rem;">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>  
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-center mx-auto">Stagiaires Archivés : {{ $archivedStagiaires->count() }}</h2>
            <a href="{{ route('list') }}" class="btn btn-success">
                <i class="fa-solid fa-arrow-left"></i> Retour
            </a>
        </div>

        @if($archivedStagiaires->count() > 0)
            <div style="overflow-x: auto;">
                <table class="table table-bordered table-hover table-sm">
                    <thead class="table-success">
                        <tr>
                            <th class="text-center">Nom & Prénom</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Téléphone</th>
                            <th class="text-center">Service</th>
                            <th class="text-center">Établissement</th>
                            <th class="text-center">Date Fin Stage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($archivedStagiaires as $stagiaire)
                        <tr>
                            <td class="text-center align-middle">{{ $stagiaire->nom }} {{ $stagiaire->prénom }}</td>
                            <td class="text-center align-middle">{{ $stagiaire->email }}</td>
                            <td class="text-center align-middle">{{ $stagiaire->téléphone }}</td>
                            <td class="text-center align-middle">{{ $stagiaire->service->nom_service ?? 'N/A' }}</td>
                            <td class="text-center align-middle">{{ $stagiaire->etablissement->abréviation ?? 'N/A' }}</td>
                            <td class="text-center align-middle">
                                @foreach($stagiaire->stages as $stage)
                                    {{ \Carbon\Carbon::parse($stage->date_fin)->format('d/m/Y') }}
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center">
                Aucun stagiaire archivé trouvé
            </div>
        @endif
    </div>
</x-app-layout>