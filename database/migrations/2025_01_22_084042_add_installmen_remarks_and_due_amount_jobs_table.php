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
            $table->string('due_amount')->nullable()->after('total_amount');

            // Adding 'job_service_charge' as a decimal column with 8 digits and 2 decimal places
            $table->text('fst_installment_remarks')->nullable()->after('fst_installment_date');
            $table->text('secnd_installment_remarks')->nullable()->after('secnd_installment_date');
            $table->text('third_installment_remarks')->nullable()->after('third_installment_date');
            $table->text('fourth_installment_remarks')->nullable()->after('fourth_installment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_jobs', function (Blueprint $table) {
            $table->dropColumn('due_amount');
            $table->dropColumn('fst_installment_remarks');
            $table->dropColumn('secnd_installment_remarks');
            $table->dropColumn('third_installment_remarks');
            $table->dropColumn('fourth_installment_remarks');
        });
    }
};
