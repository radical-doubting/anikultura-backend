<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')
                ->nullable();
            $table->string('middle_name')
                ->nullable();
            $table->string('last_name')
                ->nullable();

            $table->string('contact_number', 35)
                ->nullable();

            $table->string('profile_type')
                ->nullable();

            $table->string('email')
                ->nullable()->change();

            $table->unsignedInteger('profile_id')
                ->nullable();

            $table->unique(['name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'middle_name',
                'last_name',
                'contact_number',
                'profile_type',
                'profile_id',
            ]);

            $table->dropIndex('users_name_unique');
            $table->string('email')
                ->nullable(false)->change();
        });
    }
};
