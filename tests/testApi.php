<?php
use ApiTmdb\Movie;
use ApiTmdb\TvShow;

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

$api = new Movie("");
$resultA = $api->getById(500);
$a = $resultA->getResult();
var_dump($a);

//$apiTv = new TvShow("afc7d23435a1950374d5149fa9d4584f");
//$resultTv = $apiTv->getByName('batman');
//$resultTv = $resultTv->getResultsByIndex(0)->getSeason(1)->getPosterPath();
//var_dump($resultTv);
