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
        Schema::create('candidate_field_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->nullable()->references('id')->on('candidates')->onDelete('cascade');
            $table->bigInteger('user_id')->nullable();
            $table->string('status')->nullable();
            $table->boolean('is_granted')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_field_updates');
    }
};
