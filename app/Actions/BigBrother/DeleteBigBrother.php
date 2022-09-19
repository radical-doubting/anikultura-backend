<?php

namespace App\Actions\BigBrother;

use App\Models\BigBrother\BigBrother;
use App\Traits\AsOrchidAction;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteBigBrother
{
    use AsAction;
    use AsOrchidAction;

    public function handle(BigBrother $bigBrother)
    {
        $bigBrother->delete();
    }

    public function asOrchidAction($model, ?Request $request)
    {
        $this->handle($model);

        Toast::info(__('Big brother was removed successfully!'));

        return redirect()->route('platform.big-brothers');
    }
}
