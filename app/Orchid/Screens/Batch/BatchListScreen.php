<?php

namespace App\Orchid\Screens\Batch;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Batch\BatchListLayout;
use App\Models\Batch\Batches;

class BatchListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Batches';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of all batches under SM KSK SAP.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [   
           //'batches'=>Batches::all()
           'batches'=> Batches::filters()
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
                ->route('platform.batch.create'),
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
            BatchListLayout::class
        ];
    }
}
