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
            $table->increments('id');
            $table->unsignedBigInteger('id_type');
            $table->string('name',15);
            $table->string('brand',15);
            $table->integer('qty')->unsigned();
            $table->integer('cost')->unsigned();
            $table->timestamps();
        });

        Schema::create('type_cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',10);
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
        Schema::dropIfExists('cars');
        Schema::dropIfExists('type_cars');
    }
}
