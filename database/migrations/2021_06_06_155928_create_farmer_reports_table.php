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
        Schema::create('farmer_reports', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('reported_by');
            $table->foreign('reported_by')
                ->references('id')
                ->on('users')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->unsignedBigInteger('seed_stage_id');
            $table->foreign('seed_stage_id')
                ->references('id')
                ->on('seed_stages')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('farmland_id');
            $table->foreign('farmland_id')
                ->references('id')
                ->on('farmlands')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('crop_id');
            $table->foreign('crop_id')
                ->references('id')
                ->on('crops')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->boolean('verified')
                ->default(false);

            $table->string('image')
                ->nullable();

            $table->unsignedBigInteger('verified_by')
                ->nullable();
            $table->foreign('verified_by')
                ->references('id')
                ->on('users')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->double('volume_kg')
                ->nullable();

            $table->double('estimated_yield_amount')
                ->nullable();

            $table->date('estimated_yield_date_upper_bound')
                ->nullable();

            $table->date('estimated_yield_date_lower_bound')
                ->nullable();

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
};
