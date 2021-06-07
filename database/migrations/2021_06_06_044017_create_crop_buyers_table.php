<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmlandCropBuyerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crop_buyers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('farmland_crop_buyers', function (Blueprint $table) {
            $table->unsignedBigInteger('farmland_id');
            $table->foreign('farmland_id')
                ->references('id')
                ->on('farmlands')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('crop_buyer_id');
            $table->foreign('crop_buyer_id')
                ->references('id')
                ->on('crop_buyers')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmland_crop_buyers');
        Schema::dropIfExists('crop_buyers');
    }
}
