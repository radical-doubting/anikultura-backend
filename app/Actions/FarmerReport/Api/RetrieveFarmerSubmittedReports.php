<?php

namespace App\Actions\FarmerReport\Api;

use App\Http\Resources\FarmerReport\FarmerReportResource;
use App\Models\Farmer\Farmer;
use App\Models\FarmerReport\FarmerReport;
use App\Models\Farmland\Farmland;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerSubmittedReports
{
    use AsAction;

    public function handle(Farmer $farmer, Farmland $farmland): Collection
    {
        $farmerReports = FarmerReport::with([
            'crop',
            'verifier',
            'seedStage',
        ])->where('farmland_id', $farmland->id)
            ->where('reported_by', $farmer->id)
            ->orderBy('created_at', 'ASC')
            ->orderBy('seed_stage_id', 'DESC')
            ->get();

        return $farmerReports;
    }

    /**
     * @OA\Get(
     *     path="/farmer-reports/{farmlandId}",
     *     description="Get the submitted farmer reports of the logged in farmer",
     *     tags={"farmer-reports"},
     *     @OA\Parameter(
     *        name="farmlandId",
     *        in="path",
     *        required=true,
     *     ),
     *     @OA\Response(response="200", description="The submitted farmer reports", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request): AnonymousResourceCollection
    {
        /**
         * @var Farmer
         */
        $farmer = auth('api')->user();

        $farmlandId = $request->route('farmlandId');
        $farmland = Farmland::findOrFail($farmlandId);

        $farmerReports = $this->handle($farmer, $farmland);

        return FarmerReportResource::collection($farmerReports);
    }
}
