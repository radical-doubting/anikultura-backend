<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerReportsTable extends Migration
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

            $table->unsignedBigInteger('farmer_id')
                ->nullable();
            $table->foreign('farmer_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('seed_stage_id')
                ->nullable();
            $table->foreign('seed_stage_id')
                ->references('id')
                ->on('seed_stages');

            $table->unsignedBigInteger('farmland_id')
                ->nullable();
            $table->foreign('farmland_id')
                ->references('id')
                ->on('farmlands')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('crop_id')
                ->nullable();
            $table->foreign('crop_id')
                ->references('id')
                ->on('crops');

            $table->double('volume');
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
        Schema::dropIfExists('farmer_reports');
    }
}
