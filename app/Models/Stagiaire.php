<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    use HasFactory;

    protected $table = 'stagiaire';
    protected $primaryKey = 'ID_stagiaire';
    public $timestamps = true;

    protected $fillable = [
        'nom',
        'prénom',
        'email',
        'téléphone',
        'date_naissance',
        'ID_service',
        'ID_etablissement',
        'niveau',
        'specialite'
    ];

    // Relationship with Etablissement
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'ID_etablissement', 'ID_etablissement');
    }

    // Relationship with Service
    public function service()
    {
        return $this->belongsTo(Service::class, 'ID_service', 'ID_service');
    }

    // Relationship with Stages (as primary stagiaire)
    public function stages()
    {
        return $this->hasMany(Stage::class, 'ID_stagiaire', 'ID_stagiaire');
    }

    // Relationship with Encadrants through encadrant_stagiaire
    public function encadrants()
    {
        return $this->belongsToMany(
            Encadrant::class,
            'encadrant_stagiaire',
            'ID_stagiaire',
            'ID_encadrants'
        )->withPivot('ID_stage');
    }
}