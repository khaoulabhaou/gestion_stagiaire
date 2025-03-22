<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encadrant extends Model
{
    use HasFactory;

    protected $table = 'encadrants'; // Assure-toi que cela correspond au nom de ta table

    protected $fillable = ['nom', 'prenom', 'email']; // Ajoute les colonnes autorisées
}
