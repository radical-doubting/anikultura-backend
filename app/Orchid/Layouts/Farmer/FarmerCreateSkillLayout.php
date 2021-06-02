<?php

namespace App\Orchid\Layouts\Farmer;

use App\Models\Farmer\Farmer_profile;
use Orchid\Screen\Field;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Group;

class FarmerCreateSkillLayout extends Rows
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
            Group::make([
                Select::make('highest_educational_status')
                    ->title('Highest Educational Status:')
                    ->options(["Elementary", "High School", "College"]),
                
                Input::make('course')
                    ->title('College Course:')
                    ->placeholder('BS in Agriculture')
                    ->required(),
            ]),

            Group::make([
                Input::make('current_job')
                    ->title('Current Job:')
                    ->placeholder('Farmer')
                    ->required(),

                Input::make('farming_years')
                    ->type('number')
                    ->required()
                    ->placeholder('10')
                    ->title('Farming Years:'),
            ]),

            Group::make([
                Input::make('usual_crops_planted')
                    ->title('Usual Crops Planted:')
                    ->placeholder('Talong, Sitaw')
                    ->required(),

                Input::make('affiliated_organization')
                    ->title('Affiliated Organization:')
                    ->placeholder('TESDA')
                    ->required(),
            ]),

            Group::make([
                Input::make('tesda_training_joined')
                    ->title('TESDA Training Joined:')
                    ->placeholder('Sustainable Agricultural Program')
                    ->required(),

                Select::make('nc_passer_status')
                ->title('MC Passer?')
                ->options(["Yes", "No"]),
            ]),
        ];
    }
}
