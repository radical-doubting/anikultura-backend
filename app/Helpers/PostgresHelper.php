<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class PostgresHelper
{
    public static function update_increments(string $table_name)
    {
        if (env('DB_CONNECTION', 'pgsql')) {
            $id_seq = $table_name . '_id_seq';
            $stmt = DB::raw("SELECT setval('" . $id_seq . "', (SELECT MAX(id) from " . $table_name . "));");
            DB::select($stmt);
        }
    }
}
