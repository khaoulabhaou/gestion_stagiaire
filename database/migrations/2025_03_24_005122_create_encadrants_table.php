<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('encadrants', function (Blueprint $table) {
            $table->id('ID_encadrants'); // Custom primary key column name
            $table->string('nom', 100)->nullable(); // Matches your current schema
            $table->string('prénom', 100)->nullable(); // Matches your current schema
            $table->string('email', 100)->nullable(); // Matches your current schema
            $table->foreignId('ID_service')->nullable()->constrained('service', 'ID_service'); // Foreign key to services table
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encadrants');
    }
};