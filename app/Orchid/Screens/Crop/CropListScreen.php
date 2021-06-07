<?php

namespace App\Orchid\Screens\Crop;

use App\Models\Crop;
use App\Orchid\Layouts\Crop\CropListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

class CropListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Crop Type Dashboard';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of all Crop types under SM KSK SAP';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [   
           'crops'=> Crop::filters()
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
            ->route('platform.crops.create')
              
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
           CropListLayout::class
        ];
    }
    
   public function remove(Crop $crop)
    {
        $crop->delete();

        Toast::info(__('Crop was removed'));

        return redirect()->route('platform.crops');
    }
    
}
