<?php

namespace ApiTmdb;
use Exception;

class ApiTmdb extends Route
{
    /**
     * ApiTmdb constructor.
     * Set default data for request to the Api TMDB
     * For get api key : https://developers.themoviedb.org/3/getting-started/authentication
     * For get available language : https://developers.themoviedb.org/3/getting-started/languages
     * @param string $apiKey The api key for request to api tmdb
     * @param string $lang The language for data Api.
     * @throws Exception
     */
    public function __construct(string $apiKey, string $lang ='EN-en')
    {
        parent::__construct();

        $this->setApiKey($apiKey);
        $this->setLang($lang);
        //Set configuration images in cache
        $this->getConfiguration();
        $this->getGenresMovie();
        $this->getGenresTvShow();
    }
}
