<?php

namespace App\Actions\Farmland;

use App\Helpers\ToastHelper;
use App\Models\Farmland\Farmland;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;
use PDOException;

class DeleteFarmland
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Farmland $farmland): bool
    {
        return $farmland->delete();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        try {
            $this->handle($model);
        } catch (PDOException $exception) {
            ToastHelper::showReferenceDeleteError('farmland');

            return redirect()->route('platform.farmlands.edit', [
                $model->id,
            ]);
        }

        Toast::info(__('Farmland was removed successfully!'));

        return redirect()->route('platform.farmlands');
    }
}
