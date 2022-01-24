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
            $table->string('farmschool_name');

            $table->unsignedBigInteger('region_id')
                ->nullable();
            $table->foreign('region_id')
                ->references('id')
                ->on('regions')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('province_id')
                ->nullable();
            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('municity_id')
                ->nullable();
            $table->foreign('municity_id')
                ->references('id')
                ->on('municities')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->string('barangay')
                ->nullable();

            $table->timestamps();
        });

        Schema::create('batch_farmers', function (Blueprint $table) {
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->foreign('batch_id')
                ->references('id')
                ->on('batches')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('farmer_id')->nullable();
            $table->foreign('farmer_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('batches');
    }
}
