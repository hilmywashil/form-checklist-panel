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
        Schema::table('form_checklist_dailies', function (Blueprint $table) {
            $table->string('image')->nullable()->after('teknisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_checklist_dailies', function (Blueprint $table) {
            //
        });
    }
};
