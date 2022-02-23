<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crops', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false)->unique();
            $table->string('group');
            $table->string('variety');

            $table->double('yield_per_ha');
            $table->double('gross_returns_per_ha');
            $table->double('total_costs_per_ha');
            $table->double('net_returns_per_ha');
            $table->double('net_profit_cost_ratio');
            $table->double('production_cost_per_kg');
            $table->double('farmgate_price_per_kg');
            $table->double('profit_per_kg');

            $table->integer('maturity_lower_bound');
            $table->integer('maturity_upper_bound');

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
        Schema::drop('crops');
    }
}
