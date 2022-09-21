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
        Schema::create('farmer_profiles', function (Blueprint $table) {
            $table->id();
            $table->date('birthday');
            $table->tinyInteger('quantity_family_members');
            $table->tinyInteger('quantity_dependents');
            $table->tinyInteger('quantity_working_dependents');
            $table->string('college_course')->nullable();
            $table->string('current_job')->nullable();
            $table->double('estimated_salary');

            $table->tinyInteger('farming_years');
            $table->string('usual_crops_planted');
            $table->string('affiliated_organization')->nullable();
            $table->string('tesda_training_joined')->nullable();
            $table->boolean('nc_passer_status');
            $table->string('social_status_reason');

            $table->unsignedBigInteger('gender_id');
            $table->foreign('gender_id')
                ->references('id')
                ->on('genders')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('civil_status_id');
            $table->foreign('civil_status_id')
                ->references('id')
                ->on('civil_statuses')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('educational_status_id');
            $table->foreign('educational_status_id')
                ->references('id')
                ->on('educational_statuses')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('salary_periodicity_id');
            $table->foreign('salary_periodicity_id')
                ->references('id')
                ->on('salary_periodicities')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('social_status_id');
            $table->foreign('social_status_id')
                ->references('id')
                ->on('social_statuses')
                ->restrictOnDelete()
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
        Schema::dropIfExists('farmer_profiles');
    }
};
