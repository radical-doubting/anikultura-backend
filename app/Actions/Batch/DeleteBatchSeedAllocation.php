<?php

namespace App\Actions\Batch;

use App\Models\Batch\BatchSeedAllocation;
use App\Traits\AsOrchidAction;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteBatchSeedAllocation
{
    use AsAction;

    use AsOrchidAction;

    public function handle(BatchSeedAllocation $batchSeedAllocation)
    {
        $batchSeedAllocation->delete();
    }

    public function asOrchidAction($model, Request $request = null)
    {
        $this->handle($model);

        Toast::info(__('Batch seed allocation was removed successfully!'));

        return redirect()->route('platform.batches');
    }
}
