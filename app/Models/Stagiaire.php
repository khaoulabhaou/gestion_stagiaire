<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stagiaire extends Model
{
    use HasFactory;

    // Custom primary key
    protected $primaryKey = 'ID_stagiaire';

    // Table name
    protected $table = 'stagiaire'; // Ensure this matches your table name

    // Disable timestamps if your table doesn't have `created_at` and `updated_at` columns
    public $timestamps = false;

    // Fillable attributes
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

    // Relationships
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'ID_etablissement'); 
    }
    
    public function service()
    {
        return $this->belongsTo(Service::class, 'ID_service'); 
    }
    public function stages()
    {
        return $this->hasMany(Stage::class, 'id_stagiaire', 'ID_stagiaire');
    }
    

    // Example: Archived scope (uncomment if needed)
    // public function stages()
    // {
    //     return $this->hasMany(Stage::class, 'ID_stagiaire');
    // }

    // public function scopeArchived($query)
    // {
    //     return $query->whereHas('stages', function ($q) {
    //         $q->where('date_fin', '<', now()); // Filter stages that have ended
    //     });
    // }
}