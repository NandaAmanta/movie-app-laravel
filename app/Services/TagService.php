<?php

namespace App\Services;

use App\Repositories\TagRepository;

class TagService
{

    private TagRepository $tagRepo;

    public function __construct(TagRepository $tagRepo)
    {
        $this->tagRepo = $tagRepo;
    }

    public function getAll()
    {
        return $this->tagRepo->findAllAndPaginate();
    }
}
