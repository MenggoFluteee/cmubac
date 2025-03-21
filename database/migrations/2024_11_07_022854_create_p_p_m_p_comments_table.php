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
        Schema::create('p_p_m_p_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppmp_id')->constrained('p_p_m_p_s');
            $table->string('comment');
            $table->foreignId('from_user')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_p_m_p_comments');
    }
};
