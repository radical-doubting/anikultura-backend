<?php

namespace App\Orchid\Layouts\Farmland;

use App\Models\Farmland\CropBuyer;
use App\Models\Farmland\FarmlandStatus;
use App\Models\Farmland\FarmlandType;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;

class FarmlandEditFarmLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Relation::make('farmland.type')
                ->fromModel(FarmlandType::class, 'name')
                ->required()
                ->title(__('Type'))
                ->placeholder(__('Type')),

            Relation::make('farmland.status')
                ->fromModel(FarmlandStatus::class, 'name')
                ->required()
                ->title(__('Status'))
                ->placeholder(__('Status')),

            Input::make('farmland.hectares_size')
                ->type('number')
                ->required()
                ->title(__('Size in Hectares')),

            Select::make('farmland.watering_systems')
                ->options([
                    'well'   => 'Well',
                    'nia' => 'NIA Canal/Irrigation',
                    'spring' => 'Spring',
                    'shallowtubewell' => 'Shallow Tube Well',
                    'creek' => 'Creek',
                    'faucet' => 'Faucet',
                    'rainwater' => 'Rain Water',
                ])
                ->multiple()
                ->title('Watering System Used:'),

            Relation::make('farmland.crop_buyers')
                ->fromModel(CropBuyer::class, 'name')
                ->required()
                ->title(__('Crop Buyers'))
                ->placeholder(__('Crop Buyers'))
                ->multiple(),
        ];
    }
}
