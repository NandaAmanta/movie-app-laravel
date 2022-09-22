<?php

namespace App\Repositories;

use App\Models\MovieSchedule;

class MovieScheduleRepository
{
    private MovieSchedule $movieSchedule;

    public function __construct(MovieSchedule $movieSchedule)
    {
        $this->movieSchedule = $movieSchedule;
    }

    public function save()
    {
    }

    public function findAll(int $perPage = 15)
    {
        $movieSchedule = $this->movieSchedule::paginate($perPage);
        return $movieSchedule;
    }
}
