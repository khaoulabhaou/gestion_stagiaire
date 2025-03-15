<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $table = 'stages'; // Table name

    protected $primaryKey = 'ID_stage'; // Primary key

    public $timestamps = false; // Disable timestamps if not using created_at & updated_at

    protected $fillable = [
        'titre',
        'date_debut',
        'date_fin',
        'description',
        'ID_service',
        'ID_stagiaire',
    ];

    // Relationship with Service
    public function service()
    {
        return $this->belongsTo(Service::class, 'ID_service');
    }

    // Relationship with Stagiaire
    public function stagiaire()
    {
        return $this->belongsTo(Stagiaire::class, 'ID_stagiaire');
    }
}
