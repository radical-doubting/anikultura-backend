<?php

namespace App\Actions\FarmerReport;

use App\Models\FarmerReport\FarmerReport;
use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteFarmerReport
{
    use AsAction;
    use AsOrchidAction;

    public function handle(FarmerReport $farmerReport): bool
    {
        return $farmerReport->delete();
    }

    public function asOrchidAction(mixed $model, Request $request): RedirectResponse
    {
        $this->handle($model);

        Toast::info(__('Farmer report was removed successfully!'));

        return redirect()->route('platform.farmer-reports');
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
