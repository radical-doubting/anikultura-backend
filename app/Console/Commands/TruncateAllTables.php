<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

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
     *
     * @return int
     */
    public function handle()
    {
        if (App::environment() === 'production') {
            $this->error('Cannot truncate production server');
            exit();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->info('Truncating tables');

        // Truncate all tables, except migrations
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            if ($table->Tables_in_anikultura !== 'migrations')
                DB::table($table->Tables_in_anikultura)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->info('Truncating tables successfully');
    }
}
