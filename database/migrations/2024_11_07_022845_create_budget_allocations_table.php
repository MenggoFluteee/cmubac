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
        Schema::create('budget_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('college_office_unit_id')->constrained('college_office_units');
            $table->foreignId('whole_budget_id')->constrained('whole_budgets');
            $table->double('amount');
            $table->foreignId('allocated_by')->constrained('users');
            $table->foreignId('account_code_id')->constrained('account_codes');
            $table->dateTime('date_allocated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_allocations');
    }
};
