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
        Schema::create('form_checklist_dailies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_checklist_panel_id')->constrained('form_checklist_panels')->onDelete('cascade');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_checklist_dailies');
    }
};
