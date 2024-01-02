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
            $table->string('fullname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->smallInteger('gender')->default(0);
            $table->date('date_of_birth')->nullable();
            $table->string('avatarurl')->nullable();
            $table->string('student_id')->nullable();
            $table->string('class')->nullable();
            $table->string('school')->nullable();
            $table->string('school_year')->nullable();
            $table->text('about_me')->nullable();
            $table->smallInteger('ispublic')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
