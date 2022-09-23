<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository
{

    private Tag $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function save(array $data){
        $result = $this->tag::create($data);
        return $result;
    }

    public function findAllAndPaginate(int $perPage = 15)
    {
        $result = $this->tag::paginate($perPage);
        return $result;
    }
}
