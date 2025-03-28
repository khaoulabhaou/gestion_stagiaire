<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encadrant extends Model
{
    use HasFactory;

    protected $table = 'encadrants';
    protected $fillable = ['nom', 'prenom', 'email', 'ID_service'];
    
    // Add this relationship
    public function service()
    {
        return $this->belongsTo(Service::class, 'ID_service', 'ID_service');
    }
    public function stages()
    {
        return $this->belongsToMany(
            Stage::class, 
            'encadrant_stagiaire', 
            'ID_encadrants', 
            'ID_stage'
        );
    }
    
}