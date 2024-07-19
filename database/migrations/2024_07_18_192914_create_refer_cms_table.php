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
        Schema::create('refer_cms', function (Blueprint $table) {
            $table->id();
            $table->string('main_title')->nullable();
            $table->string('small_description')->nullable();
            $table->string('small_description2')->nullable();
            $table->string('image')->nullable();
            $table->string('content1_title')->nullable();
            $table->string('content1_description')->nullable();
            $table->string('content1_image')->nullable();
            $table->string('content2_title')->nullable();
            $table->string('content2_description')->nullable();
            $table->string('content2_image')->nullable();
            $table->string('content3_title')->nullable();
            $table->string('content3_description')->nullable();
            $table->string('content3_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refer_cms');
    }
};
