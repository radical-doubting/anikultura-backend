<?php

namespace App\Orchid\Screens\Batch;

use App\Models\Batch\Batch;
use App\Orchid\Layouts\Batch\BatchListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

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
            'batches' => Batch::filters()
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
                ->route('platform.batches.create'),
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
            BatchListLayout::class,
        ];
    }

    /**
     * @param Batch $batches
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Batch $batches)
    {
        $batches->delete();

        Toast::info(__('Batch was removed'));

        return redirect()->route('platform.batches');
    }
}
