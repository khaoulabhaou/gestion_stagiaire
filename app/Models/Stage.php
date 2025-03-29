<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $table = 'stages';
    protected $primaryKey = 'ID_stage';
    public $timestamps = false;

    protected $fillable = [
        'titre',
        'date_début',
        'date_fin',
        'ID_service',
        'id_stagiaire',
        'ID_encadrant',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'ID_service');
    }
    
    public function stagiaire()
    {
        return $this->belongsTo(Stagiaire::class, 'id_stagiaire');
    }

    public function encadrants()
    {
        return $this->belongsToMany(
            Encadrant::class, 
            'responsable_stages', 
            'ID_stage', 
            'ID_encadrants',
        );
    }
    
}