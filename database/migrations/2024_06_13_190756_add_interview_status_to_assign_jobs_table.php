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
        Schema::table('assign_jobs', function (Blueprint $table) {
            $table->enum('interview_status', ['Selected', 'Rejected'])->nullable()->after('interview_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assign_jobs', function (Blueprint $table) {
            //
            $table->dropColumn('interview_status');
        });
    }
};
