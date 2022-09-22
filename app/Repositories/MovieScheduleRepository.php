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

    public function save(array $data)
    {
        $result = $this->movieSchedule::create($data);
        return $result;
    }

    public function findAll(int $perPage = 15)
    {
        $movieSchedules = $this->movieSchedule::paginate($perPage);
        return $movieSchedules;
    }
}
