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

        
    }

    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->nullable(); // Si tu veux restaurer la colonne au cas où.
        });
    }

};
