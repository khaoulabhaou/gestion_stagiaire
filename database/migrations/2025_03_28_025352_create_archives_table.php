<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('stagiaire_nom');
            $table->string('stagiaire_prenom');
            $table->string('stagiaire_email');
            $table->string('stagiaire_telephone');
            $table->string('stagiaire_service');
            $table->string('stagiaire_etablissement');
            $table->string('encadrant_nom');
            $table->string('encadrant_prenom');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('archives');
    }
};
