<?php

namespace App\Orchid\Layouts\Farmland;

use App\Models\Batch\Batch;
use App\Models\Farmland\FarmlandStatus;
use App\Models\Farmland\FarmlandType;
use App\Models\User\User;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;

class FarmlandEditBasicLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        /**
         * @var User
         */
        $user = auth()->user();

        $batchRelationField = Relation::make('farmland.batch_id')
            ->fromModel(Batch::class, 'farmschool_name')
            ->required()
            ->title('Batch')
            ->placeholder(__('Batch'));

        if ($user->isBigBrother()) {
            $batchRelationField = $batchRelationField->applyScope('ofBigBrother', $user);
        }

        return [
            Input::make('farmland.name')
                ->type('text')
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            $batchRelationField,

            Group::make([
                Relation::make('farmland.type_id')
                    ->fromModel(FarmlandType::class, 'name')
                    ->required()
                    ->title(__('Type'))
                    ->placeholder(__('Type')),

                Relation::make('farmland.status_id')
                    ->fromModel(FarmlandStatus::class, 'name')
                    ->required()
                    ->title(__('Status'))
                    ->placeholder(__('Status')),
            ]),

            Input::make('farmland.hectares_size')
                ->required()
                ->title(__('Size (ha)'))
                ->placeholder(__('Size in hectares')),
        ];
    }
}
