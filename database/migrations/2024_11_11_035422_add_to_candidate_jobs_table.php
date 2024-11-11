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
            $table->string('medical_approval_date')->nullable()->after('medical_application_date');
            $table->string('courrier_sent_date')->nullable()->after('medical_repeat_date');
            $table->string('courrier_received_date')->nullable()->after('courrier_sent_date');
            // mofa_date
            $table->string('mofa_received_date')->nullable()->after('mofa_date');
            // vfs_date
            $table->string('vfs_applied_date')->nullable()->after('mofa_date');
            $table->string('vfs_received_date')->nullable()->after('vfs_applied_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_jobs', function (Blueprint $table) {
            $table->dropColumn('medical_approval_date');
            $table->dropColumn('courrier_sent_date');
            $table->dropColumn('courrier_received_date');
            $table->dropColumn('mofa_received_date');
            $table->dropColumn('vfs_applied_date');
            $table->dropColumn('vfs_received_date');
            
        });
    }
};
