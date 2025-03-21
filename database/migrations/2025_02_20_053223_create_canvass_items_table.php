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
        Schema::create('canvass_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('canvass_id')->constrained('canvasses');
            $table->string('item_name');
            $table->string('item_description');
            $table->string('unit_of_measure');
            $table->integer('quantity');
            $table->double('price');
            $table->string('file_attachment_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canvass_items');
    }
};
