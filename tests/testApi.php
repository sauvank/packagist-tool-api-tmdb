<?php
use ApiTmdb\Movie;
use ApiTmdb\TvShow;

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

$api = new TvShow("");
$resultA = $api->getById(9000);
$a = $resultA->getUrlPageTMDB();
$b = $resultA->getFirstAirDate();
var_dump($a);
var_dump($b);
