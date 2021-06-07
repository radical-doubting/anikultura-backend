<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_profile', function (Blueprint $table) {
            $table->id();
            $table->string('gender');
            $table->string('civil_status');
            $table->date('birthday');
            $table->tinyInteger('age');
            $table->tinyInteger('quantity_family_members');
            $table->tinyInteger('quantity_dependents');
            $table->tinyInteger('quantity_working_dependents');
            $table->string('highest_educational_status');
            $table->string('college_course');
            $table->string('current_job');
            $table->tinyInteger('farming_years');
            $table->string('usual_crops_planted');
            $table->string('affiliated_organization');
            $table->string('tesda_training_joined');
            $table->string('nc_passer_status');
            $table->string('salary_periodicity');
            $table->integer('estimated_salary');
            $table->string('social_status');
            $table->string('social_status_reason');

            $table->unsignedBigInteger('farmer_address_id');
            $table->foreign('farmer_address_id')
                ->references('id')
                ->on('farmer_address')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('farmer_profile');
    }
}
