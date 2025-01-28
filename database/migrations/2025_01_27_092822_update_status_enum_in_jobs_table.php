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
        DB::statement("ALTER TABLE candidate_jobs MODIFY COLUMN job_interview_status ENUM('Interested', 'Not-Interested', 'Selected', 'Not-Appeared', 'Appeared') NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE candidate_jobs MODIFY COLUMN job_interview_status ENUM('Interested', 'Not-Interested', 'Selected', 'Not-Appeared') NULL");
    }
};
