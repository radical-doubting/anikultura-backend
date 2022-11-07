<?php

namespace App\Actions\FarmerReport;

use App\Models\FarmerReport\FarmerReport;
use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateFarmerReport
{
    use AsAction;
    use AsOrchidAction;

    public function handle(FarmerReport $farmerReport, array $farmerReportData, User $user): FarmerReport
    {
        $farmerReport
            ->fill($farmerReportData);

        if ($farmerReport->isUnverified()) {
            $farmerReport->verifier()->disassociate();
        } else {
            $farmerReport->verifier()->associate($user);
        }

        $farmerReport->save();

        return $farmerReport->refresh();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        /**
         * @var User
         */
        $user = $request->user();

        $farmerReportData = $request->get('farmerReport');

        $this->handle($model, $farmerReportData, $user);

        Toast::info(__('Farmer report was saved successfully!'));

        return redirect()->route('platform.farmer-reports.edit', [
            $model->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'farmerReport.reported_by' => [
                'required',
            ],
            'farmerReport.farmland_id' => [
                'required',
            ],
            'farmerReport.seed_stage_id' => [
                'required',
            ],
            'farmerReport.crop_id' => [
                'required',
            ],
            'farmerReport.volume_kg' => [
                'numeric',
                'nullable',
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
