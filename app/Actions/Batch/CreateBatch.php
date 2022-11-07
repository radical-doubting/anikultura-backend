<?php

namespace App\Actions\Batch;

use App\Models\Batch\Batch;
use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateBatch
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Batch $batch, array $batchData, User $user): Batch
    {
        $batch
            ->fill($batchData)
            ->save();

        $batch
            ->farmers()
            ->sync($batchData['farmers']);

        if ($user->isAdministrator()) {
            $batch
                ->bigBrothers()
                ->sync($batchData['bigBrothers']);
        }

        return $batch->refresh();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        /**
         * @var User
         */
        $user = $request->user();

        if ($user->isAdministrator()) {
            $this->validateBigBrothers($request);
        }

        $batchData = $request->get('batch');

        $this->handle($model, $batchData, $user);

        Toast::info(__('Batch was saved successfully!'));

        return redirect()->route('platform.batches');
    }

    private function validateBigBrothers(Request $request): void
    {
        $request->validate([
            'batch.bigBrothers' => [
                'required',
                'array',
            ],
            'batch.bigBrothers.*' => [
                'integer',
                'exists:users,id',
            ],
        ]);
    }

    public function rules(): array
    {
        return [
            'batch.farmschool_name' => [
                'required',
                'alpha_num_space_dash',
                'min:3',
                'max:70',
            ],
            'batch.region_id' => [
                'required',
                'integer',
                'exists:regions,id',
            ],
            'batch.province_id' => [
                'required',
                'integer',
                'exists:provinces,id',
            ],
            'batch.municity_id' => [
                'required',
                'integer',
                'exists:municities,id',
            ],
            'batch.farmers' => [
                'required',
                'array',
            ],
            'batch.farmers.*' => [
                'integer',
                'exists:users,id',
            ],
        ];
    }

    public function authorize(Request $request, mixed $model): bool
    {
        /**
         * @var User
         */
        $user = $request->user();

        return $user->canAny(['create', 'update'], $model);
    }
}
