<?php

namespace App\Orchid\Screens\Batch;

use App\Actions\Batch\CreateBatchSeedAllocation;
use App\Actions\Batch\DeleteBatchSeedAllocation;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSeedAllocation;
use App\Orchid\Layouts\Batch\BatchSeedAllocationEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class BatchSeedAllocationEditScreen extends Screen
{
    protected $exists = false;

    public function __construct()
    {
        $this->name = __('Create Batch Seed Allocation');
        $this->description = __('Create a new batch seed allocation');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Batch $batch, BatchSeedAllocation $batchSeedAllocation): array
    {
        $this->batch = $batch;
        $this->batchSeedAllocation = $batchSeedAllocation;
        $this->exists = $batchSeedAllocation->exists;

        if ($this->exists) {
            $this->name = __('Edit Batch Seed Allocation');
            $this->description = __('Edit a batch seed allocation under KSK SAP');
        }

        return [
            'batch' => $batch,
            'batchSeedAllocation' =>  $batchSeedAllocation,
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
                ->confirm(__('Once the batchSeedAllocation is deleted, all of its resouces and data will be permanently deleted.'))
                ->method('remove', [$this->batchSeedAllocation])
                ->canSee($this->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save', ['batchSeedAllocation' => $this->batchSeedAllocation->id]),
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
            Layout::block(BatchSeedAllocationEditLayout::class)
                ->title(__('Batch Information'))
                ->description(__('Update your batch\'s information.')),
        ];
    }

    /**
     * Remove a batch seed allocation.
     *
     * @param BatchSeedAllocation $batchSeedAllocation
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Batch $batch, BatchSeedAllocation $batchSeedAllocation)
    {
        return DeleteBatchSeedAllocation::runOrchidAction($batchSeedAllocation, null);
    }

    /**
     * Save a batch seed allocation.
     *
     * @param BatchSeedAllocation    $batchSeedAllocation
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Batch $batch, BatchSeedAllocation $batchSeedAllocation, Request $request)
    {
        return CreateBatchSeedAllocation::runOrchidAction($batchSeedAllocation, $request);
    }
}
