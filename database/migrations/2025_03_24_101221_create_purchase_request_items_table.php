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
        Schema::create('purchase_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_request_id')->constrained('purchase_requests');
            $table->foreignId('item_id')->constrained('items');
            $table->bigInteger('status')->default(0);
            $table->integer('january_quantity');
            $table->integer('february_quantity');
            $table->integer('march_quantity');
            $table->integer('april_quantity');
            $table->integer('may_quantity');
            $table->integer('june_quantity');
            $table->integer('july_quantity');
            $table->integer('august_quantity');
            $table->integer('september_quantity');
            $table->integer('october_quantity');
            $table->integer('november_quantity');
            $table->integer('december_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_request_items');
    }
};
