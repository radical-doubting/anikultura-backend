<?php

namespace App\Orchid\Layouts\Batch;

use App\Models\Crop\Crop;
use App\Models\User\Farmer\Farmer;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;

class BatchSeedAllocationEditLayout extends AnikulturaEditLayout
{
    protected function fields(): array
    {
        $currentBatchId = $this->query['batch']->id;

        return [
            Relation::make('batchSeedAllocation.farmer_id')
                ->fromModel(Farmer::class, 'name')
                ->searchColumns('first_name', 'last_name')
                ->displayAppend('full_name')
                ->applyScope('farmerBelongToBatch', $currentBatchId)
                ->required()
                ->title(__('Farmer'))
                ->placeholder(__('Farmer')),
            Group::make([
                Relation::make('batchSeedAllocation.crop_id')
                    ->fromModel(Crop::class, 'name')
                    ->required()
                    ->title(__('Crop'))
                    ->placeholder(__('Crop')),
                Input::make('batchSeedAllocation.seed_amount')
                    ->type('number')
                    ->required()
                    ->title(__('Seed Amount'))
                    ->placeholder(__('Seed Amount')),
            ]),
        ];
    }
}
