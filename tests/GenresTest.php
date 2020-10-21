<?php

use ApiTmdb\ApiObject\Genre;
use ApiTmdb\ApiTmdb;
use PHPUnit\Framework\TestCase;
use ApiTmdb\ApiObject\TvShow\TvShow;
class GenresTest extends TestCase
{
    public function getApiKey(){
        return trim(file_get_contents('tests/apiKeyTmdb.txt'));
    }

    public function testsSetGenres(){
         $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
         $genres = $api->getGenresTvShow(false);
         $this->assertInstanceOf(Genre::class, $genres->getAll()[0]);
    }

    public function testGetGenresFromIdTv(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getTvShowById(1399);

        $firstResult = $result->getGenres()->get(0)->getName();
        $this->assertEquals($firstResult, 'Sci-Fi & Fantasy');
    }
}
