<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('encadrants', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('nom', 100)->nullable();
            $table->string('prenom', 100)->nullable();
            $table->string('email', 100)->nullable()->unique();
            $table->foreignId('ID_service')
                  ->constrained('service', 'ID_service') // Requires existing service
                  ->onDelete('restrict'); // Prevents deletion if encadrants exist
            $table->timestamps(); // created_at + updated_at
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
