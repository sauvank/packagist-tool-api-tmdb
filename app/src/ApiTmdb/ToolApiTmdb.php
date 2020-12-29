<?php

namespace ApiTmdb;
use ApiTmdb\Services\Service;

class ToolApiTmdb
{
    public function __construct(string $apiKey, $lang = 'EN-en')
    {
        $services = new Service($apiKey, $lang = 'EN-en');
    }
}