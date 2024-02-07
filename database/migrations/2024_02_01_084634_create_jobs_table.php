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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->references('id')->on('companies')->onDelete('cascade');
            $table->bigInteger('candidate_position_id')->nullable();
            $table->string('job_name')->nullable();
            $table->string('duty_hours')->nullable();
            $table->string('contract')->nullable();
            $table->string('benifits')->nullable();
            $table->longText('job_description')->nullable();
            $table->enum('status',['Ongoing','Closed'])->default('Ongoing');
            $table->timestamps();
            $table->softDeletes()->comment('Deleted At');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
