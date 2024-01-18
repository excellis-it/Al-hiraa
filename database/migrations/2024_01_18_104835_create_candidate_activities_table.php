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
        Schema::create('candidate_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->nullable()->references('id')->on('candidates')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->text('remarks')->nullable();
            $table->string('call_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_activities');
    }
};
