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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('enter_by')->nullable();
            $table->bigInteger('cnadidate_status_id')->nullable();
            $table->string('mode_of_registration')->nullable();
            $table->string('source')->nullable();
            $table->string('passport_number')->nullable();
            $table->bigInteger('referred_by_id')->nullable();
            $table->string('referred_by')->nullable();
            $table->string('last_update_date')->nullable();
            $table->string('full_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('age')->nullable();
            $table->string('education')->nullable();
            $table->string('other_education')->nullable();
            $table->string('contact_no')->nullable()->unique();
            $table->string('alternate_contact_no')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('whatapp_no')->nullable();
            $table->string('city')->nullable();
            $table->string('religion')->nullable();
            $table->string('ecr_type')->nullable();
            $table->string('english_speak')->nullable();
            $table->string('arabic_speak')->nullable();
            $table->boolean('return')->default(false);
            $table->text('indian_exp')->nullable();
            $table->text('abroad_exp')->nullable();
            $table->text('position_applied_for_1')->nullable();
            $table->text('specialisation_1')->nullable();
            $table->text('position_applied_for_2')->nullable();
            $table->text('specialisation_2')->nullable();
            $table->text('position_applied_for_3')->nullable();
            $table->text('specialisation_3')->nullable();
            $table->string('is_call_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
