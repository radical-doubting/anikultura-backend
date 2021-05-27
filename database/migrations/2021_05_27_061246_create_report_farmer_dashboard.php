<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReportFarmerDashboard extends Migration
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
            $table->string('seed_status_picture', 64);
            $table->integer('seed_status_stage');
            $table->timestamp('seed_status_timestamp');
            $table->integer('volume');
            $table->rememberToken();
            $table->foreign('farmland_id');
                ->references('id')
                ->on('farmland');
            $table->foreign('farmland_site_id')
                ->references('id')
                ->on('site');
            $table->foreign('farmland_batch_id')
                ->references('id')
                ->on('batch');
            $table->foreign('crop_id')
                ->references('id')
                ->on('crop'); 
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmer_report');
    }
}
