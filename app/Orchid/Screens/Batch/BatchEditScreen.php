<?php

namespace App\Orchid\Screens\Batch;

use App\Actions\Batch\CreateBatch;
use App\Actions\Batch\DeleteBatch;
use App\Models\Batch\Batch;
use App\Orchid\Layouts\Batch\BatchEditFarmersLayout;
use App\Orchid\Layouts\Batch\BatchEditLayout;
use App\Orchid\Layouts\Batch\BatchEditSiteLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class BatchEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit Batch';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Edit a batch under KSK SAP';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Batch $batches): array
    {
        $this->batches = $batches;

        if (!$batches->exists) {
            $this->name = 'Create Batch';
            $this->description = 'Create a new batch';
        }

        return [
            'batches' => $batches,
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
                ->confirm(__('Once the batch is deleted, all of its resouces and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->batches->exists),

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
        return [
            Layout::block(BatchEditLayout::class)
                ->title(__('Batch Information'))
                ->description(__('Update your batch\'s information.')),
            Layout::block(BatchEditSiteLayout::class)
                ->title(__('Batch Site'))
                ->description(__('Enter where is the assigned site of the batch')),
            Layout::block(BatchEditFarmersLayout::class)
                ->title(__('Enrolled Farmers'))
                ->description(__('Add Farmers included in the batch.')),
        ];
    }

    /**
     * Remove a batch.
     *
     * @param Batch $batch
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Batch $batch)
    {
        return DeleteBatch::runOrchidAction($batch, null);
    }

    /**
     * Save a batch.
     *
     * @param Batch    $batch
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Batch $batch, Request $request)
    {
        return CreateBatch::runOrchidAction($batch, $request);
    }
}
