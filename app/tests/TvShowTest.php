<?php

use ApiTmdb\ApiTmdb;
use PHPUnit\Framework\TestCase;
use ApiTmdb\ApiObject\TvShow\TvShow;
class TvShowTest extends TestCase
{
    public function getApiKey(){
        return trim(file_get_contents('tests/apiKeyTmdb.txt'));
    }

    public function testTvShow(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getTvShowById(550);
        $this->assertInstanceOf(TvShow::class, $result);
    }

    public function testBackdropPathUrlOriginal(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getTvShowById(48866);
        $imageUrl = $api->imageSrv()->getUrl($result->getBackdropPath(), 'backdrop');
        $this->assertEquals($imageUrl,  "https://image.tmdb.org/t/p/original/hTExot1sfn7dHZjGrk0Aiwpntxt.jpg");
    }

    public function testBackdropPathUrlParamsSuccess(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getTvShowById(48866);
        $imageUrl = $api->imageSrv()->getUrl($result->getBackdropPath(), 'backdrop', 'w300');
        $this->assertEquals($imageUrl,  "https://image.tmdb.org/t/p/w300/hTExot1sfn7dHZjGrk0Aiwpntxt.jpg");

    }

    public function testBackdropPathUrlParamsError(){
        $this->expectExceptionCode(111);
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getTvShowById(48866);
        $imageUrl = $api->imageSrv()->getUrl($result->getBackdropPath(), 'backdrop', 'BADWIDTH');
    }

    /***
     * TVSHOW GENRES
     */
    public function testGenresTvShowNoIdExist(){
        $this->expectExceptionCode(132);
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $api->getGenresTvShow()->getById(0);
    }

    public function testGenresTvShowFound(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getGenresTvShow();
        $result->getById(16);
        $this->assertInstanceOf(\ApiTmdb\ApiObject\Genre::class, $result->getById(16));
    }

    public function testGenresTvShowNotNameExist(){
        $this->expectExceptionCode(132);
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getGenresTvShow();
        $result->getByName('FAKE_NAME');
    }

    public function testGenresTvShowExist(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getGenresTvShow();
        $this->assertInstanceOf(\ApiTmdb\ApiObject\Genre::class, $result->getByName('Animation'));
    }

    /*****************************************
     * SEASON
     *****************************************/

    public function testGetSeasonsSuccess(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $tvShow = $api->getTvShowById(48866);
        $seasons = $tvShow->getSeason(1);
        $this->assertEquals($seasons->getSeasonNumber(), 1);
    }

    public function testGetSeasonsError(){
        $this->expectExceptionCode(134);
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $tvShow = $api->getTvShowById(48866);
        $seasons = $tvShow->getSeason(0);
    }

    /*****
     * SEASON EPISODES
     */

    public function testGetSeasonEpisodes(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $seasonDetails = $api->getSeasonDetails(48866, 1);
        $this->assertInstanceOf(\ApiTmdb\ApiObject\TvShow\Episode::class, $seasonDetails->getEpisodes()[0]);
    }

    public function testGetEpisodeDetails(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $seasonDetails = $api->getSeasonDetails(48866, 1);
        $episode = $seasonDetails->getEpisode(1);
        $this->assertInstanceOf(\ApiTmdb\ApiObject\TvShow\Episode::class, $episode);
    }
}
