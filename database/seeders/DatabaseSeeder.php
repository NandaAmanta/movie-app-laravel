<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Services\MovieService;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    private MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("password"),
            "is_admin" => true,
        ]);

        $this->movieService->fetch();

    }
}
