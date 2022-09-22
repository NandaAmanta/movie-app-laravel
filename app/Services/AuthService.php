<?php

namespace App\Services;

use App\Exceptions\EmailExistException;
use App\Exceptions\WrongCredentialException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

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

        if ($user == null || !Auth::attempt($data)) {
            throw new WrongCredentialException();
        }

        $token = $user->createToken("token");

        $result = [
            new UserResource($user),
            "token" => $token->plainTextToken
        ];

        return $result;
    }

    public function signup(SignupRequest $signUpRequest): UserResource
    {

        $data = $signUpRequest->all();
        $checkEmail = $this->userRepo->findByEmail($data["email"]);

        if ($checkEmail != null) {
            throw new EmailExistException();
        }

        $data["password"] = bcrypt($data["password"]);
        $user = $this->userRepo->save($data);

        return new UserResource($user);
    }
}
