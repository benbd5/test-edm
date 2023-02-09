<?php

namespace App\Service;

class XmlMovieParser
{
    public function importFile(string $filePath): array
    {
        $movies = [];
        $xml = simplexml_load_file($filePath);
        foreach ($xml->movie as $movie) {
            $data = [
                'id' => (string)$movie->id,
                'title' => (string)$movie->title,
                'genre' => (string)$movie->genre,
                'description' => (string)$movie->description,
                'director' => (string)$movie->director,
                'year' => (int)$movie->year,
                'rate' => (float)$movie->rate,
                'runtime' => (int)$movie->runtime,
            ];
            $movies[] = $data;
        }

        return $movies;
    }
}