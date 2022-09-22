<?php

namespace App\Actions\Site\Municity;

use App\Models\Site\Municity;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteMunicity
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Municity $municity): bool
    {
        $isDeleted = $municity->delete();

        if (is_null($isDeleted)) {
            return false;
        }

        return $isDeleted;
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $this->handle($model);

        Toast::info(__('Municity was removed successfully!'));

        return redirect()->route('platform.sites.municities');
    }
}
