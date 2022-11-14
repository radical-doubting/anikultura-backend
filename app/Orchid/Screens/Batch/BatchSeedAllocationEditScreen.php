<?php

namespace App\Orchid\Screens\Batch;

use App\Actions\Batch\CreateBatchSeedAllocation;
use App\Actions\Batch\DeleteBatchSeedAllocation;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSeedAllocation;
use App\Orchid\Layouts\Batch\BatchSeedAllocationEditLayout;
use App\Orchid\Screens\AnikulturaEditScreen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Support\Facades\Dashboard;
use Orchid\Support\Facades\Layout;

class BatchSeedAllocationEditScreen extends AnikulturaEditScreen
{
    public Batch $batch;

    public BatchSeedAllocation $batchSeedAllocation;

    public function resourceName(): string
    {
        return __('batch seed allocation');
    }

    public function exists(): bool
    {
        return $this->batchSeedAllocation->exists;
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

    public function query(Batch $batch, BatchSeedAllocation $batchSeedAllocation): array
    {
        $this->authorize('view', [$batch, $batchSeedAllocation]);

        return [
            'batch' => $batch,
            'batchSeedAllocation' => $batchSeedAllocation,
        ];
    }

    public function layout(): array
    {
        return [
            Layout::block(BatchSeedAllocationEditLayout::class)
                ->title(__('Allocation Information'))
                ->description(__('Update seed allocation information.'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save')
                ),
        ];
    }

    public function remove(Batch $batch, BatchSeedAllocation $batchSeedAllocation, Request $request): RedirectResponse
    {
        return DeleteBatchSeedAllocation::runOrchidAction($batchSeedAllocation, $request);
    }

    public function save(Batch $batch, BatchSeedAllocation $batchSeedAllocation, Request $request): RedirectResponse
    {
        return CreateBatchSeedAllocation::runOrchidAction([
            'batch' => $batch,
            'batchSeedAllocation' => $batchSeedAllocation,
        ], $request);
    }
}
