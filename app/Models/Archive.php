<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $table = 'archives';
    protected $fillable = [
        'stagiaire_nom',
        'stagiaire_prenom',
        'stagiaire_email',
        'stagiaire_telephone',
        'stagiaire_service',
        'stagiaire_etablissement',
        'encadrant_nom',
        'encadrant_prenom',
    ];
}
