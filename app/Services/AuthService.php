<?php

namespace App\Services;

use App\Exceptions\WrongCredentialException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use App\Repositories\UserRepository;

class AuthService
{
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login(LoginRequest $loginRequest)
    {
        $data = $loginRequest->all();
        $user = $this->userRepo->findByEmail($data["email"]);

        if ($user == null) {
            throw new WrongCredentialException();
        }

        $token = $user->createToken("token");

        $result = [
            $user,
            "token" => $token->plainTextToken
        ];

        return $result;
    }
    
    public function signup(SignupRequest $signUpRequest): User
    {
        $data = $signUpRequest->all();
        $data["password"] = bcrypt($data["password"]);
        $user = $this->userRepo->save($data);


        return $user;
    }
}
