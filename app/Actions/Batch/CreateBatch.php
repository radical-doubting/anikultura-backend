<?php

namespace App\Actions\Batch;

use App\Models\Batch\Batch;
use App\Traits\AsOrchidAction;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateBatch
{
    use AsAction;

    use AsOrchidAction;

    public function handle(Batch $batch, $batchData)
    {
        $batch
            ->fill($batchData)
            ->save();

        $farmers = $batchData['farmers'];

        $batch
            ->farmers()
            ->sync($farmers);
    }

    public function asOrchidAction($model, ?Request $request)
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
