<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Anikultura API Docs",
 *      description="Documentation for the Anikultura REST API",
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url="http://localhost/api/",
 *      description="This anikultura server"
 * )
 *
 * @OA\Server(
 *      url="https://ani-be-stg.herokuapp.com/api/",
 *      description="Anikultura staging server"
 * )
 *
 *  @OA\Tag(
 *       name="auth",
 *       description="Endpoints related with authentication such as login and logout."
 *  )
 *  @OA\Tag(
 *       name="crops",
 *       description="Endpoints related with crops such as retrieving current seed stage and allocated seeds."
 *  )
 *  @OA\Tag(
 *       name="farmlands",
 *       description="Endpoints related with farmlands such as what farmland a farmer belongs in."
 *  )
 *  @OA\Tag(
 *       name="farmers",
 *       description="Endpoints related with farmers such as updating tutorial state."
 *  )
 *  @OA\Tag(
 *       name="farmer-reports",
 *       description="Endpoints related with farmer reports such as submitting and retrieving their history."
 *  )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
