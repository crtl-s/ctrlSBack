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
        Schema::create('lession_users', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lession_id');
            $table->foreignId('user_id');
            $table->foreignId('grade_id')->nullable();
            $table->integer('score')->nullable();
            $table->foreign('lession_id')->references('id')->on('lessions');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('grade_id')->references('id')->on('grades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lession_users');
    }
};
