<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Stage;
use App\Models\Archive;
use Carbon\Carbon;

class ArchiveExpiredStages extends Command
{
    protected $signature = 'stages:archive';
    protected $description = 'Move expired stages to the archive table';

    public function handle()
    {
        $expiredStages = Stage::where('date_fin', '<', Carbon::now())->get();

        foreach ($expiredStages as $stage) {
            $stagiaire = $stage->stagiaire;
            $encadrant = $stagiaire->encadrant ?? null; // Assuming Stagiaire has an Encadrant relationship

            Archive::create([
                'stagiaire_nom' => $stagiaire->nom,
                'stagiaire_prenom' => $stagiaire->prenom,
                'stagiaire_email' => $stagiaire->email,
                'stagiaire_telephone' => $stagiaire->telephone ?? 'N/A',
                'stagiaire_service' => $stagiaire->service->nom_service ?? 'N/A',
                'stagiaire_etablissement' => $stagiaire->etablissement->nom_etablissement ?? 'N/A',
                'encadrant_nom' => $encadrant ? $encadrant->nom : 'N/A',
                'encadrant_prenom' => $encadrant ? $encadrant->prenom : 'N/A',
            ]);

            $stage->delete(); // Remove from stages table
        }

        $this->info('Expired stages have been archived successfully.');
    }
}
