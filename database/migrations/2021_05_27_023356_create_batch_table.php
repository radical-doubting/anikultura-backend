<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch', function (Blueprint $table) {
            $table->increments("id");
            $table->string("crop_group");
            $table->string("crop_name");
            $table->string("crop_variety");
            $table->integer("establishment_days");
            $table->integer("vegetative_days");
            $table->integer("eyield_information_days");
            $table->integer("ripening_days");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batch');
    }
}
