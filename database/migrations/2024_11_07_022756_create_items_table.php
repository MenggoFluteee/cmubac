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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->string('item_code')->nullable();
            $table->string('item_description');
            $table->string('unit_of_measure');
            $table->bigInteger('is_available');
            $table->bigInteger('is_psdbm');
            $table->foreignId('item_category_id')->constrained('item_categories');
            $table->foreignId('account_code_id')->nullable()->constrained('account_codes');
            $table->foreignId('added_by')->constrained('users');
            $table->boolean('is_psdbm_approved')->default(0);
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
