<?php

namespace App\Orchid\Screens\Farmer;

use App\Actions\Farmer\CreateFarmerProfile;
use App\Actions\Farmer\DeleteFarmerProfile;
use App\Models\Farmer\FarmerProfile;
use App\Orchid\Layouts\Farmer\FarmerEditAddressLayout;
use App\Orchid\Layouts\Farmer\FarmerEditLoginLayout;
use App\Orchid\Layouts\Farmer\FarmerEditProfileLayout;
use App\Orchid\Layouts\Farmer\FarmerEditSalaryLayout;
use App\Orchid\Layouts\Farmer\FarmerEditSkillLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class FarmerEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit Farmer Profile';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Edit farmer profile details';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(FarmerProfile $farmerProfile): array
    {
        $this->farmerProfile = $farmerProfile;
        $this->farmerAddress = $farmerProfile->farmerAddress;

        if (!$farmerProfile->exists) {
            $this->name = __('Create Farmer Profile');
            $this->description = __('Create a new farmer profile');
        }

        return [
            'farmer_profile' => $farmerProfile,
            'farmer_address' => $farmerProfile->farmer_address,
            'user' => $farmerProfile->user,
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
                ->confirm(__('Once the farmer profile is deleted, all of its resources and data will be permanently deleted.'))
                ->method('remove')
                ->canSee($this->farmerProfile->exists),

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
            Layout::block(FarmerEditLoginLayout::class)
                ->title('Account Information')
                ->description("This information collects farmer's account information."),

            Layout::block(FarmerEditProfileLayout::class)
                ->title('Personal Information')
                ->description("This information collects farmer's personal information."),

            Layout::block(FarmerEditAddressLayout::class)
                ->title('Address Information')
                ->description("This information collects farmer's address information."),

            Layout::block(FarmerEditSkillLayout::class)
                ->title('Job and Education Information')
                ->description("This information collects farmer's job and education information."),

            Layout::block(FarmerEditSalaryLayout::class)
                ->title('Salary Information')
                ->description("This information collects farmer's salary information."),
        ];
    }

    /**
     * Save a farmer profile.
     *
     * @param FarmerProfile $farmerProfile
     * @param Request       $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(FarmerProfile $farmerProfile, Request $request)
    {
        return CreateFarmerProfile::runOrchidAction($farmerProfile, $request);
    }

    /**
     * Removes a farmer profile.
     *
     * @param FarmerProfile $farmerProfile
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(FarmerProfile $farmerProfile)
    {
        return DeleteFarmerProfile::runOrchidAction($farmerProfile, null);
    }
}
