<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EncadrantStagiaire extends Pivot
{
    protected $table = 'encadrant_stagiaire';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'ID_encadrants',
        'ID_stagiaire',
        'ID_stage'
    ];

    // Relationship with Encadrant
    public function encadrant()
    {
        return $this->belongsTo(Encadrant::class, 'ID_encadrants', 'id');
    }

    // Relationship with Stagiaire
    public function stagiaire()
    {
        return $this->belongsTo(Stagiaire::class, 'ID_stagiaire', 'ID_stagiaire');
    }

    // Relationship with Stage
    public function stage()
    {
        return $this->belongsTo(Stage::class, 'ID_stage', 'ID_stage');
    }
}