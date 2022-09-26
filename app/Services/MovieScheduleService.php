<?php

namespace App\Services;

use App\Http\Requests\CreateScheduleRequest;
use App\Models\MovieSchedule;
use App\Models\Studio;
use App\Repositories\MovieRepository;
use App\Repositories\MovieScheduleRepository;
use App\Repositories\StudioRepository;
use Carbon\Carbon;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

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


    public function create(CreateScheduleRequest $request)
    {
        $dataReq = $request->all();
        $studio = $this->studioRepo->findById($dataReq["studio_id"]);
        if ($studio == null) {
            throw new NotFoundResourceException("studio not found");
        }

        $movie = $this->movieRepo->findById($dataReq["movie_id"]);
        if ($movie == null) {
            throw new NotFoundResourceException("movie not found");
        }

        $dataReq["date"] = Carbon::createFromFormat('Y-m-d H:i', $dataReq["date"]);
        $result = $this->movieScheduleRepo->save($dataReq);
        $result["movie"] = $result->movie;
        $result["studio"] = $result->studio;
        
        return $result;
    }


    public function getAll()
    {
        return $this->movieScheduleRepo->findAll();
    }
}
