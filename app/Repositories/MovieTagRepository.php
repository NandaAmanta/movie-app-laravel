<?php

namespace App\Repositories;

use App\Models\MovieTag;
use App\Models\Tag;

class MovieTagRepository
{

    private MovieTag $movieTag;

    public function __construct(MovieTag $movieTag)
    {
        $this->movieTag = $movieTag;
    }

    public function save(array $data)
    {
        $result = $this->movieTag::create($data);
        return $result;
    }
}
