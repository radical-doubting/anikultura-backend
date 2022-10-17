<?php

namespace App\Actions\User\Farmer;

use App\Helpers\ToastHelper;
use App\Models\User\Farmer\Farmer;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;
use PDOException;

class DeleteFarmer
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Farmer $farmer): bool
    {
        $farmer->profile->delete();

        return $farmer->delete();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        try {
            $this->handle($model);
        } catch (PDOException $exception) {
            ToastHelper::showReferenceDeleteError('farmer');

            return redirect()->route('platform.farmers.edit', [
                $model->id,
            ]);
        }

        Toast::info(__('Farmer was removed successfully!'));

        return redirect()->route('platform.farmers');
    }
}
