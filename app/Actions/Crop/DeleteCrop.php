<?php

namespace App\Actions\Crop;

use App\Helpers\ToastHelper;
use App\Models\Crop\Crop;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;
use PDOException;

class DeleteCrop
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Crop $crop)
    {
        $crop->delete();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        try {
            $this->handle($model);
        } catch (PDOException $exception) {
            ToastHelper::showReferenceDeleteError('crop');

            return redirect()->route('platform.crops.edit', [
                $model->id,
            ]);
        }

        Toast::info(__('Crop was removed successfully!'));

        return redirect()->route('platform.crops');
    }
}
