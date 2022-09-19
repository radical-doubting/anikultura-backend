<?php

namespace App\Orchid\Screens\Batch;

use App\Actions\Batch\CreateBatchSeedAllocation;
use App\Actions\Batch\DeleteBatchSeedAllocation;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSeedAllocation;
use App\Orchid\Layouts\Batch\BatchSeedAllocationEditLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Dashboard;
use Orchid\Support\Facades\Layout;

class BatchSeedAllocationEditScreen extends Screen
{
    protected $exists = false;

    public function __construct()
    {
        $this->name = __('Create Batch Seed Allocation');
        $this->description = __('Create a new batch seed allocation');
    }

    public function handle(Request $request, ...$parameters)
    {
        Dashboard::setCurrentScreen($this);

        abort_unless($this->checkAccess($request), 403);

        if ($request->isMethod('GET')) {
            return $this->redirectOnGetMethodCallOrShowView($parameters);
        }

        $method = Route::current()->parameter('method', Arr::last($parameters));

        $prepare = collect($parameters)
            ->merge($request->query())
            ->diff($method)
            ->all();

        return $this->callMethod($method, $prepare) ?? back();
    }

    private function callMethod(string $method, array $parameters = [])
    {
        return call_user_func_array(
            [$this, $method],
            $this->resolveDependencies($method, $parameters)
        );
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
            $this->description = __('Edit a batch seed allocation details');
        }

        return [
            'batch' => $batch,
            'batchSeedAllocation' => $batchSeedAllocation,
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
                ->confirm(__('Once the Batch Seed Allocation is deleted, all of its resouces and data will be permanently deleted.'))
                ->method('remove')
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
        return [
            Layout::block(BatchSeedAllocationEditLayout::class)
                ->title(__('Batch Information'))
                ->description(__('Update your batch\'s information.')),
        ];
    }

    /**
     * Remove a batch seed allocation.
     *
     * @param  BatchSeedAllocation  $batchSeedAllocation
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(Batch $batch, BatchSeedAllocation $batchSeedAllocation)
    {
        return DeleteBatchSeedAllocation::runOrchidAction($batchSeedAllocation, null);
    }

    /**
     * Save a batch seed allocation.
     *
     * @param  BatchSeedAllocation  $batchSeedAllocation
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Batch $batch, BatchSeedAllocation $batchSeedAllocation, Request $request)
    {
        return CreateBatchSeedAllocation::runOrchidAction([
            'batch' => $batch,
            'batchSeedAllocation' => $batchSeedAllocation,
        ], $request);
    }
}
