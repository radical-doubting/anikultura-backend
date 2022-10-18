<?php

namespace App\Actions\Batch;

use App\Helpers\ToastHelper;
use App\Models\Batch\Batch;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;
use PDOException;

class DeleteBatch
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Batch $batch): bool
    {
        return $batch->delete();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        try {
            $this->handle($model);
        } catch (PDOException $exception) {
            ToastHelper::showReferenceDeleteError('batch');

            return redirect()->route('platform.batches.edit', [
                $model->id,
            ]);
        }

        Toast::info(__('Batch was removed successfully!'));

        return redirect()->route('platform.batches');
    }
}
