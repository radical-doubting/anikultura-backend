<?php

namespace App\Actions\Batch;

use App\Models\Batch\BatchSeedAllocation;
use App\Traits\AsOrchidAction;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateBatchSeedAllocation
{
    use AsAction;

    use AsOrchidAction;

    public function handle(BatchSeedAllocation $batchSeedAllocation, $batchSeedAllocationData)
    {
        $batchSeedAllocation
            ->fill($batchSeedAllocationData)
            ->save();
    }

    public function asOrchidAction($model, ?Request $request)
    {
        $batchSeedAllocation = $request->get('batchSeedAllocation');

        $this->handle($model, $batchSeedAllocation);

        Toast::info(__('Batch seed allocation was saved successfully!'));

        return redirect()->route('platform.batches');
    }

    public function rules(): array
    {
        return [
            'batchSeedAllocation.crop_id' => [
                'required',
            ],
            'batchSeedAllocation.farmer_id' => [
                'required',
            ],

            'batchSeedAllocation.seed_amount' => [
                'required',
            ],
        ];
    }
}
