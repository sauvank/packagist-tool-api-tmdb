<?php

use PHPUnit\Framework\TestCase;

class ApiTmdbTest extends TestCase
{

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    public function getApiKey(){
        return trim(file_get_contents('tests/apiKeyTmdb.txt'));
    }

    public function testApiKeyIsValidError(){
        $this->expectExceptionCode(7);
        $api = new \ApiTmdb\ApiTmdb('FAKE_KEY');
        $api->getMovieById(550);
    }

    public function testApiKeyIsValidSuccess(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $this->assertInstanceOf(ApiTmdb\ApiTmdb::class, $api);
    }

    public function testSetLang(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey(), 'RU-ru');
        $this->assertEquals('RU-ru', $api->getLang());
        $api->setLang('FR-fr');
        $this->assertEquals('FR-fr', $api->getLang());
    }

    public function testSetApiKeyError(){
        $this->expectExceptionCode(7);
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $this->assertEquals($this->getApiKey(), $api->getApiKey());
        $api->setApiKey('FAKE_API_KEY');
        $api->getMovieById(550);
    }
}
