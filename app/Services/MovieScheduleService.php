<?php

namespace App\Services;

use App\Models\MovieSchedule;
use App\Models\Studio;
use App\Repositories\MovieRepository;
use App\Repositories\MovieScheduleRepository;
use App\Repositories\StudioRepository;

class MovieScheduleService
{

    private StudioRepository $studioRepo;
    private MovieRepository $movieRepo;
    private MovieScheduleRepository $movieScheduleRepo;

    public function __construct(StudioRepository $studioRepo, MovieRepository $movieRepo, MovieScheduleRepository $movieScheduleRepo)
    {
        $this->studioRepo = $studioRepo;
        $this->movieRepo = $movieRepo;
        $this->movieScheduleRepo = $movieScheduleRepo;
    }


    public function create(){
        
    }

    public function getAll(){
        return $this->movieScheduleRepo->findAll();
    }
}
