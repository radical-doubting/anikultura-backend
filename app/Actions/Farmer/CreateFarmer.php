<?php

namespace App\Actions\Farmer;

use App\Actions\User\CreateUser;
use App\Models\Farmer\Farmer;
use App\Models\Farmer\FarmerAddress;
use App\Models\Farmer\FarmerProfile;
use App\Models\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateFarmer
{
    use AsAction;
    use AsOrchidAction;

    public function __construct(
        protected CreateUser $createUser,
        protected CreateFarmerProfile $createFarmerProfile,
        protected CreateFarmerAddress $createFarmerAddress
    ) {
    }

    public function handle(Farmer $farmer, array $farmerData): Farmer
    {
        $createdAccount = $this->createUser->handle(
            $farmer,
            $farmerData['account']
        );

        $farmerProfile = $this->createProfileOrUpdate($createdAccount);

        $updatedFarmerProfile = $this->createFarmerProfile->handle(
            $farmerProfile,
            $farmerData['profile']
        );

        $this->updateProfileType($createdAccount, $updatedFarmerProfile);

        $farmerAddress = $this->createFarmerAddressOrUpdate($updatedFarmerProfile);

        $this->createFarmerAddress->handle(
            $updatedFarmerProfile,
            $farmerAddress,
            $farmerData['address']
        );

        return $farmer->refresh();
    }

    private function createProfileOrUpdate(User $user): FarmerProfile
    {
        $farmerProfile = $user->profile;

        return is_null($farmerProfile) ? new FarmerProfile() : $farmerProfile;
    }

    private function updateProfileType(User $createdAccount, FarmerProfile $farmerProfile): void
    {
        $createdAccount->update([
            'profile_id' => $farmerProfile->id,
            'profile_type' => Farmer::$profilePath,
        ]);

        $createdAccount->refresh();
    }

    private function createFarmerAddressOrUpdate(FarmerProfile $farmerProfile): FarmerAddress
    {
        $farmerAddress = $farmerProfile->farmerAddress;

        return is_null($farmerAddress) ? new FarmerAddress() : $farmerAddress;
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $this->validateIfFarmerAccountExistsAlready($model, $request);

        $this->handle($model, [
            'account' => $request->get('farmer'),
            'profile' => $request->get('farmerProfile'),
            'address' => $request->get('farmerAddress'),
        ]);

        Toast::info(__('Farmer profile was saved successfully!'));

        return redirect()->back();
    }

    private function validateIfFarmerAccountExistsAlready(Farmer $farmer, Request $request): void
    {
        $userNameShouldBeUnique = Rule::unique(Farmer::class, 'name')->ignore($farmer);
        $emailShouldBeUnique = Rule::unique(Farmer::class, 'email')->ignore($farmer);

        $request->validate([
            'farmer.name' => [
                'required',
                $userNameShouldBeUnique,
            ],
            'farmer.email' => [
                $emailShouldBeUnique,
            ],
        ]);
    }

    public function rules(): array
    {
        return [
            'farmerProfile.gender_id' => [
                'required',
            ],

            'farmerProfile.civil_status_id' => [
                'required',
            ],

            'farmerProfile.birthday' => [
                'required',
            ],

            'farmerProfile.quantity_family_members' => [
                'required',
            ],

            'farmerProfile.quantity_dependents' => [
                'required',
            ],

            'farmerProfile.quantity_working_dependents' => [
                'required',
            ],

            'farmerProfile.educational_status_id' => [
                'required',
            ],

            'farmerProfile.college_course' => [],

            'farmerProfile.current_job' => [
                'required',
            ],

            'farmerProfile.farming_years' => [
                'required',
            ],

            'farmerProfile.usual_crops_planted' => [
                'required',
            ],

            'farmerProfile.affiliated_organization' => [
                'required',
            ],

            'farmerProfile.tesda_training_joined' => [
                'required',
            ],

            'farmerProfile.nc_passer_status_id' => [
                'required',
            ],

            'farmerProfile.salary_periodicity_id' => [
                'required',
            ],

            'farmerProfile.estimated_salary' => [
                'required',
            ],

            'farmerProfile.social_status_id' => [
                'required',
            ],

            'farmerProfile.social_status_reason' => [
                'required',
            ],

            'farmerAddress.house_number' => [
                'required',
            ],

            'farmerAddress.street' => [
                'required',
            ],

            'farmerAddress.barangay' => [
                'required',
            ],

            'farmerAddress.municity' => [
                'required',
            ],

            'farmerAddress.province' => [
                'required',
            ],

            'farmerAddress.region_id' => [
                'required',
            ],
        ];
    }
}
