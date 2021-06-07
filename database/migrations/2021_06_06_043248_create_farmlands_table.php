<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmlandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmlands', function (Blueprint $table) {
            $table->id();
            $table->integer('hectares_size');

            $table->unsignedBigInteger('type_id')
                ->nullable();
            $table->foreign('type_id')
                ->references('id')
                ->on('farmland_types')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('status_id')
                ->nullable();
            $table->foreign('status_id')
                ->references('id')
                ->on('farmland_statuses')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->timestamps();
        });

        Schema::create('farmland_crops', function (Blueprint $table) {
            $table->unsignedBigInteger('farmland_id');
            $table->foreign('farmland_id')
                ->references('id')
                ->on('farmlands')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('crop_id');
            $table->foreign('crop_id')
                ->references('id')
                ->on('crops')
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
        Schema::dropIfExists('farmland_crops');
        Schema::dropIfExists('farmlands');
    }
}
