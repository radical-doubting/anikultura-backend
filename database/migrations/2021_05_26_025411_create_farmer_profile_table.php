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
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('gender');
            $table->date('birthday');
            $table->tinyInteger('age');
            $table->string('civil_status');
            $table->bigInteger('contact_number');
            $table->tinyInteger('quantity_family_members');
            $table->tinyInteger('quantity_dependents');
            $table->tinyInteger('quantity_working_dependents');
            $table->string('crop_name_planted');
            $table->string('training_name_joined');
            $table->string('highest_educational_status');
            $table->string('college_course');
            $table->tinyInteger('farming_years');
            $table->string('current_job');
            $table->string('affiliated_organization');
            $table->string('salary_periodicity');
            $table->integer('estimated_salary');
            $table->string('social_status');
            $table->string('social_status_reason');
            $table->string('mode_of_application');
            $table->dateTime('created_at');
            $table->timestamp('updated_at');
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
