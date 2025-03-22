<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    protected $primaryKey = 'ID_etablissement'; 
    
    protected $table = 'etablissement';
    
    protected $fillable = ['nom_etablissement', 'ville', 'abréviation'];

    // Relationship with stagiaire
    public function stagiaire()
    {
        return $this->hasMany(Stagiaire::class, 'ID_etablissement');
    }
}
