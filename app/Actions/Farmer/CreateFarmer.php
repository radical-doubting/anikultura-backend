<?php

namespace App\Actions\Farmer;

use App\Actions\User\CreateUser;
use App\Models\Farmer\Farmer;
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

    public function handle(Farmer $farmer, array $farmerData)
    {
        $createdAccountId = CreateUser::run($farmer, $farmerData['account']);
        $createdAccount = User::find($createdAccountId);

        $this->createProfile($createdAccount, $farmerData['profile']);

        CreateFarmerAddress::run($createdAccount->profile, $farmerData['address']);
    }

    private function createProfile(User $createdAccount, $profileData)
    {
        $farmerProfileId = CreateFarmerProfile::run($createdAccount->profile, $profileData);

        $createdAccount->update([
            'profile_id' => $farmerProfileId,
            'profile_type' => Farmer::$profilePath,
        ]);

        $createdAccount->refresh();
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

        return redirect()->route('platform.farmers');
    }

    private function validateIfFarmerAccountExistsAlready($farmer, Request $request)
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
            'farmerProfile.gender' => [
                'required',
            ],

            'farmerProfile.civil_status' => [
                'required',
            ],

            'farmerProfile.birthday' => [
                'required',
            ],

            'farmerProfile.age' => [
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

            'farmerProfile.highest_educational_status' => [
                'required',
            ],

            'farmerProfile.college_course' => [
                'required',
            ],

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

            'farmerProfile.nc_passer_status' => [
                'required',
            ],

            'farmerProfile.salary_periodicity' => [
                'required',
            ],

            'farmerProfile.estimated_salary' => [
                'required',
            ],

            'farmerProfile.social_status' => [
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
