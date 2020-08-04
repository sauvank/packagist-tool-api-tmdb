<?php

namespace ApiTmdb;

use Exception;

class ApiTmdb{

    private string $apiKey;
    private string $lang;
    protected string $baseUrl = "https://api.themoviedb.org/3/";
    protected string $urlImage = 'http://image.tmdb.org/t/p/';

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
        $this->apiKey = $apiKey;
        $this->lang = $lang;
        $this->isApiKeyAvailable();
    }

    public function movie(): Movie{
        return new Movie($this->apiKey, $this->lang);
    }

    public function tvShow(): TvShow{
        return new TvShow($this->apiKey, $this->lang);
    }

    /**
     * Return if the API key is available.
     * @throws Exception
     */
    public function isApiKeyAvailable(): void {
        $url = $this->baseUrl . 'movie/550?' . $this->endUrl();
        $result = $this->callApi($url);

        if(isset($result['success']) && !$result['success']){
            throw new Exception($result['status_message']);
        }
    }
    /**
     * Set new lang for callback data api TMDB
     * @param string $lang
     */
    public function setLang(string $lang){
        $this->lang = $lang;
    }

    /**
     * Return the actual lang use for callback data API TMDB
     * @return string
     */
    public function getLang(){
        return $this->lang;
    }

    /**
     * Return the actual key API TMDB use.
     * @return string
     */
    public function getApiKey(){
        return $this->apiKey;
    }

    /**
     * Set new api key API TMDB
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey){
        $this->apiKey = $apiKey;
    }

    /**
     * Generate the end url for call API TMDB
     */
    protected function endUrl(){
        return "api_key=". $this->apiKey.'&language='.$this->lang;
    }


    /**
     * Call Api tmdb from url, return array.
     * @param string $url
     * @return mixed
     */
    protected function callApi(string $url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        $result=curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }
}
