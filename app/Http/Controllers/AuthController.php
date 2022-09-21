<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
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
        $user = $this->authService->signup($request);
        
        return $this->successResponse($user,"Success signup new user.");
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request);
        return $this->successResponse($result,"Success login.");
    }
}
