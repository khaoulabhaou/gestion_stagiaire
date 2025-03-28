<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'service';
    protected $primaryKey = 'ID_service';
    protected $fillable = ['nom_service'];
    public $timestamps = false;

    public function encadrants()
    {
        return $this->hasMany(Encadrant::class, 'ID_service', 'ID_service');
    }

    public function stages()
    {
        return $this->hasMany(Stage::class, 'ID_service', 'ID_service');
    }
}