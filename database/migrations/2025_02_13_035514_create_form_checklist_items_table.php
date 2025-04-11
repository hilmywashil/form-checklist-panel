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
        Schema::create('form_checklist_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('panel_id')->constrained('form_checklist_panels')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('item_pemeriksaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_checklist_items');
    }
};
