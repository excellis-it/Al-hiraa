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
            $table->string('discount')->nullable()->after('fourth_installment_date');

            // Adding 'job_service_charge' as a decimal column with 8 digits and 2 decimal places
            $table->string('job_service_charge')->nullable()->after('vendor_service_charge');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_jobs', function (Blueprint $table) {
            $table->dropColumn('discount');
            $table->dropColumn('job_service_charge');
        });
    }
};
