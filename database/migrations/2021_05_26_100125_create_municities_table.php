<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false)->unique();

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
        Schema::dropIfExists('municities');
    }
};
