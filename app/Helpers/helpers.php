<?php

function mapResponseTmdbToMovie(array $data): array
{
    $result = array();
    for ($i = 0; $i < count($data); $i++) {
        $indexData = [
            "id" => $data[$i]["id"],
            "title" => $data[$i]["title"],
            "overview" => $data[$i]["overview"],
            "poster" => $data[$i]["poster_path"],
        ];
        array_push($result, $indexData);
    }

    return $result;
}
