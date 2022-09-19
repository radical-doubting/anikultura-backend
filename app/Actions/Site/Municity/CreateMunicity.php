<?php

namespace App\Actions\Site\Municity;

use App\Models\Site\Municity;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateMunicity
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Municity $municity, array $municityData): Municity
    {
        $municity->fill($municityData)->save();

        return $municity;
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $municityData = $request->get('municity');

        $this->handle($model, $municityData);

        Toast::info(__('Municity was saved successfully!'));

        return redirect()->route('platform.sites.municities');
    }

    public function rules(): array
    {
        return [
            'municity.name' => [
                'required',
            ],
            'municity.province_id' => [
                'required',
            ],
            'municity.region_id' => [
                'required',
            ],
        ];
    }
}
