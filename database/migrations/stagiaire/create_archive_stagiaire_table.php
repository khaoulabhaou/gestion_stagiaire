<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchiveStagiareTable extends Migration
{

// public function up()
// {
//     Schema::create('archived_stagiaires', function (Blueprint $table) {
//         $table->id('ID_stagiaire');
//         $table->string('nom');
//         $table->string('prénom');
//         $table->string('email')->unique();
//         $table->string('téléphone');
//         $table->date('date_naissance');
//         $table->foreignId('ID_service')->constrained('services');
//         $table->foreignId('ID_etablissement')->constrained('etablissements');
//         $table->string('niveau');
//         $table->string('specialite');
//         $table->timestamps();
//     });
// }
}