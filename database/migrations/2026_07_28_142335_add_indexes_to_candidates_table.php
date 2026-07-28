<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('enter_by');
            $table->index('cnadidate_status_id');
        });

        // position_applied_for_* are TEXT columns, which MySQL can only
        // index with an explicit prefix length via raw SQL.
        DB::statement('ALTER TABLE candidates ADD INDEX candidates_position_applied_for_1_index (position_applied_for_1(20))');
        DB::statement('ALTER TABLE candidates ADD INDEX candidates_position_applied_for_2_index (position_applied_for_2(20))');
        DB::statement('ALTER TABLE candidates ADD INDEX candidates_position_applied_for_3_index (position_applied_for_3(20))');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['enter_by']);
            $table->dropIndex(['cnadidate_status_id']);
            $table->dropIndex('candidates_position_applied_for_1_index');
            $table->dropIndex('candidates_position_applied_for_2_index');
            $table->dropIndex('candidates_position_applied_for_3_index');
        });
    }
};
