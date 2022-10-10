<?php

namespace App\Actions\Batch;

use App\Models\Batch\Batch;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateBatch
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Batch $batch, array $batchData): Batch
    {
        $batch
            ->fill($batchData)
            ->save();

        $farmers = $batchData['farmers'];

        $batch
            ->farmers()
            ->sync($farmers);

        return $batch;
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $batchData = $request->get('batch');

        $this->handle($model, $batchData);

        Toast::info(__('Batch was saved successfully!'));

        return redirect()->route('platform.batches');
    }

    public function rules(): array
    {
        return [
            'batch.farmschool_name' => [
                'required',
                'alpha_dash',
                'min:3',
                'max:70',
            ],
            'batch.region_id' => [
                'required',
            ],
            'batch.province_id' => [
                'required',
            ],
            'batch.municity_id' => [
                'required',
            ],
            'batch.farmers' => [
                'required',
                'array',
            ],
        ];
    }
}
