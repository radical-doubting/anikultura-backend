<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group');
            $table->string('name');
            $table->string('variety');
            $table->integer('establishment_days');            
            $table->integer('vegetative_days');
            $table->integer('yield_formation_days');
            $table->integer('ripening_days');

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
        Schema::drop('crops');

    }
}
