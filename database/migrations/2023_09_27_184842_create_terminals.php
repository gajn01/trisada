<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('toda_id');
            $table->string('terminal_name');
            $table->text('terminal_address')->nullable();
            $table->integer('terminal_long')->nullable();
            $table->integer('terminal_lat')->nullable();
            $table->timestamps(); // Adds created_at and updated_at columns
            $table->foreign('toda_id')->references('id')->on('todas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terminals');
    }
};
