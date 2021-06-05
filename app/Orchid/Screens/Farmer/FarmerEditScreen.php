<?php

namespace App\Orchid\Screens\Farmer;

use Orchid\Screen\Screen;
use Orchid\Screen\Action;
use App\Orchid\Layouts\Farmer\FarmerCreateLoginLayout;
use App\Orchid\Layouts\Farmer\FarmerCreateProfileLayout;
use App\Orchid\Layouts\Farmer\FarmerCreateSkillLayout;
use App\Orchid\Layouts\Farmer\FarmerCreateAddressLayout;
use App\Orchid\Layouts\Farmer\FarmerCreateSalaryLayout;
use App\Models\Farmer_profile;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Field;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use Illuminate\Http\Request;

class FarmerEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Enroll Farmer';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Fill out all required information.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Farmer_profile $farmer_profile): array
    {
        $this->farmer_profile = $farmer_profile;

        if (!$farmer_profile->exists) {
            $this->name = 'Enroll Farmer';
            $this->description = 'Enroll New Farmer';
        }

        return [
            'farmer_profile' => $farmer_profile
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
            Layout::block(FarmerCreateLoginLayout::class)
                ->title('Login Information')
                ->description('This information will be used to login to the system.'),

            Layout::block(FarmerCreateProfileLayout::class)
                ->title('Personal Information')
                ->description("This information collects farmer's personal information."),

            Layout::block(FarmerCreateAddressLayout::class)
                ->title('Address Information')
                ->description("This information collects farmer's address information."),

            Layout::block(FarmerCreateSkillLayout::class)
            ->title('Job and Education Information')
            ->description("This information collects farmer's job and education information."),

            Layout::block(FarmerCreateSalaryLayout::class)
            ->title('Salary Information')
            ->description("This information collects farmer's salary information.")
            ->commands(
                Button::make(__('Save'))
                ->type(Color::DEFAULT())
                ->icon('check')
                ->canSee($this->farmer_profile->exists)
                ->method('save')
            ),
        ];
    }

    public function save(Farmer_profile $farmer_profile, Request $request)
    {
        $request->validate([
        ]);

        $farmerprofileData = $request->get('farmer_profile');

        $farmer_profile
            ->fill($farmerprofileData)
            ->save();

        Toast::info(__('Farmer information was saved'));

        return redirect()->route('platform.systems.farmer.profiles.list');
    }
}
