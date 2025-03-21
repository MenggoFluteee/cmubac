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
        Schema::create('requested_item_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requested_item_id')->constrained('requested_items');
            $table->string('company_name');
            $table->string('company_contact_no');
            $table->double('item_price');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requested_item_attachments');
    }
};
