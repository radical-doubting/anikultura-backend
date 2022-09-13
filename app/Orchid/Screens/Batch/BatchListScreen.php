<?php

namespace App\Orchid\Screens\Batch;

use App\Actions\Batch\DeleteBatch;
use App\Models\Batch\Batch;
use App\Orchid\Layouts\Batch\BatchFiltersLayout;
use App\Orchid\Layouts\Batch\BatchListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Orchid\Screen\Actions\Link;

class BatchListScreen extends AnikulturaListScreen
{
    public function name(): string
    {
        return __('Batches');
    }
    public function query(): array
    {
        return [
            'batches' => Batch::filters()
                ->filters()
                ->filtersApplySelection(BatchFiltersLayout::class)
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
            BatchFiltersLayout::class,
            BatchListLayout::class,
        ];
    }

    /**
     * Remove a batch.
     *
     * @param  Batch  $batch
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(Batch $batch)
    {
        return DeleteBatch::runOrchidAction($batch, null);
    }
}
