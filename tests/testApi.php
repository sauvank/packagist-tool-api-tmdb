<?php
use ApiTmdb\Movie;
use ApiTmdb\TvShow;

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

$api = new Movie("afc7d23435a1950374d5149fa9d4584f");
$resultA = $api->getById(70160);
$a = $resultA->getTitle();
$a = $resultA->getCollection()->getName();
$a = $resultA->getGenres()->orderByName()->getAll();
var_dump($a);
