<?php

namespace App\Service;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;

class MovieFactory
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function createMovie(array $xmlParsed): Movie
    {
        $movie = new Movie();
        $movie->setId($xmlParsed['id']);
        $movie->setTitle($xmlParsed['title']);
        $movie->setGenre($xmlParsed['genre']);
        $movie->setDescription($xmlParsed['description']);
        $movie->setDirector($xmlParsed['director']);
        $movie->setYear($xmlParsed['year']);
        $movie->setRuntime($xmlParsed['runtime']);
        $movie->setRate($xmlParsed['rate']);

        $this->entityManager->persist($movie);
        $this->entityManager->flush();

        return $movie;
    }
}