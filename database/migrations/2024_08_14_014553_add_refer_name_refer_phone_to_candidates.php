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
        Schema::table('candidates', function (Blueprint $table) {
            //
            $table->string('refer_name')->nullable()->after('referred_by');
            $table->string('refer_phone')->nullable()->after('refer_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            //
            $table->dropColumn('refer_name');
            $table->dropColumn('refer_phone');
        });
    }
};
