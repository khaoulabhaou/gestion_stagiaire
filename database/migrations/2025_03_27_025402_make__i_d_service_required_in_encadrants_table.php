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
        Schema::table('encadrants', function (Blueprint $table) {
            // Remove nullable() and add constrained() properly
            $table->foreignId('ID_service')
                  ->nullable(false) // Makes the column REQUIRED
                  ->constrained('service', 'ID_service')
                  ->change();
        });
    }
    
    public function down()
    {
        Schema::table('encadrants', function (Blueprint $table) {
            $table->dropForeign(['ID_service']);
            $table->foreignId('ID_service')->nullable()->change();
        });
    }
};
