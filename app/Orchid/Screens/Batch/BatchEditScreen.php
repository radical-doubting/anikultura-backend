<?php

namespace App\Orchid\Screens\Batch;

use App\Actions\Batch\CreateBatch;
use App\Actions\Batch\DeleteBatch;
use App\Actions\Batch\DeleteBatchSeedAllocation;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSeedAllocation;
use App\Orchid\Layouts\Batch\BatchEditFarmersLayout;
use App\Orchid\Layouts\Batch\BatchEditLayout;
use App\Orchid\Layouts\Batch\BatchEditSiteLayout;
use App\Orchid\Layouts\Batch\BatchSeedAllocationCommandLayout;
use App\Orchid\Layouts\Batch\BatchSeedAllocationListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class BatchEditScreen extends Screen
{
    protected $exists;

    public function __construct()
    {
        $this->name = __('Create Batch');
        $this->description = __('Create a new batch');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Batch $batch): array
    {
        $this->batch = $batch;
        $this->exists = $batch->exists;

        if ($this->exists) {
            $this->name = __('Edit Batch');
            $this->description = __('Edit batch details');
        }

        return [
            'batch' => $batch,
            'batchSeedAllocations' => $batch->seedAllocations,
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
                ->confirm(__('Once the batch is deleted, all of its resources and data will be permanently deleted.'))
                ->method('removeBatch')
                ->canSee($this->exists),

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
        $tabs = [
            'Batch Information' => [
                Layout::block(BatchEditLayout::class)
                    ->title(__('Batch Information'))
                    ->description(__('Basic information of this batch')),
                Layout::block(BatchEditSiteLayout::class)
                    ->title(__('Batch Site'))
                    ->description(__('The assigned site location of this batch')),
                Layout::block(BatchEditFarmersLayout::class)
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

        if ($this->exists) {
            $tabs['Seeds Allocation'] = [
                Layout::block(BatchSeedAllocationCommandLayout::class)
                    ->title(__('Seeds Allocation'))
                    ->description(__('Seeds distributed to each farmer in this batch')),
                BatchSeedAllocationListLayout::class,
            ];
        }

        return [
            Layout::tabs($tabs)->activeTab('Batch Information'),
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
    public function removeBatch(Batch $batch)
    {
        return DeleteBatch::runOrchidAction($batch, null);
    }

    /**
     * Remove a batch seed allocation.
     *
     * @param  BatchSeedAllocation  $batchSeedAllocation
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function removeBatchSeedAllocation(BatchSeedAllocation $batchSeedAllocation)
    {
        return DeleteBatchSeedAllocation::runOrchidAction($batchSeedAllocation, null);
    }

    /**
     * Save a batch.
     *
     * @param  Batch  $batch
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Batch $batch, Request $request)
    {
        return CreateBatch::runOrchidAction($batch, $request);
    }
}
