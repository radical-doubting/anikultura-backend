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
        Schema::create('watering_systems', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false)->unique();
            $table->timestamps();
        });

        Schema::create('farmland_watering_systems', function (Blueprint $table) {
            $table->unsignedBigInteger('farmland_id');
            $table->foreign('farmland_id')
                ->references('id')
                ->on('farmlands')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('watering_system_id');
            $table->foreign('watering_system_id')
                ->references('id')
                ->on('watering_systems')
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
        Schema::dropIfExists('farmland_watering_systems');
        Schema::dropIfExists('watering_systems');
    }
};
