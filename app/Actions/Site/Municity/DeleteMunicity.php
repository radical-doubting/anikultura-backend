<?php

namespace App\Actions\Site\Municity;

use App\Helpers\ToastHelper;
use App\Models\Site\Municity;
use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;
use PDOException;

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
        try {
            $this->handle($model);
        } catch (PDOException $exception) {
            ToastHelper::showReferenceDeleteError('municipality or city');

            return redirect()->route('platform.sites.municities.edit', [
                $model->id,
            ]);
        }

        Toast::info(__('Municipality or city was removed successfully!'));

        return redirect()->route('platform.sites.municities');
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
