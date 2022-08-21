<?php

namespace App\Actions\Crop;

use App\Models\Crop\Crop;
use App\Traits\AsOrchidAction;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteCrop
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Crop $crop)
    {
        $crop->delete();
    }

    public function asOrchidAction($model, ?Request $request)
    {
        $this->handle($model);

        Toast::info(__('Crop was removed successfully!'));

        return redirect()->route('platform.crops');
    }
}
