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
        'ID_stagiaire'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'ID_service', 'ID_service');
    }

    public function stagiaire()
    {
        return $this->belongsTo(Stagiaire::class, 'ID_stagiaire', 'ID_stagiaire');
    }

    public function responsables()
    {
        return $this->belongsToMany(
            Encadrant::class,
            'responsable_stages', 
            'ID_stage',
            'ID_encadrants'
        );
    }
    public function encadrants()
    {

        return $this->responsables();

        return $this->supervisingEncadrants();
    }

    public function supervisingEncadrants()
    {
        return $this->belongsToMany(
            Encadrant::class,
            'encadrant_stagiaire',
            'ID_stage',
            'ID_encadrants'
        )->withPivot('ID_stagiaire');
    }

    public function allEncadrants()
    {
        $responsables = $this->responsables;
        $supervisors = $this->supervisingEncadrants;
        return $responsables->merge($supervisors)->unique('id');
    }
}