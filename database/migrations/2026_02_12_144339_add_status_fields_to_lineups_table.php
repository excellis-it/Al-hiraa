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
        Schema::table('lineups', function (Blueprint $table) {
            $table->bigInteger('status_updated_by')->nullable()->after('interview_status');
            $table->text('status_remarks')->nullable()->after('status_updated_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lineups', function (Blueprint $table) {
            $table->dropColumn(['status_updated_by', 'status_remarks']);
        });
    }
};
