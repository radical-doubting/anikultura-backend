<?php

namespace App\Orchid\Layouts\Farmer;

use App\Models\Farmer\FarmerProfile;
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

class FarmerEditSkillLayout extends Rows
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
                Select::make('farmer_profile.highest_educational_status')
                    ->title('Highest Educational Status:')
                    ->required()
                    ->options(["Elementary", "High School", "College"]),

                Input::make('farmer_profile.college_course')
                    ->title('College Course:')
                    ->required(),
            ]),

            Group::make([
                Input::make('farmer_profile.current_job')
                    ->title('Current Job:')
                    ->required(),

                Input::make('farmer_profile.farming_years')
                    ->type('number')
                    ->required()
                    ->title('Farming Years:'),
            ]),

            Group::make([
                Input::make('farmer_profile.usual_crops_planted')
                    ->title('Usual Crops Planted:')
                    ->required(),

                Input::make('farmer_profile.affiliated_organization')
                    ->title('Affiliated Organization:')
                    ->required(),
            ]),

            Group::make([
                Input::make('farmer_profile.tesda_training_joined')
                    ->title('TESDA Training Joined:')
                    ->required(),

                Select::make('farmer_profile.nc_passer_status')
                    ->title('MC Passer?')
                    ->options(["Yes", "No"]),
            ]),
        ];
    }
}