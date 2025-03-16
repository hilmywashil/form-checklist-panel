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
        Schema::create('form_checklist_daily_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_checklist_daily_id')->constrained('form_checklist_dailies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('form_checklist_item_id')->constrained('form_checklist_items')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('kondisi', ['baik', 'tidak baik']);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_checklist_daily_items');
    }
};
