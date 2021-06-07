<?php

namespace App\Orchid\Screens\Farmer;

use App\Orchid\Layouts\Farmer\FarmerListLayout;
<<<<<<< HEAD
use App\Models\FarmerProfile;
=======
use App\Models\Farmer\FarmerProfile;
>>>>>>> 77f5d923c32254527826ab3f58a756ddb672ea6e
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

class FarmerListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */

    public $name = 'Farmer Profile';

    /**
     * Display header description.
     *
     * @var string|null
     */

    public $description = "List of all farmers under SM KSK SAP";

    /**
     * Query data.
     *
     * @return array
     */

    public function query(): array
    {
        return [
            'farmer_profile' => FarmerProfile::filters()
                ->defaultSort('id')
                ->paginate()
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
            FarmerListLayout::class
        ];
    }

    /**
     * @param FarmerProfile $farmer_profile
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
<<<<<<< HEAD
    
=======

>>>>>>> 77f5d923c32254527826ab3f58a756ddb672ea6e
    public function remove(FarmerProfile $farmer_profile)
    {
        $farmer_profile->delete();

        Toast::info(__('Farmer Profile was removed successfully'));

        return redirect()->route('platform.farmer.profile.view.all');
    }
}
