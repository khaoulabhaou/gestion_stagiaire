<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id('ID_stage');
            $table->string('titre');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->text('description');
            $table->foreignId('ID_service')->constrained('services')->onDelete('cascade');
            $table->foreignId('ID_stagiaire')->constrained('stagiaires')->onDelete('cascade');
            $table->timestamps(); // Add timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};