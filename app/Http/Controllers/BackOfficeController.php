<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScheduleRequest;
use App\Models\MovieSchedule;
use App\Services\MovieScheduleService;
use App\Services\TagService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BackOfficeController extends Controller
{
    use ApiResponser;

    private TagService $tagService;
    private MovieScheduleService $movieScheduleService;

    public function __construct(TagService $tagService, MovieScheduleService $movieScheduleService)
    {
        $this->tagService = $tagService;
        $this->movieScheduleService = $movieScheduleService;
    }

    public function  createSchedule(CreateScheduleRequest $request)
    {
        $result = $this->movieScheduleService->create($request);
        return $this->successResponse($result, "success create new movie schedule");
    }

    public function updateMovie()
    {
    }

    public function getTagList()
    {
        $data = $this->tagService->getAll();
        return $this->successResponseListData($data, "Success get all tags");
    }
}
