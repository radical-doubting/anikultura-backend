<?php

namespace App\Http\Controllers\Api;

use App\Actions\Authentication\LoginFarmer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @OA\Post(
     *     path="/login",
     *     description="Login",
     *     tags={"auth"},
     *     @OA\Response(response="200", description="Authentication token"),
     *     @OA\Response(response="422", description="Validation errors occured")
     * )
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $username = $request->get('username');
        $password = $request->get('password');

        $authPayload = LoginFarmer::run($username, $password);

        if (!$authPayload) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json($authPayload);
    }


    /**
     * @OA\Post(
     *     path="/logout",
     *     description="Logout from current authenticated session",
     *     tags={"auth"},
     *     @OA\Tag(
     *       name="auth",
     *       description="Authentication endpoints"
     *     ),
     *     @OA\Response(response="200", description="Successful logout")
     * )
     */
    public function logout(Request $request)
    {
    }
}
