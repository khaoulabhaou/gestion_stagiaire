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
        </div>

        <!-- Search and Add Button Row -->
        <div class="d-flex justify-content-between mb-3">
            <!-- Search Bar -->
            <div class="col-md-4">
                <form action="{{ route('archive') }}" method="GET">
                    <div class="input-group">
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Rechercher..." 
                               value="{{ request('search') }}">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('archive') }}" class="btn btn-outline-danger">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
            
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
                            <th class="text-center">Période de Stage</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($archivedStagiaires as $stagiaire)
                        <tr>
                            <td class="text-center align-middle">{{ $stagiaire->nom }} {{ $stagiaire->prénom }}</td>
                            <td class="text-center align-middle">{{ $stagiaire->email }}</td>
                            <td class="text-center align-middle">{{ $stagiaire->téléphone }}</td>
                            <td class="text-center align-middle">{{ $stagiaire->service->nom_service ?? 'N/A' }}</td>
                            <td class="text-center align-middle">{{ $stagiaire->etablissement->nom_etablissement ?? 'N/A' }}</td>
                            <td class="text-center align-middle">
                                @foreach($stagiaire->stages as $stage)
                                    <div class="stage-period">
                                        {{ \Carbon\Carbon::parse($stage->date_début)->format('d/m/Y') }} - 
                                        {{ \Carbon\Carbon::parse($stage->date_fin)->format('d/m/Y') }}
                                    </div>
                                @endforeach
                            </td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Modify Button -->
                                    <a href="{{ route('archives.edit', $stagiaire->ID_stagiaire) }}" title="Modifier">
                                        {{-- <i class="fa-solid fa-pen-to-square"></i> --}}
                                        <style>
                                            .text-success.nav-link{
                                                text-decoration: none;
                                            }
                                            .text-success.nav-link:hover{
                                                text-decoration: underline;
                                            }
                                        </style>
                                        <p class="text-success nav-link">Modifier</p>
                                    </a>
                                    
                                </div>
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
                    <!-- Pagination -->
                    @if($archivedStagiaires->total() > $archivedStagiaires->perPage())
                    <div class="mt-3">
                        {{ $archivedStagiaires->appends(['search' => request('search')])->links('vendor.pagination.bootstrap-5') }}
                    </div>
                    @endif
    </div>

</x-app-layout>