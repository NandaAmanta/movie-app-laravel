<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScheduleRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Services\MovieScheduleService;
use App\Services\MovieService;
use App\Services\TagService;
use App\Traits\ApiResponser;

class BackOfficeController extends Controller
{
    use ApiResponser;

    private TagService $tagService;
    private MovieScheduleService $movieScheduleService;
    private MovieService $movieService;

    public function __construct(TagService $tagService, MovieScheduleService $movieScheduleService, MovieService $movieService)
    {
        $this->tagService = $tagService;
        $this->movieScheduleService = $movieScheduleService;
        $this->movieService = $movieService;
    }

    public function  createSchedule(CreateScheduleRequest $request)
    {
        $result = $this->movieScheduleService->create($request);
        return $this->successResponse($result, "success create new movie schedule");
    }

    public function updateMovie(UpdateMovieRequest $request, $id)
    {
        $result = $this->movieService->update($id, $request);
        return $this->successResponse($result, "Success update movie");
    }

    public function getTagList()
    {
        $data = $this->tagService->getAll();
        return $this->successResponseListData($data, "Success get all tags");
    }
}
