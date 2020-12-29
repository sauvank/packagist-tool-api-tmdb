<?php
use ApiTmdb\ApiObject\Genre;
use ApiTmdb\ApiTmdb;
use PHPUnit\Framework\TestCase;
use ApiTmdb\ApiObject\TvShow\TvShow;
class ImageServiceTest extends TestCase{
    public function getApiKey(){
        return trim(file_get_contents('tests/apiKeyTmdb.txt'));
    }

    public function testTransformPathToUrlSuccess(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->imageSrv()->getUrl('/customPathImage', 'backdrop');
        $this->assertEquals('https://image.tmdb.org/t/p/original/customPathImage',$result );
    }
}