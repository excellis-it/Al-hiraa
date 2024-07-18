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
        Schema::create('candidate_referral_points', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('refer_candidate_id')->nullable();
            $table->bigInteger('referrer_candidate_id')->nullable();
            $table->bigInteger('refer_point_id')->nullable();
            $table->string('refer_point')->nullable();
            $table->bigInteger('refer_job_id')->nullable();
            $table->string('amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_referral_points');
    }
};
