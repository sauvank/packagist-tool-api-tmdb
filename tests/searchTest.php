<?php

use ApiTmdb\ApiObject\Search;
use ApiTmdb\ApiTmdb;
use PHPUnit\Framework\TestCase;
use ApiTmdb\ApiObject\TvShow\TvShow;
class searchTest extends TestCase
{
    public function getApiKey(){
        return trim(file_get_contents('tests/apiKeyTmdb.txt'));
    }

    public function testSearchTvSuccess(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $callback = $api->search('tv', 'Futurama');

        $this->assertInstanceOf(Search::class, $callback);
        $this->assertInstanceOf(TvShow::class, $callback->getResult(0));
    }

    public function testSearchTvErrorResultIndex(){
        $this->expectExceptionCode(321);
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $callback = $api->search('tv', 'Futurama');

        $callback->getResult(3333);
    }

    public function testSearchTvGetPage2(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $callback = $api->search('tv', 'Futurama', 2);

        $this->assertEquals(2, $callback->getPage());
    }

}
