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
        Schema::create('candidate_jobs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('candidate_id')->nullable();
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
            $table->bigInteger('assign_by_id')->nullable();
            $table->bigInteger('job_id')->nullable();
            $table->string('job_position')->nullable();
            $table->string('job_location')->nullable();
            $table->bigInteger('company_id')->nullable();
            $table->string('date_of_interview')->nullable();
            $table->string('date_of_selection')->nullable();
            $table->string('mode_of_selection')->nullable();
            $table->string('interview_location')->nullable();
            $table->string('client_remarks')->nullable();
            $table->string('other_remarks')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('country')->nullable();
            $table->string('salary')->nullable();
            $table->string('food_allowance')->nullable();
            $table->string('contract_duration')->nullable();
            $table->string('mofa_no')->nullable();
            $table->string('mofa_date')->nullable();
            $table->string('family_contact_name')->nullable();
            $table->string('family_contact_no')->nullable();
            $table->string('medical_application_date')->nullable();
            $table->string('medical_completion_date')->nullable();
            $table->string('medical_status')->nullable();
            $table->string('visa_receiving_date')->nullable();
            $table->string('visa_issue_date')->nullable();
            $table->string('visa_expiry_date')->nullable();
            $table->string('ticket_booking_date')->nullable();
            $table->string('ticket_confirmation_date')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('fst_installment_amount')->nullable();
            $table->string('fst_installment_date')->nullable();
            $table->string('secnd_installment_amount')->nullable();
            $table->string('secnd_installment_date')->nullable();
            $table->string('third_installment_amount')->nullable();
            $table->string('third_installment_date')->nullable();
            $table->string('fourth_installment_amount')->nullable();
            $table->string('fourth_installment_date')->nullable();
            $table->string('deployment_date')->nullable();
            $table->enum('job_status', ['Active', 'Deactive'])->default('Active');
            $table->enum('job_interview_status', ['Selected', 'Rejected'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_jobs');
    }
};
