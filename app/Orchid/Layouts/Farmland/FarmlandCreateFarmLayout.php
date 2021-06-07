<?php

namespace App\Orchid\Layouts\Farmland;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;

class FarmlandCreateFarmLayout extends Rows
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
            /*Select::make('farmland_status')
                ->title('Farm Status:')
                ->required()
                ->options(["Owned", "Rented", "Borrowed"]),

            Select::make('farm_type')
                ->title('Farm Type:')
                ->required()
<<<<<<< HEAD
                ->options(["Personal Farmland", "Community Farmland"]), */
    
            Input::make('farmland.hectares_size')
=======
                ->options(["Personal Farmland", "Community Farmland"]),

            Input::make('farm_size')
>>>>>>> 77f5d923c32254527826ab3f58a756ddb672ea6e
                ->type('number')
                ->required()
                ->title('Farm Size:'),

<<<<<<< HEAD
            /*Select::make('watering_system_used')
=======

            Select::make('watering_system_used')
>>>>>>> 77f5d923c32254527826ab3f58a756ddb672ea6e
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

            Select::make('crop_buyer')
                ->options([
                    'biyahedor'   => 'Biyahedor',
                    'dizon_farm' => 'Dizon Farm',
                    'wholesaler' => 'Wholesaler',
                    'market' => 'Market',
                    'fca' => 'FCA',
                    'others' => 'Others',
                ])
                ->multiple()
                ->title('Crop Buyer:'), */
        ];
    }
}
