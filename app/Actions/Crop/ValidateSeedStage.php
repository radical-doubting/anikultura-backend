<?php

namespace App\Actions\Crop;

use App\Actions\Crop\Api\RetrieveCurrentSeedStage;
use App\Actions\Crop\Api\RetrieveNextSeedStage;
use App\Models\Crop\SeedStage;
use App\Models\Farmland\Farmland;
use App\Models\User\Farmer\Farmer;
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;

class ValidateSeedStage
{
    use AsAction;

    public function __construct(
        protected RetrieveCurrentSeedStage $retrieveCurrentSeedStage,
        protected RetrieveNextSeedStage $retrieveNextSeedStage,
    ) {
    }

    public function handle(Farmer $farmer, Farmland $farmland): SeedStage
    {
        $currentSeedStage = $this->retrieveCurrentSeedStage->handle(
            $farmer,
            $farmland
        );

        $nextSeedStage = $this->retrieveNextSeedStage->handle($currentSeedStage);

        if (is_null($nextSeedStage)) {
            throw new Exception('No next seed stage');
        }

        return $nextSeedStage;
    }
}
