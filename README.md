# packagist_tmdb

### Require :

- PHP >= 7.4
- One Key API TMDB

### DOC 

#### Get movie 

* Basic usage :
````PHP
<?php 

use ApiTmdb\Movie;
$apiKey = "YOUR_API_KEY";

$tmdb = new Movie($apiKey);
````

* Search by name
````PHP
// Search by name, 
$resultApi = $tmdb->getByName('batman');

// return array contain all result.
$resultApi->getResult();

// Get result by index array
$resultApi->getResultsByIndex(0);

//Exemple for get origin title.
$resultApi->getResultsByIndex(0)->getOriginalTitle();
````

* Search by id
````PHP
// Search by name, 
$resultApi = $tmdb->getById(500);

// return array contain data movie.
$resultApi->getResult();

//Exemple for get origin title.
$resultApi->getOriginalTitle();
````

* available function for movie result : 

````PHP
// Return bool
->getIsAdult();

// Return the path of the background image.
// @param bool $fullUrl, for get the full url of the backdrop image.
// @param string $size, get backdrop with size ('original', 'w300', 'w780' , 'w1280')
// @return string
->getBackdropPath(bool $fullUrl = true, string $size = "original");

// Return string
->getTitle();

// Return string
->getCollection();

//Return array
->getProductionCompanies();

// return int
->getBudget();

// return array
->getGenres();

// Return string
->getHomepage();

// return int
->getId();

// return string
->getImdbId();

// return string
->getOriginalLanguage();

// return string
->getOriginalTitle();

// return string
->getOverview();

// return float
->getPopularity();

// Return the path of the poster image.
// @param bool $fullUrl, for get the full url of the poster image.
// @param string $size, get backdrop with size ('original', 'w300', 'w780' , 'w1280')
// @return string
->getPosterPath();

//return int
->getRevenue();

//return int
->getRuntime();

// Return string
->getStatus();

// Return string
->getTagLine();

// Return string
->getVideo();

// Return float
->getVoteAverage();

// Return int
->getVoteCount();

// Return int
->getTotalResult();

// Get the result of the call api
// Return array
->getResult();

// If you get the movie by name, multiple result is return by api
// $index equal to the index array return by function getResult(); to show.
// Return array
->getResultsByIndex($index);

// Return all genres for movie
// return array
->getGenresMovie();

// Return name of genres from array ids genre  
->idsGenresToName(array $ids);

// return string
->getProductionCountries();

// return string
->getReleaseDate();
````

#### Get tv show 

* Basic usage :
````PHP
<?php 

use ApiTmdb\TvShow;
$apiKey = "YOUR_API_KEY";

$tmdb = new TvShow($apiKey);
````

* Search by name
````PHP
// Search by name, 
$resultApi = $tmdb->getByName('batman');

// return array contain all result.
$resultApi->getResult();

// Get result by index array
$resultApi->getResultsByIndex(0);

//Exemple for get origin title.
$resultApi->getResultsByIndex(0)->getOriginalTitle();
````

* Search by id
````PHP
// Search by name, 
$resultApi = $tmdb->getById(500);

// return array contain data movie.
$resultApi->getResult();

//Exemple for get origin title.
$resultApi->getOriginalTitle();
````

* available function for movie result : 

````PHP
// Return bool
->getIsAdult();

// Return the path of the background image.
// @param bool $fullUrl, for get the full url of the backdrop image.
// @param string $size, get backdrop with size ('original', 'w300', 'w780' , 'w1280')
// @return string
->getBackdropPath(bool $fullUrl = true, string $size = "original");

// Return string
->getTitle();

// Return string
->getCollection();

//Return array
->getProductionCompanies();

// return int
->getBudget();

// return array
->getGenres();

// Return string
->getHomepage();

// return int
->getId();

// return string
->getImdbId();

// return string
->getOriginalLanguage();

// return string
->getOriginalTitle();

// return string
->getOverview();

// return float
->getPopularity();

// Return the path of the poster image.
// @param bool $fullUrl, for get the full url of the poster image.
// @param string $size, get backdrop with size ('original', 'w300', 'w780' , 'w1280')
// @return string
->getPosterPath();

//return int
->getRevenue();

//return int
->getRuntime();

// Return string
->getStatus();

// Return string
->getTagLine();

// Return string
->getVideo();

// Return float
->getVoteAverage();

// Return int
->getVoteCount();

// Return int
->getTotalResult();

// Get the result of the call api
// Return array
->getResult();

// If you get the movie by name, multiple result is return by api
// $index equal to the index array return by function getResult(); to show.
// Return array
->getResultsByIndex($index);

// Return all genres for movie
// return array
->getGenresMovie();

// Return name of genres from array ids genre  
->idsGenresToName(array $ids);

// return int
->getEpisodeRunTime();

// return string
->getFirstAirDate();

// return string
->getLastAirDate();

// return string
->getLastEpisodeToAir();

// return array
->getNetworks();

// return int
->getNumberOfEpisodes();

// return int
->getNumberOfSeason();

// return string
->getOriginCountry();

// return string
->getNextEpisodeToAir();

// return bool
->getIsInProduction();
````
