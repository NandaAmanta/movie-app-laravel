<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Services\AuthService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponser;

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function signup(SignupRequest $request)
    {
        $request->validated();
        $user = $this->authService->signup($request->all());
        return $this->successResponse($user,"Success signup new user.");
    }

    public function login(Request $request)
    {
        
    }
}
