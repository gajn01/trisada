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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('driver_license')->nullable();
            $table->string('plate_number')->nullable();
            $table->string('franchise_no')->nullable();
            $table->string('register_number')->nullable();
            $table->string('or_cr')->nullable();
            $table->integer('toda_id');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
};
