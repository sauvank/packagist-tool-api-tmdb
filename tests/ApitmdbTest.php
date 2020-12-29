<?php

use PHPUnit\Framework\TestCase;

class ApitmdbTest extends TestCase
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

    public function testUpdateLang(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $api->setLang('FR-fr');
        $this->assertEquals($api->getLang(), 'FR-fr');
    }
}
