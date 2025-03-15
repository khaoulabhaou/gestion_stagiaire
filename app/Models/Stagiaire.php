<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    use HasFactory;

    protected $table = 'stagiaire'; // Table name
    protected $primaryKey = 'ID_stagiaire'; // Primary key

    public $timestamps = false; // Disable timestamps if not using created_at & updated_at

    // Relationship with Stage
    public function stages()
    {
        return $this->hasMany(Stage::class, 'ID_stagiaire');
    }
}