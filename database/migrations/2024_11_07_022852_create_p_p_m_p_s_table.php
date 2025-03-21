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
        Schema::create('p_p_m_p_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('budget_allocation_id')->constrained('budget_allocations');
            $table->foreignId('created_by')->constrained('users');
            $table->string('ppmp_code')->nullable(false);
            $table->bigInteger('is_submitted');
            $table->bigInteger('approval_status');
            $table->bigInteger('incrementing_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_p_m_p_s');
    }
};
