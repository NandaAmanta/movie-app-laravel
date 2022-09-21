<?php

namespace App\Repositories;

use App\Models\Studio;

class StudioRepository
{

    private Studio $studio;

    public function __construct(Studio $studio)
    {
        $this->studio = $studio;
    }

    public function findById(int $id) : Studio
    {
        $result = $this->studio::where("id",$id)->first();
        return $result;
    }

    public function save(array $data):Studio
    {
        $result = $this->studio::create($data);
        return $result;
    }
}
