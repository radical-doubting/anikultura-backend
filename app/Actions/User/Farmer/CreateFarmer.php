<?php

namespace App\Actions\User\Farmer;

use App\Actions\User\CreateUser;
use App\Actions\User\ValidateUserAccount;
use App\Models\User\Farmer\Farmer;
use App\Models\User\Farmer\FarmerAddress;
use App\Models\User\Farmer\FarmerProfile;
use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateFarmer
{
    use AsAction;
    use AsOrchidAction;

    public function __construct(
        protected CreateUser $createUser,
        protected CreateFarmerProfile $createFarmerProfile,
        protected CreateFarmerAddress $createFarmerAddress,
        protected ValidateUserAccount $validateUserAccount,
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
        $this->createFarmerAssignment($farmer, $farmerData);

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
            'profile_type' => Farmer::PROFILE_PATH,
        ]);

        $createdAccount->refresh();
    }

    private function createFarmerAddressOrUpdate(FarmerProfile $farmerProfile): FarmerAddress
    {
        $farmerAddress = $farmerProfile->farmerAddress;

        return is_null($farmerAddress) ? new FarmerAddress() : $farmerAddress;
    }

    private function createFarmerAssignment(Farmer $farmer, array $farmerData): void
    {
        if (! array_key_exists('assignment', $farmerData)) {
            return;
        }

        $assignmentData = $farmerData['assignment'];

        $farmer
            ->batches()
            ->sync($assignmentData['batches']);

        $farmer
            ->farmlands()
            ->sync($assignmentData['farmlands']);
    }

    private function validateFarmerAssignment(Farmer $farmer, Request $request): void
    {
        $request->validate([
            'farmerAssignment.batches' => [
                'required',
                'array',
            ],
            'farmerAssignment.batches.*' => [
                'integer',
                'exists:batches,id',
            ],
            'farmerAssignment.farmlands' => [
                'required',
                'array',
            ],
            'farmerAssignment.farmlands.*' => [
                'integer',
                'exists:farmlands,id',
            ],
        ]);
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $this->validateUserAccount->handle(
            $model,
            'farmer',
            Farmer::class,
            $request
        );

        $farmerData = [
            'account' => $request->get('farmer'),
            'profile' => $request->get('farmerProfile'),
            'address' => $request->get('farmerAddress'),
        ];

        if (! $model->exists) {
            $this->validateFarmerAssignment($model, $request);
            $farmerData['assignment'] = $request->get('farmerAssignment');
        }

        $this->handle($model, $farmerData);

        Toast::info(__('Farmer was saved successfully!'));

        return redirect()->route('platform.farmers.edit', [
            $model->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'farmerProfile.gender_id' => [
                'required',
                'integer',
                'exists:genders,id',
            ],

            'farmerProfile.civil_status_id' => [
                'required',
                'integer',
                'exists:civil_statuses,id',
            ],

            'farmerProfile.birthday' => [
                'required',
                'date',
            ],

            'farmerProfile.quantity_family_members' => [
                'required',
                'integer',
                'min:0',
                'max:30',
            ],

            'farmerProfile.quantity_dependents' => [
                'required',
                'integer',
                'min:0',
                'max:30',
            ],

            'farmerProfile.quantity_working_dependents' => [
                'required',
                'integer',
                'min:0',
                'max:30',
            ],

            'farmerProfile.educational_status_id' => [
                'required',
                'integer',
                'exists:educational_statuses,id',
            ],

            'farmerProfile.college_course' => [
                'nullable',
                'alpha_num_space_dash',
            ],

            'farmerProfile.current_job' => [
                'required',
                'alpha_num_space_dash',
            ],

            'farmerProfile.farming_years' => [
                'required',
                'integer',
                'min:0',
                'max:100',
            ],

            'farmerProfile.usual_crops_planted' => [
                'required',
                'string',
            ],

            'farmerProfile.affiliated_organization' => [
                'required',
                'alpha_num_space_dash',
            ],

            'farmerProfile.tesda_training_joined' => [
                'required',
                'alpha_num_space_dash',
            ],

            'farmerProfile.nc_passer_status_id' => [
                'required',
                'integer',
                'exists:nc_passer_statuses,id',
            ],

            'farmerProfile.salary_periodicity_id' => [
                'required',
                'integer',
                'exists:salary_periodicities,id',
            ],

            'farmerProfile.estimated_salary' => [
                'required',
                'numeric',
                'min:1',
                'max:1000000',
            ],

            'farmerProfile.social_status_id' => [
                'required',
                'integer',
                'exists:social_statuses,id',
            ],

            'farmerProfile.social_status_reason' => [
                'required',
                'string',
                'min:10',
                'max:255',
            ],

            'farmerAddress.house_number' => [
                'required',
                'string',
                'min:1',
                'max:10',
            ],

            'farmerAddress.street' => [
                'required',
                'string',
                'min:3',
                'max:70',
            ],

            'farmerAddress.barangay' => [
                'required',
                'alpha_num_space_dash',
                'min:3',
                'max:70',
            ],

            'farmerAddress.municity' => [
                'required',
                'alpha_num_space_dash',
                'min:3',
                'max:70',
            ],

            'farmerAddress.province' => [
                'required',
                'alpha_num_space_dash',
                'min:3',
                'max:70',
            ],

            'farmerAddress.region_id' => [
                'required',
                'integer',
                'exists:regions,id',
            ],
        ];
    }

    public function authorize(Request $request, mixed $model): bool
    {
        /**
         * @var User
         */
        $user = $request->user();

        return $user->canAny(['create', 'update'], $model);
    }
}
