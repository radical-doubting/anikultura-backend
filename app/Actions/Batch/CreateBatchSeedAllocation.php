<?php

namespace App\Actions\Batch;

use App\Models\Batch\BatchSeedAllocation;
use App\Models\User\User;
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

    public function asOrchidAction(mixed $models, Request $request): RedirectResponse
    {
        $batchSeedAllocationData = $request->get('batchSeedAllocation');
        $batch = $models['batch'];
        $batchSeedAllocationData['batch_id'] = $batch->id;

        $this->handle($models['batchSeedAllocation'], $batchSeedAllocationData);

        Toast::info(__('Batch seed allocation was saved successfully!'));

        return redirect()->route('platform.batches.edit', [
            'batch' => $batch,
            'seeds' => true,
        ]);
    }

    public function rules(): array
    {
        return [
            'batchSeedAllocation.crop_id' => [
                'required',
                'integer',
                'exists:crops,id',
            ],
            'batchSeedAllocation.farmer_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'batchSeedAllocation.seed_amount' => [
                'required',
                'integer',
                'min:1',
                'max:999999',
            ],
        ];
    }

    public function authorize(Request $request, mixed $models): bool
    {
        /**
         * @var User
         */
        $user = $request->user();

        return $user->canAny(['create', 'update'], $models['batchSeedAllocation']);
    }
}
