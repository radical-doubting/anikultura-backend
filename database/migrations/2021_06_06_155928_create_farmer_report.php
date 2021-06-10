<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
    {
        Schema::create('farmer_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('farmer_profiles_id')
                ->references('id')
                ->on('farmer_profiles');
            $table->integer('seed_stages_id')
                ->references('id')
                ->on('seed_stages');
            $table->integer('farmland_id')
                ->references('id')
                ->on('farmlands');
            $table->integer('crop_id');
                ->references('id')
                ->on('crops');
            $table->double('volume');
            $table->rememberToken();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmer_reports');
    }
}
