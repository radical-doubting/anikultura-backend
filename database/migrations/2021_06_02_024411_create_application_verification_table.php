<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_verification', function (Blueprint $table) {
            $table->id();
            $table->string('verified_by');
            $table->string('position');
            $table->string('office');
            $table->integer('contact_number');
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
        Schema::dropIfExists('application_verification');
    }
}
