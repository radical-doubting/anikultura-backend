<?php

namespace App\Orchid\Screens\Batch;

use App\Actions\Batch\DeleteBatch;
use App\Helpers\InsightsHelper;
use App\Models\Batch\Batch;
use App\Models\User\User;
use App\Orchid\Layouts\Batch\BatchFiltersLayout;
use App\Orchid\Layouts\Batch\BatchListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;

class BatchListScreen extends AnikulturaListScreen
{
    public function name(): string
    {
        return __('Batches');
    }

    public function query(): array
    {
        /**
         * @var User
         */
        $user = auth()->user();

        $query = Batch::query();

        if ($user->cannot('viewAny', Batch::class)) {
            $query = $query->ofBigBrother($user);
        }

        return [
            'batches' => $query
                ->filters()
                ->filtersApplySelection(BatchFiltersLayout::class)
                ->defaultSort('id')
                ->paginate(),
        ];
    }

    public function commandBar(): array
    {
        /**
         * @var User
         */
        $user = auth()->user();

        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.batches.create')
                ->canSee($user->can('create', Batch::class)),
            InsightsHelper::makeLink('batch'),
        ];
    }

    public function layout(): array
    {
        return [
            BatchFiltersLayout::class,
            BatchListLayout::class,
        ];
    }

    public function remove(Batch $batch, Request $request): RedirectResponse
    {
        return DeleteBatch::runOrchidAction($batch, $request);
    }
}
