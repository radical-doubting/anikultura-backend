<?php

namespace App\Orchid\Layouts\Batch;

use App\Models\Crop\Crop;
use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class BatchSeedAllocationEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        $currentBatchId = $this->query['batch']->id;

        return [
            Relation::make('batchSeedAllocation.farmer_id')
                ->fromModel(User::class, 'name')
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
                    ->max(255)
                    ->required()
                    ->title(__('Seed Amount'))
                    ->placeholder(__('Seed Amount')),
            ]),
        ];
    }
}
