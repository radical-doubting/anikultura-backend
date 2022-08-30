<?php

namespace App\Orchid\Screens\Site\Province;

use App\Actions\Site\Province\CreateProvince;
use App\Actions\Site\Province\DeleteProvince;
use App\Models\Site\Province;
use App\Orchid\Layouts\Site\Province\ProvinceEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class ProvinceEditScreen extends Screen
{
    public Province $province;

    public function name(): string
    {
        return $this->province->exists
            ? __('Edit province')
            : __('Create province');
    }

    public function description(): string
    {
        return $this->province->exists
            ? __('Edit province details')
            : __('Create a new province');
    }

    public function query(Province $province): array
    {
        return [
            'province' => $province,
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the province is deleted, all of its resources and data will be permanently deleted.'))
                ->method('remove')
                ->canSee($this->province->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
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
                        ->canSee($this->province->exists)
                        ->method('save')
                ),
        ];
    }

    /**
     * Remove a province.
     *
     * @param  Province  $province
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(Province $province)
    {
        return DeleteProvince::runOrchidAction($province, null);
    }

    /**
     * Save a province.
     *
     * @param  Province  $province
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Province $province, Request $request)
    {
        return CreateProvince::runOrchidAction($province, $request);
    }
}
