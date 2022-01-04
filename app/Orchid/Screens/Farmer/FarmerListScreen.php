<?php

namespace App\Orchid\Screens\Farmer;

use App\Models\Farmer\FarmerProfile;
use App\Orchid\Layouts\Farmer\FarmerListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class FarmerListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Farmer Profiles';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of all farmers under SM KSK SAP';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'farmer_profiles' => FarmerProfile::with('user')
                ->filters()
                ->defaultSort('id')
                ->paginate(),
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
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.farmer.profile.create'),
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
            FarmerListLayout::class,
        ];
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
}
