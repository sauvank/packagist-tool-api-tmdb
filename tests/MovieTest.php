<?php

use ApiTmdb\Model\Movie\Movie;
use PHPUnit\Framework\TestCase;
class MovieTest extends TestCase
{
    public function getApiKey(){
        return trim(file_get_contents('tests/apiKeyTmdb.txt'));
    }

    public function testGetById(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getMovieById(11);
        $this->assertInstanceOf(Movie::class, $result);
    }

    public function testAdultIsBool(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getMovieById(11);
        $this->assertIsBool($result->isAdult());
    }

    public function testBudgetIsInt(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getMovieById(11);
        $this->assertIsInt($result->getBudget());
    }

    public function testOriginTitleIsString(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getMovieById(11);
        $this->assertIsString($result->getOriginalTitle());
    }

    public function testReleaseDateIsString(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getMovieById(11);
        $this->assertIsString($result->getReleaseDate());
    }

    public function testRevenueIsInt(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getMovieById(11);
        $this->assertIsInt($result->getRevenue());
    }

    public function testRuntimeIsInt(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getMovieById(11);
        $this->assertIsInt($result->getRuntime());
    }

    public function testTaglineIsString(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getMovieById(11);
        $this->assertIsString($result->getTagline());
    }

    public function testTitleIsString(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getMovieById(11);
        $this->assertIsString($result->getTitle());
    }

    public function testVideoIsBool(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getMovieById(11);
        $this->assertIsBool($result->isVideo());
    }

    public function testBelongsToCollectionExist(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getMovieById(11);
        $this->assertInstanceOf(\ApiTmdb\Model\Movie\BelongToCollection::class, $result->getBelongsToCollection());
    }

    public function testBelongsToCollectionIsNull(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getMovieById(550);
        $this->assertNull( $result->getBelongsToCollection());
    }
}