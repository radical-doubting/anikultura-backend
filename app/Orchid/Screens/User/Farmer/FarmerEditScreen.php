<?php

namespace App\Orchid\Screens\User\Farmer;

use App\Actions\User\Farmer\CreateFarmer;
use App\Actions\User\Farmer\DeleteFarmer;
use App\Models\User\Farmer\Farmer;
use App\Models\User\Farmer\FarmerAddress;
use App\Models\User\Farmer\FarmerProfile;
use App\Orchid\Layouts\Farmer\FarmerEditAccountLayout;
use App\Orchid\Layouts\Farmer\FarmerEditAddressLayout;
use App\Orchid\Layouts\Farmer\FarmerEditJobEducationLayout;
use App\Orchid\Layouts\Farmer\FarmerEditPersonalLayout;
use App\Orchid\Layouts\Farmer\FarmerEditSalaryLayout;
use App\Orchid\Screens\AnikulturaEditScreen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class FarmerEditScreen extends AnikulturaEditScreen
{
    public Farmer $farmer;

    public ?FarmerProfile $farmerProfile;

    public ?FarmerAddress $farmerAddress;

    protected $createVerb = 'Enroll';

    public function resourceName(): string
    {
        return __('farmer');
    }

    public function exists(): bool
    {
        return $this->farmer->exists;
    }

    public function query(Farmer $farmer): array
    {
        $farmerProfile = $farmer->profile;
        $farmerAddress = $farmerProfile?->farmerAddress;

        return [
            'farmer' => $farmer,
            'farmerProfile' => $farmerProfile,
            'farmerAddress' => $farmerAddress,
        ];
    }

    public function layout(): iterable
    {
        $tabs = [
            __('Account Information') => [
                Layout::block(FarmerEditAccountLayout::class)
                    ->title(__('Account Information'))
                    ->description(__("This information collects farmer's account information."))
                    ->commands(
                        Button::make(__('Save'))
                            ->type(Color::DEFAULT())
                            ->icon('check')
                            ->method('save')
                    ),
            ],

            __('Profile Information') => [
                Layout::block(FarmerEditPersonalLayout::class)
                    ->title(__('Personal Information'))
                    ->description(__("This information collects farmer's personal information.")),

                Layout::block(FarmerEditAddressLayout::class)
                    ->title(__('Address Information'))
                    ->description(__("This information collects farmer's address information.")),

                Layout::block(FarmerEditJobEducationLayout::class)
                    ->title(__('Job and Education Information'))
                    ->description(__("This information collects farmer's job and education information.")),

                Layout::block(FarmerEditSalaryLayout::class)
                    ->title(__('Salary Information'))
                    ->description(__("This information collects farmer's salary information."))
                    ->commands(
                        Button::make(__('Save'))
                            ->type(Color::DEFAULT())
                            ->icon('check')
                            ->method('save')
                    ),
            ],
        ];

        return [
            Layout::tabs($tabs)->activeTab(__('Account Information')),
        ];
    }

    public function save(Farmer $farmer, Request $request): RedirectResponse
    {
        return CreateFarmer::runOrchidAction($farmer, $request);
    }

    public function remove(Farmer $farmer): RedirectResponse
    {
        return DeleteFarmer::runOrchidAction($farmer, null);
    }
}
