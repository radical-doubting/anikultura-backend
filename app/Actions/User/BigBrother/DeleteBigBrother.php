<?php

namespace App\Actions\User\BigBrother;

use App\Models\User\BigBrother\BigBrother;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteBigBrother
{
    use AsAction;
    use AsOrchidAction;

    public function handle(BigBrother $bigBrother): bool
    {
        return $bigBrother->delete();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $this->handle($model);

        Toast::info(__('Big brother was removed successfully!'));

        return redirect()->route('platform.big-brothers');
    }
}
