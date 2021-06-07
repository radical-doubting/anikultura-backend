<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string("assigned_farmschool_name")->nullable(false);
            $table->string("region")->nullable(false);
            $table->string("provinces")->nullable(false);
            $table->string("municities")->nullable(false);
            $table->string("barangays")->nullable(false);
            $table->integer("number_seeds_distributed");
            $table->json("farmer_names");
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
        Schema::dropIfExists('batches');
    }
}
