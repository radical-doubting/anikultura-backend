<?php

namespace App\Actions\FarmerReport;

use App\Http\Resources\FarmerReport\FarmerReportResource;
use App\Models\Farmer\Farmer;
use App\Models\FarmerReport\FarmerReport;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerSubmittedReports
{
    use AsAction;

    public function handle($farmer)
    {
        $farmerReports = FarmerReport::with([
            'crop',
            'verifier',
            'seedStage',
        ])->where('reported_by', $farmer->id)
            ->orderBy('created_at', 'ASC')
            ->orderBy('seed_stage_id', 'DESC')
            ->get();

        return $farmerReports;
    }

    /**
     * @OA\Get(
     *     path="/farmer-reports",
     *     description="Get the submitted farmer reports of the logged in farmer",
     *     tags={"farmer-reports"},
     *     @OA\Response(response="200", description="The submitted farmer reports", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request)
    {
        $user = auth('api')->user();

        $farmerReports = $this->handle($user);

        return response()->json(FarmerReportResource::collection($farmerReports));
    }
}
