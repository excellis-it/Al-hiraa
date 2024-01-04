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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable()->default(null)->comment('First Name');
            $table->string('last_name')->nullable()->default(null)->comment('Last Name');
            $table->string('email')->unique();
            $table->string('phone')->nullable()->default(null)->comment('Phone Number');
            $table->string('city')->nullable()->default(null)->comment('City');
            $table->string('state')->nullable()->default(null)->comment('State');
            $table->string('country')->nullable()->default(null)->comment('Country');
            $table->string('account')->nullable()->default(null)->comment('account');
            $table->string('role_type')->nullable()->default(null)->comment('role_type');
            $table->string('timezone')->nullable()->default(null)->comment('Timezone');
            $table->string('currency')->nullable()->default(null)->comment('Currency');
            $table->string('application_language')->nullable()->default(null)->comment('Application Language');
            $table->string('profile_picture')->nullable()->default(null)->comment('Profile Image');
            $table->boolean('is_active')->default(true)->comment('Is Active');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes()->comment('Deleted At');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
