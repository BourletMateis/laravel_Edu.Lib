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
        Schema::table('appointments', function($table) {
            $table->dropColumn('end_time');
        });
        Schema::table('appointments', function($table) {
            $table->dropColumn('start_time');
        });

        Schema::table('appointments', function($table) {
            $table->Time("start_time")->after('date');
        });

        Schema::table('appointments', function($table) {
            $table->Time("end_time")->after('start_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
