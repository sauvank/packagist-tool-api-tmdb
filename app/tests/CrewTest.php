<?php

use ApiTmdb\ApiTmdb;
use PHPUnit\Framework\TestCase;
use ApiTmdb\ApiObject\TvShow\TvShow;
class CrewTest extends TestCase
{
    public function getApiKey(){
        return trim(file_get_contents('tests/apiKeyTmdb.txt'));
    }

    public function testPropfilePathExist(){
        $api = new \ApiTmdb\ApiObject\Crew([
            'id' => 16,
            'credit_id' => 10,
            'name' => 'fake',
            'department' => 'fake dep',
            'job' => 'fake job',
            'gender' => 1,
            'profile_path' => 'fakepath'
        ]);

        $this->assertEquals('https://image.tmdb.org/t/p/originalfakepath', $api->getProfilePath());
    }
}
