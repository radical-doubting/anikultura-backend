<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $sluggedTableNames = [
        'regions',
        'provinces',
        'municities',
        'farmland_types',
        'farmland_statuses',
        'crops',
        'batches',
        'seed_stages',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->sluggedTableNames as $sluggedTableName) {
            $this->addSlugColumnToTable($sluggedTableName);
        }
    }

    private function addSlugColumnToTable(string $sluggedTableName)
    {
        Schema::table($sluggedTableName, function (Blueprint $table) {
            $column = $table->string('slug')->nullable(false)->unique();

            if (config('database.default') === 'sqlite') {
                $column->default('');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->sluggedTableNames as $sluggedTableName) {
            $this->removeSlugColumnFromTable($sluggedTableName);
        }
    }

    private function removeSlugColumnFromTable(string $sluggedTableName)
    {
        Schema::table($sluggedTableName, function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
