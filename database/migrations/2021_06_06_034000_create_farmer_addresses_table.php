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
        Schema::create('farmer_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('house_number');
            $table->string('street');
            $table->string('barangay');
            $table->string('province');
            $table->string('municity');

            $table->unsignedBigInteger('farmer_profile_id');
            $table->foreign('farmer_profile_id')
                ->references('id')
                ->on('farmer_profiles')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')
                ->references('id')
                ->on('regions')
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
        Schema::dropIfExists('farmer_addresses');
    }
};
