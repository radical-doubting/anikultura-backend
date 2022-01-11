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
 *       description="Authentication endpoints"
 *  )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
