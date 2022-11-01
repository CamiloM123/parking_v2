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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->dateTime('arrival_time', $precision = 0)->default(now());
            $table->dateTime('exit_time', $precision = 0)->nullable()->default(null);

            $table->foreignId('vehicle_id')->references('id')->on('vehicles')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('parking_place_id')->references('id')->on('parking_places')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->foreignId('parking_id')->references('id')->on('parkings')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('tickets');
    }
};
