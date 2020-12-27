## packagist-tool-api-tmdb


#### Required  :

* PHP >= 7.4
* PHP ext-curl
* PHP ext-json
* PHP ext-memcached
* API The movie database


#### Run php unit tests (in cli)

create a file : `tests/apiKeyTmdb.txt` and put inside the API key and run in CLI :

> vendor/bin/phpunit tests

or 

> ./run_test.sh

#### Example integration

````PHP
        $api = new \ApiTmdb\ApiTmdb('YOUR_API_KEY');
        $api->getMovieById(550);
````

### DOC

> For get the doc, open 'doc/index.html'

#### For update the doc, run ./doc.sh