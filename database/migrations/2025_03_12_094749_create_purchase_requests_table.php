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
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->string('pr_code');
            $table->foreignId('ppmp_id')->constrained('p_p_m_p_s');
            $table->string('purpose')->nullable();
            $table->bigInteger('is_submitted')->default(0);
            $table->dateTime('date_submitted')->nullable();
            $table->bigInteger('approval_status')->default(0);
            $table->dateTime('date_approved')->nullable();
            $table->foreignId('prepared_by')->constrained('users');
            $table->foreignId('college_office_unit_id')->constrained('college_office_units');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_requests');
    }
};
