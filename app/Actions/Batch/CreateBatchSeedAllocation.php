<?php

namespace App\Actions\Batch;

use App\Models\Batch\BatchSeedAllocation;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateBatchSeedAllocation
{
    use AsAction;
    use AsOrchidAction;

    public function handle(BatchSeedAllocation $batchSeedAllocation, array $batchSeedAllocationData): BatchSeedAllocation
    {
        $batchSeedAllocation
            ->fill($batchSeedAllocationData)
            ->save();

        return $batchSeedAllocation->refresh();
    }

    public function asOrchidAction(mixed $models, ?Request $request): RedirectResponse
    {
        $batchSeedAllocationData = $request->get('batchSeedAllocation');
        $batch = $models['batch'];
        $batchSeedAllocationData['batch_id'] = $batch->id;

        $this->handle($models['batchSeedAllocation'], $batchSeedAllocationData);

        Toast::info(__('Batch seed allocation was saved successfully!'));

        return redirect()->route('platform.batches.edit', $batch);
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
