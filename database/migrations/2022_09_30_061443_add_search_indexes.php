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
        Schema::table('farmlands', function (Blueprint $table) {
            $table->index(['name']);
        });

        Schema::table('batches', function (Blueprint $table) {
            $table->index(['farmschool_name']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index([
                'first_name',
                'middle_name',
                'last_name'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex([
                'first_name',
                'middle_name',
                'last_name'
            ]);
        });

        Schema::table('batches', function (Blueprint $table) {
            $table->dropIndex(['farmschool_name']);
        });

        Schema::table('farmlands', function (Blueprint $table) {
            $table->dropIndex(['name']);
        });
    }
};
