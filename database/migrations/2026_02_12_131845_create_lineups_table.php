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
        Schema::create('lineups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('candidate_id')->nullable();
            $table->bigInteger('vendor_id')->nullable();
            $table->bigInteger('interview_id')->nullable();
            $table->bigInteger('company_id')->nullable();
            $table->bigInteger('assign_by_id')->nullable();
            $table->bigInteger('job_id')->nullable();

            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('whatapp_no')->nullable();
            $table->string('alternate_contact_no')->nullable();
            $table->string('religion')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('education')->nullable();
            $table->string('other_education')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('english_speak')->nullable();
            $table->string('arabic_speak')->nullable();


            $table->string('job_position')->nullable();
            $table->string('job_location')->nullable();

            $table->string('date_of_interview')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lineups');
    }
};
