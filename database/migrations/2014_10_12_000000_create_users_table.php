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
            $table->string('name');
            $table->string('email')->unique();
            $table->tinyInteger('user_type');
            $table->boolean('is_active');
            $table->longText('user_access');
            $table->bigInteger('toda_id')->unsigned()->nullable();
            $table->bigInteger('created_by_id')->unsigned()->nullable();
            $table->bigInteger('last_updated_by_id')->unsigned()->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('created_by_id')->references('id')->on('users')->restrictOnDelete();
            $table->foreign('last_updated_by_id')->references('id')->on('users')->restrictOnDelete();
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
