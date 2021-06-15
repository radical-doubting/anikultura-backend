<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class PostgresHelper
{
    public static function update_increments(string $table_name)
    {
        if (env('DB_CONNECTION', 'pgsql')) {
            $id_seq = $table_name . '_id_seq';
            DB::select(
                DB::raw("SELECT setval('?', (SELECT MAX(id) from ?));", array($id_seq, $table_name))
            );
        }
    }
}
