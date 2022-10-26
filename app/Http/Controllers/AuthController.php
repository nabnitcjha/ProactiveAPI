<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\LoginResource;
use App\Http\Resources\Admin\UserResource;
use PhpParser\Node\Expr\New_;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    private $userResource;
    private $loginResource;
    public function __construct()
    {
        $this->userResource = new UserResource(array());
        $this->loginResource = new LoginResource(array());
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($access_token = $this->guard()->attempt($credentials)) {
            $user = $this->loginResource->make($this->guard()->user());
            $token_type = 'bearer';
            $expires_in = $this->guard()->factory()->getTTL() * 60;
            $message = 'login successfully';

            return response()->json(compact('access_token', 'token_type', 'expires_in', 'user', 'message'));
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function me()
    {
        return $this->successResponse(
            $this->userResource->make($this->guard()->user()),
            'fetch all record successfully'
        );
    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    public function guard()
    {
        return Auth::guard();
    }
}
