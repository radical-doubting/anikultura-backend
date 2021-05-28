<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('crop_name');
            $table->string('growth_rate');
            $table->integer('estimated_price');
            $table->string('crop_group');            
            $table->string('seed_development');
            $table->string('seed_received');
            $table->string('seed_planted');
            $table->string('seed_established');
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
        Schema::drop('crop');

    }
}
