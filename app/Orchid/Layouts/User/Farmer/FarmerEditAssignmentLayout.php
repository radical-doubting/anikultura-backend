<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User\Farmer;

use App\Models\Batch\Batch;
use App\Models\Farmland\Farmland;
use App\Models\User\User;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Relation;

class FarmerEditAssignmentLayout extends AnikulturaEditLayout
{
    public function fields(): iterable
    {
        /**
         * @var User
         */
        $user = auth()->user();

        $batchesRelationField = Relation::make('farmerAssignment.batches.')
            ->fromModel(Batch::class, 'farmschool_name')
            ->required()
            ->multiple()
            ->help(__('Search the name of this farmer\'s batches'))
            ->title(__('Batches'))
            ->placeholder(__('Batches'));

        $farmlandsRelationField = Relation::make('farmerAssignment.farmlands.')
            ->fromModel(Farmland::class, 'name')
            ->required()
            ->multiple()
            ->help(__('Search the name of this farmer\'s farmlands'))
            ->title(__('Farmlands'))
            ->placeholder(__('Farmlands'));

        if ($user->isBigBrother()) {
            $batchesRelationField = $batchesRelationField->applyScope('ofBigBrother', $user);
            $farmlandsRelationField = $farmlandsRelationField->applyScope('ofBigBrother', $user);
        }

        return [
            $batchesRelationField,
            $farmlandsRelationField,
        ];
    }
}
