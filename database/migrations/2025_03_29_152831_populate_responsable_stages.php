<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::table('responsable_stages', function (Blueprint $table) {
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::table('responsable_stages', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
