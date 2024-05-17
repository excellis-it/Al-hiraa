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
        Schema::create('assign_jobs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('candidate_id')->nullable();
            $table->bigInteger('job_id')->nullable();
            $table->bigInteger('company_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('interview_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_jobs');
    }
};
