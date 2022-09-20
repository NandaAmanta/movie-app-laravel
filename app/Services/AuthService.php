<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class AuthService
{
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login()
    {
    }
    public function signup(array $data): User
    {   
        $data["password"] = bcrypt($data["password"] );
        $user = $this->userRepo->save($data);
        return $user;
    }
}
