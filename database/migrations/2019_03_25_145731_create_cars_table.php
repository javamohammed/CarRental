<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string( 'color');
            $table->string( 'registration_number');
            $table->integer( 'number_places');
            $table->integer( 'number_cylinder');
            $table->string( 'type_car');
            $table->boolean('available')->default(0);
            $table->text( 'description');
            $table->text( 'paths_images')->nullable();
            $table->date( 'purchaseDate');
            $table->unsignedBigInteger( 'model_id');
            $table->timestamps();
            $table->foreign('model_id')->references('id')->on( 'car_models');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
