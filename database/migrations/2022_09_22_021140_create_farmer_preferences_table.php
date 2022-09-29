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
        Schema::table('farmer_profiles', function (Blueprint $table) {
            $table->dropColumn('tutorial_done');
        });

        Schema::create('farmer_preferences', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('farmer_profile_id');
            $table->foreign('farmer_profile_id')
                ->references('id')
                ->on('farmer_profiles')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->boolean('tutorial_done')->default(false);
            $table->string('language')->default('en');
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
        Schema::dropIfExists('farmer_preferences');

        Schema::table('farmer_profiles', function (Blueprint $table) {
            $table->boolean('tutorial_done')->default(false);
        });
    }
};
