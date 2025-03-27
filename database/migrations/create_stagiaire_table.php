<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatestagiaireTable extends Migration
{
    public function up()
    {
        Schema::create('stagiaire', function (Blueprint $table) {
            $table->id('ID_stagiaire');
            $table->string('nom');
            $table->string('prénom');
            $table->string('email');
            $table->string('téléphone');
            $table->date('date_naissance');
            $table->string('niveau');
            $table->string('specialite');
            $table->foreignId('ID_service')->constrained('service'); // Clé étrangère vers service
            $table->foreignId('ID_etablissement')->constrained('etablissement'); // Clé étrangère vers etablissements
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stagiaires');
    }

}