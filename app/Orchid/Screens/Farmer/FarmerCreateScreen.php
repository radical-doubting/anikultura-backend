<?php

namespace App\Orchid\Screens\Farmer;

use Orchid\Screen\Screen;
use App\Orchid\Layouts\Farmer\FarmerCreateLoginLayout;
use App\Orchid\Layouts\Farmer\FarmerCreateProfileLayout;
use App\Orchid\Layouts\Farmer\FarmerCreateSkillLayout;
use App\Orchid\Layouts\Farmer\FarmerCreateAddressLayout;
use App\Orchid\Layouts\Farmer\FarmerCreateSalaryLayout;
use App\Models\Farmer\Farmer_profile;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Field;

class FarmerCreateScreen extends Screen
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
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
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
            ->description("This information collects farmer's salary information."),
        ];
    }
}
