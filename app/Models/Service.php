<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'service'; // Table name
    protected $primaryKey = 'ID_service'; // Primary key

    public $timestamps = false; // Disable timestamps if not using created_at & updated_at

    // Relationship with Stage
    public function stages()
    {
        return $this->hasMany(Stage::class, 'ID_service');
    }
}