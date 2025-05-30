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
        Schema::create('form_checklist_panels', function (Blueprint $table) {
            $table->id();
            $table->string('nama_panel');
            $table->foreignId('lokasi')->constrained('lokasis')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_pekerjaan')->nullable();
            $table->string('nomor_spk', 100)->nullable();
            $table->date('tanggal_spk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_checklist_panels');
    }
};
