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
            $table->string('passport_expiry', 50)->nullable()->after('passport_number');
            $table->string('ecr_type', 50)->nullable()->after('passport_expiry');
            $table->unsignedBigInteger('associate_id')->nullable()->after('ecr_type');
            // associate charge
            $table->decimal('associate_charge', 10, 2)->nullable()->after('salary');
            $table->foreign('associate_id')->nullable()->references('id')->on('associates')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_jobs', function (Blueprint $table) {
            $table->dropForeign(['associate_id']);
            $table->dropColumn(['passport_expiry', 'ecr_type', 'associate_id', 'associate_charge']);
        });
    }
};
