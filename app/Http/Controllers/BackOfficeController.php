<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BackOfficeController extends Controller
{
    use ApiResponser;

    private TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function  createSchedule()
    {
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
