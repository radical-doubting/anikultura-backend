<?php

namespace App\Orchid\Screens\Farmer;

use App\Actions\Farmer\CreateFarmer;
use App\Actions\Farmer\DeleteFarmer;
use App\Models\Farmer\Farmer;
use App\Orchid\Layouts\Farmer\FarmerEditAddressLayout;
use App\Orchid\Layouts\Farmer\FarmerEditJobEducationLayout;
use App\Orchid\Layouts\Farmer\FarmerEditPersonalLayout;
use App\Orchid\Layouts\Farmer\FarmerEditSalaryLayout;
use App\Orchid\Layouts\User\UserEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class FarmerEditScreen extends Screen
{
    protected $exists = false;

    public function __construct()
    {
        $this->name = __('Create Farmer');
        $this->description = __('Create a new farmer');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Farmer $farmer): array
    {
        $this->exists = $farmer->exists;

        if ($this->exists) {
            $this->name = __('Edit Farmer');
            $this->description = __('Edit farmer details');
        }

        $farmerProfile = $farmer->profile;
        $farmerAddress = $this->exists ? $farmerProfile->farmerAddress : null;

        return [
            'user' => $farmer,
            'farmer_profile' => $farmerProfile,
            'farmer_address' => $farmerAddress,
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
                ->canSee($this->exists),

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
            Layout::block(UserEditLayout::class)
                ->title('Account Information')
                ->description("This information collects farmer's account information."),

            Layout::block(FarmerEditPersonalLayout::class)
                ->title('Personal Information')
                ->description("This information collects farmer's personal information."),

            Layout::block(FarmerEditAddressLayout::class)
                ->title('Address Information')
                ->description("This information collects farmer's address information."),

            Layout::block(FarmerEditJobEducationLayout::class)
                ->title('Job and Education Information')
                ->description("This information collects farmer's job and education information."),

            Layout::block(FarmerEditSalaryLayout::class)
                ->title('Salary Information')
                ->description("This information collects farmer's salary information.")
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save')
                ),
        ];
    }

    /**
     * Save a farmer.
     *
     * @param Farmer $farmer
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Farmer $farmer, Request $request)
    {
        return CreateFarmer::runOrchidAction($farmer, $request);
    }

    /**
     * Removes a farmer.
     *
     * @param Farmer $farmer
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Farmer $farmer)
    {
        return DeleteFarmer::runOrchidAction($farmer, null);
    }
}
