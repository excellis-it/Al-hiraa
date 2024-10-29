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
        Schema::table('candidate_jobs', function (Blueprint $table) {
            $table->string('medical_expiry_date')->nullable()->after('medical_completion_date');
            $table->string('onboarding_flight_city')->nullable()->after('ticket_confirmation_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_jobs', function (Blueprint $table) {
            $table->dropColumn('medical_expiry_date');
            $table->dropColumn('onboarding_flight_city');
        });
    }
};
