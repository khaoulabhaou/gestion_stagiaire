<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Step 1: Backfill NULL values with a default service (e.g., ID=1)
        DB::table('encadrants')
            ->whereNull('ID_service')
            ->update(['ID_service' => 1]); // Replace `1` with a valid service ID
    
        // Step 2: Alter column to be NOT NULL
        Schema::table('encadrants', function (Blueprint $table) {
            $table->foreignId('ID_service')
                ->nullable(false)
                ->constrained('service', 'ID_service')
                ->change();
        });
    }
    
    public function down()
    {
        // Revert changes if migration is rolled back
        Schema::table('encadrants', function (Blueprint $table) {
            $table->dropForeign(['ID_service']);
            $table->foreignId('ID_service')->nullable()->change();
        });
    }
};
