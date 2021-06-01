<?php

namespace App\Orchid\Screens\Site\Municity;

use App\Models\Site\Municity;
use App\Orchid\Layouts\Site\Municity\MunicityEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class MunicityEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit Municity';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Edit municity details';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Municity $municity): array
    {
        $this->municity = $municity;

        if (!$municity->exists) {
            $this->name = 'Create Municity';
            $this->description = 'Create a new municity';
        }

        return [
            'municity' => $municity
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the municity is deleted, all of its resources and data will be permanently deleted.'))
                ->method('remove')
                ->canSee($this->municity->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::block(MunicityEditLayout::class)
                ->title(__('Municity Information'))
                ->description(__('Update the municity\'s details.'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->municity->exists)
                        ->method('save')
                ),
        ];
    }


    /**
     * @param Municity $municity
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Municity $municity)
    {
        $municity->delete();

        Toast::info(__('Municity was removed'));

        return redirect()->route('platform.sites.municities');
    }

    /**
     * @param Municity   $municity
     * @param Request   $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Municity $municity, Request $request)
    {
        $request->validate([
            'municity.name' => [
                'required'
            ],
            'municity.province_id' => [
                'required'
            ],
            'municity.region_id' => [
                'required'
            ]
        ]);

        $municityData = $request->get('municity');

        $municity
            ->fill($municityData)
            ->save();

        Toast::info(__('Municity was saved successfully'));

        return redirect()->route('platform.sites.municities');
    }
}
