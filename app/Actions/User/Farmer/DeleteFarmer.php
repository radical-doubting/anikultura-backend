<?php

namespace App\Actions\User\Farmer;

use App\Models\User\Farmer\Farmer;
use App\Traits\AsOrchidAction;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

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
        } catch (Exception $exception) {
            Toast::error(__('Error: delete the submitted reports of this farmer first'));

            return redirect()->back();
        }

        Toast::info(__('Farmer was removed successfully!'));

        return redirect()->route('platform.farmers');
    }
}
