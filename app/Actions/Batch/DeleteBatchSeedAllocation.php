<?php

namespace App\Actions\Batch;

use App\Models\Batch\BatchSeedAllocation;
use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteBatchSeedAllocation
{
    use AsAction;
    use AsOrchidAction;

    public function handle(BatchSeedAllocation $batchSeedAllocation): bool
    {
        return $batchSeedAllocation->delete();
    }

    public function asOrchidAction(mixed $model, Request $request): RedirectResponse
    {
        $this->handle($model);

        Toast::info(__('Batch seed allocation was removed successfully!'));

        return redirect()->route('platform.batches');
    }

    public function authorize(Request $request, mixed $model): bool
    {
        /**
         * @var User
         */
        $user = $request->user();

        return $user->can('delete', $model);
    }
}
