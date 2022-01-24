<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchSeedAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_seed_allocations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('batch_id')
                ->nullable();
            $table->foreign('batch_id')
                ->references('id')
                ->on('batches')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('farmer_id')
                ->nullable();
            $table->foreign('farmer_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->integer('seed_amount')
                ->nullable(false);

            $table->unsignedBigInteger('crop_id')
                ->nullable();
            $table->foreign('crop_id')
                ->references('id')
                ->on('crops')
                ->nullOnDelete()
                ->cascadeOnUpdate();

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
        Schema::dropIfExists('batch_seed_allocations');
    }
}
