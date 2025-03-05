<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('form_checklist_dailies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('panel_id')->constrained('form_checklist_panels')->onDelete('cascade');
            $table->string('item_pemeriksaan');
            $table->boolean('status')->default(false);
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_checklist_dailies');
    }
};
