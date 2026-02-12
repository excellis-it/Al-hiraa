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
        Schema::create('lineup_status_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lineup_id')->constrained()->onDelete('cascade');
            $table->string('status');
            $table->text('remarks')->nullable();
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lineup_status_logs');
    }
};
