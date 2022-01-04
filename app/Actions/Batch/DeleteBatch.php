<?php

namespace App\Actions\Batch;

use App\Models\Batch\Batch;
use App\Traits\AsOrchidAction;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteBatch
{
    use AsAction;

    use AsOrchidAction;

    public function handle(Batch $batch)
    {
        $batch->delete();
    }

    public function asOrchidAction(Batch $batch)
    {
        $this->handle($batch);

        Toast::info(__('Batch was removed successfully.'));

        return redirect()->route('platform.batches');
    }
}
