<?php

namespace App\Orchid\Screens\Site\Province;

use App\Actions\Site\Province\CreateProvince;
use App\Actions\Site\Province\DeleteProvince;
use App\Models\Site\Province;
use App\Orchid\Layouts\Site\Province\ProvinceEditLayout;
use App\Orchid\Screens\AnikulturaEditScreen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class ProvinceEditScreen extends AnikulturaEditScreen
{
    public Province $province;

    public function resourceName(): string
    {
        return __('province');
    }

    public function exists(): bool
    {
        return $this->province->exists;
    }

    public function query(Province $province): array
    {
        return [
            'province' => $province,
        ];
    }

    public function layout(): array
    {
        return [
            Layout::block(ProvinceEditLayout::class)
                ->title(__('Province Information'))
                ->description(__('Update the province\'s details.'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->exists())
                        ->method('save')
                ),
        ];
    }

    public function remove(Province $province): RedirectResponse
    {
        return DeleteProvince::runOrchidAction($province, null);
    }

    public function save(Province $province, Request $request): RedirectResponse
    {
        return CreateProvince::runOrchidAction($province, $request);
    }
}
