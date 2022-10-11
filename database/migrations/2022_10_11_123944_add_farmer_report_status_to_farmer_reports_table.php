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
        Schema::table('farmer_reports', function (Blueprint $table) {
            $table->dropColumn('verified');
        });

        Schema::table('farmer_reports', function (Blueprint $table) {
            $statusColumn = $table->unsignedBigInteger('status_id');

            if (config('database.default') === 'sqlite') {
                $statusColumn->nullable();
            }

            $table->foreign('status_id')
                ->references('id')
                ->on('farmer_report_statuses')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('farmer_reports', function (Blueprint $table) {
            $table->dropColumn('status_id');
            $table->dropForeign('status_id');
        });

        Schema::table('farmer_reports', function (Blueprint $table) {
            $table->boolean('verified')
                ->default(false);
        });
    }
};
