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
        'description',
        'ID_service',
        'id_stagiaire',
    ];

    // For Laravel 7 and below (deprecated in later versions)
    protected $dates = [
        'date_début',
        'date_fin',
    ];

    // For Laravel 8+ (recommended)
    protected $casts = [
        'date_début' => 'datetime:Y-m-d',
        'date_fin' => 'datetime:Y-m-d',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'ID_service');
    }
    
    public function stagiaire()
    {
        return $this->belongsTo(Stagiaire::class, 'id_stagiaire', 'ID_stagiaire');
    }

    public function encadrants()
    {
        return $this->belongsToMany(
            Encadrant::class,
            'encadrant_stagiaire',
            'ID_stagiaire',
            'ID_encadrants'
        );
    }
}