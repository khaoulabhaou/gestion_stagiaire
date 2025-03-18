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
        'date_début',
        'date_fin',
        'description',
        'ID_service',
        'id_stagiaire',
    ];

    // Relationship with Service
    public function service()
    {
        return $this->belongsTo(Service::class, 'ID_service');
    }
    
    public function stagiaire()
    {
        return $this->belongsTo(Stagiaire::class, 'id_stagiaire');
    }

}
