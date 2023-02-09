<?php

namespace App\Command;

use App\Service\MovieFactory;
use App\Service\XmlMovieParser;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:movie-xml',
    description: 'Importer un fichier XML avec des films et les intégrer dans la base de données',
)]

class XmlMovieCommand extends Command
{
    private XmlMovieParser $xmlMovieParser;
    private MovieFactory $movieFactory;
    public function __construct(XmlMovieParser $xmlMovieParser, MovieFactory $movieFactory)
    {
        parent::__construct();
        $this->xmlMovieParser = $xmlMovieParser;
        $this->movieFactory = $movieFactory;
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $progressBar = new ProgressBar($output, 100);
        $progressBar->start();

        $filePath = 'movies.xml';
        $movies = $this->xmlMovieParser->importFile($filePath);

        foreach ($movies as $movie) {
            $this->movieFactory->createMovie($movie);
            $progressBar->advance();
        }

        $progressBar->finish();

        return Command::SUCCESS;
    }
}