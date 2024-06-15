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
        Schema::create('cand_job_licences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('candidate_job_id')->nullable();
            $table->bigInteger('candidate_id')->nullable();
            $table->enum('licence_type', ['indian', 'gulf'])->nullable();
            $table->string('licence_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cand_job_licences');
    }
};
