<?php

use PHPUnit\Framework\TestCase;

class ToolApiTmdbTest extends TestCase
{

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    public function getApiKey(){
        return trim(file_get_contents('tests/apiKeyTmdb.txt'));
    }

    public function testApiKeySimpleCallSuccess(){
        $api = new \ApiTmdb\ToolApiTmdb($this->getApiKey());
    }
}
