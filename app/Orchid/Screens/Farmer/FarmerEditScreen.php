<?php

namespace App\Orchid\Screens\Farmer;

use App\Models\Farmer\FarmerAddress;
use Illuminate\Http\Request;
use App\Models\Farmer\FarmerProfile;
use App\Models\User;
use App\Orchid\Layouts\Farmer\FarmerEditLoginLayout;
use App\Orchid\Layouts\Farmer\FarmerEditProfileLayout;
use App\Orchid\Layouts\Farmer\FarmerEditSkillLayout;
use App\Orchid\Layouts\Farmer\FarmerEditAddressLayout;
use App\Orchid\Layouts\Farmer\FarmerEditSalaryLayout;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Field;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\Action;

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

    public function query(FarmerProfile $farmer_profile): array
    {
        $this->farmer_profile = $farmer_profile;
        $this->farmer_address = $farmer_profile->farmer_address;

        if (!$farmer_profile->exists) {
            $this->name = 'Create Farmer Profile';
            $this->description = 'Create a new farmer profile';
        }

        return [
            'farmer_profile' => $farmer_profile,
            'farmer_address' => $farmer_profile->farmer_address
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
                ->canSee($this->farmer_profile->exists),

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

            /*Add Next Button*/
        ];
    }

    /**
     * @param FarmerProfile    $farmer_profile
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(FarmerProfile $farmer_profile, Request $request)
    {
        $request->validate([
            // Farmer Profile
            'farmer_profile.gender' => [
                'required'
            ],

            'farmer_profile.civil_status' => [
                'required'
            ],

            'farmer_profile.birthday' => [
                'required'
            ],

            'farmer_profile.age' => [
                'required'
            ],

            'farmer_profile.quantity_family_members' => [
                'required'
            ],

            'farmer_profile.quantity_dependents' => [
                'required'
            ],

            'farmer_profile.quantity_working_dependents' => [
                'required'
            ],

            'farmer_profile.highest_educational_status' => [
                'required'
            ],

            'farmer_profile.college_course' => [
                'required'
            ],

            'farmer_profile.current_job' => [
                'required'
            ],

            'farmer_profile.farming_years' => [
                'required'
            ],

            'farmer_profile.usual_crops_planted' => [
                'required'
            ],

            'farmer_profile.affiliated_organization' => [
                'required'
            ],

            'farmer_profile.tesda_training_joined' => [
                'required'
            ],

            'farmer_profile.nc_passer_status' => [
                'required'
            ],

            'farmer_profile.salary_periodicity' => [
                'required'
            ],

            'farmer_profile.estimated_salary' => [
                'required'
            ],

            'farmer_profile.social_status' => [
                'required'
            ],

            'farmer_profile.social_status_reason' => [
                'required'
            ],

            // Farmer Address
            'farmer_address.house_number' => [
                'required'
            ],

            'farmer_address.street' => [
                'required'
            ],

            'farmer_address.barangay' => [
                'required'
            ],

            'farmer_address.municity' => [
                'required'
            ],

            'farmer_address.province' => [
                'required'
            ],

            'farmer_address.region_id' => [
                'required'
            ],

            // User
            'user.name' => [
                'required'
            ],

            'user.password' => [
                'required'
            ],
        ]);

        $farmer_user_id = $this->save_user($request);

        $farmer_profile_data = $request->get('farmer_profile');

        $farmer_profile
            ->fill($farmer_profile_data)
            ->fill([
                'user_id' => $farmer_user_id
            ])
            ->save();

        $this->save_address($farmer_profile, $request);

        Toast::info(__('Farmer Profile was saved'));

        return redirect()->route('platform.farmer.profile.view.all');
    }

    /**
     * @param Request $request
     */
    private function save_user(Request $request)
    {
        $farmer_user_data = $request->get('user');
        $farmer_user = new User($farmer_user_data);
        $farmer_user->save();

        return $farmer_user->id;
    }

    /**
     * @param FarmerProfile   $farmer_profile
     * @param Request         $request
     */
    private function save_address(FarmerProfile $farmer_profile, Request $request)
    {
        $farmer_address_data = $request->get('farmer_address');

        if (!$farmer_profile->farmer_address()->exists()) {
            $farmer_address = new FarmerAddress($farmer_address_data);
            $farmer_address->farmer_profile_id = $farmer_profile->id;

            $farmer_profile
                ->farmer_address()
                ->save($farmer_address);
        } else {
            $farmer_profile
                ->farmer_address()
                ->update($farmer_address_data);
        }
    }

    /**
     * @param FarmerProfile $farmer_profile
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(FarmerProfile $farmer_profile)
    {
        $farmer_profile->delete();

        Toast::info(__('Farmer Profile was removed successfully'));

        return redirect()->route('platform.farmer.profile.view.all');
    }

    public function next(FarmerProfile $farmer_profile)
    {
        return redirect()->route('platform.farmer.farmland.create');
    }
}
