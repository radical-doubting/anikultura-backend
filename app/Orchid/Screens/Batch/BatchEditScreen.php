<?php

namespace App\Orchid\Screens\Batch;

use App\Actions\Batch\CreateBatch;
use App\Actions\Batch\DeleteBatch;
use App\Actions\Batch\DeleteBatchSeedAllocation;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSeedAllocation;
use App\Orchid\Layouts\Batch\BatchEditFarmlandLayout;
use App\Orchid\Layouts\Batch\BatchEditLayout;
use App\Orchid\Layouts\Batch\BatchEditMemberLayout;
use App\Orchid\Layouts\Batch\BatchEditSiteLayout;
use App\Orchid\Layouts\Batch\BatchSeedAllocationCommandLayout;
use App\Orchid\Layouts\Batch\BatchSeedAllocationListLayout;
use App\Orchid\Screens\AnikulturaEditScreen;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class BatchEditScreen extends AnikulturaEditScreen
{
    public Batch $batch;

    public Collection $batchSeedAllocations;

    protected $removeMethod = 'removeBatch';

    public function resourceName(): string
    {
        return __('batch');
    }

    public function exists(): bool
    {
        return $this->batch->exists;
    }

    public function query(Batch $batch): array
    {
        return [
            'batch' => $batch,
            'batchSeedAllocations' => $batch->seedAllocations,
        ];
    }

    public function layout(): array
    {
        $tabs = [
            __('Batch Information') => [
                Layout::block(BatchEditLayout::class)
                    ->title(__('Batch Information'))
                    ->description(__('Basic information of this batch')),
                Layout::block(BatchEditSiteLayout::class)
                    ->title(__('Batch Site'))
                    ->description(__('The assigned site location of this batch')),
                Layout::block(BatchEditFarmlandLayout::class)
                    ->title(__('Batch Farmlands'))
                    ->description(__('The farmlands who belong to this batch'))
                    ->canSee($this->exists()),
                Layout::block(BatchEditMemberLayout::class)
                    ->title(__('Batch Farmers'))
                    ->description(__('The farmers who belong to this batch'))
                    ->commands(
                        Button::make(__('Save'))
                            ->type(Color::DEFAULT())
                            ->icon('check')
                            ->method('save')
                    ),
            ],
        ];

        if ($this->exists()) {
            $tabs[__('Seeds Allocation')] = [
                Layout::block(BatchSeedAllocationCommandLayout::class)
                    ->title(__('Seeds Allocation'))
                    ->description(__('Seeds distributed to each farmer in this batch')),
                BatchSeedAllocationListLayout::class,
            ];
        }

        $activeTab = request()->get('seeds') ? __('Seeds Allocation') : __('Batch Information');

        return [
            Layout::tabs($tabs)->activeTab($activeTab),
        ];
    }

    public function removeBatch(Batch $batch): RedirectResponse
    {
        return DeleteBatch::runOrchidAction($batch, null);
    }

    public function removeBatchSeedAllocation(BatchSeedAllocation $batchSeedAllocation): RedirectResponse
    {
        return DeleteBatchSeedAllocation::runOrchidAction($batchSeedAllocation, null);
    }

    public function save(Batch $batch, Request $request): RedirectResponse
    {
        return CreateBatch::runOrchidAction($batch, $request);
    }
}
