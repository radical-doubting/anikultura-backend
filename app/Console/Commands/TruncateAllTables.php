<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TruncateAllTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncates all tables';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if (App::environment() === 'production') {
            $this->error('Cannot truncate production server');

            return 1;
        }

        Schema::disableForeignKeyConstraints();

        $this->info('Truncating tables');

        // Truncate all tables, except migrations
        $tables = DB::select('SELECT * FROM pg_catalog.pg_tables WHERE schemaname = \'public\'');
        foreach ($tables as $table) {
            $tableName = $table->tablename;

            $this->info('Truncating: '.$tableName);

            if ($tableName !== 'migrations') {
                DB::table($tableName)->truncate();
            }
        }

        Schema::enableForeignKeyConstraints();

        $this->info('Truncating tables successfully');

        return 0;
    }
}
