<?php

namespace App\Actions\Home;

use Lorisleiva\Actions\Concerns\AsAction;

class PrintHomeMessage
{
    use AsAction;

    public function handle(string $message)
    {
        error_log($message, 0);
    }
}
