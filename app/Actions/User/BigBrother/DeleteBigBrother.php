<?php

namespace App\Actions\User\BigBrother;

use App\Helpers\ToastHelper;
use App\Models\User\BigBrother\BigBrother;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;
use PDOException;

class DeleteBigBrother
{
    use AsAction;
    use AsOrchidAction;

    public function handle(BigBrother $bigBrother): bool
    {
        $bigBrother->profile->delete();

        return $bigBrother->delete();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        try {
            $this->handle($model);
        } catch (PDOException $exception) {
            ToastHelper::showReferenceDeleteError('big brother');

            return redirect()->route('platform.big-brothers.edit', [
                $model->id,
            ]);
        }

        Toast::info(__('Big brother was removed successfully!'));

        return redirect()->route('platform.big-brothers');
    }
}
