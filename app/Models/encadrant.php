<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encadrant extends Model
{
    use HasFactory;

    protected $table = 'encadrants';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'ID_service'
    ];

    // Relationship with Service
    public function service()
    {
        return $this->belongsTo(Service::class, 'ID_service', 'ID_service');
    }

    // Relationship with Stages through responsable_stages
    public function responsibleStages()
    {
        return $this->belongsToMany(
            Stage::class,
            'responsable_stages',
            'ID_encadrants',
            'ID_stage'
        );
    }

    // Relationship with Stagiaires through encadrant_stagiaire
    public function supervisedStagiaires()
    {
        return $this->belongsToMany(
            Stagiaire::class,
            'encadrant_stagiaire',
            'ID_encadrants',
            'ID_stagiaire'
        )->withPivot('ID_stage');
    }

    // Relationship with Stages through encadrant_stagiaire
    public function supervisedStages()
    {
        return $this->belongsToMany(
            Stage::class,
            'encadrant_stagiaire',
            'ID_encadrants',
            'ID_stage'
        )->withPivot('ID_stagiaire');
    }
}