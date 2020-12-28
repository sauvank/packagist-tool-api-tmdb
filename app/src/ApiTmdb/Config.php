<?php

namespace ApiTmdb;

use ApiTmdb\Services\CacheService;
use Exception;

class Config
{
    protected CacheService $cache;
    private ?string $apiKey;
    private string  $lang;
    private string $baseUrl;
    public function __construct()
    {
        $this->baseUrl = Url::$baseUrl;
        $this->cache = new  CacheService();
    }

    /**
     * Set new lang for callback data api TMDB
     * @param string $lang
     * @return Config
     */
    public function setLang(string $lang):Config{
        $this->lang = $lang;
        return $this;
    }

    /**
     * Return the actual lang use for callback data API TMDB
     * @return string
     */
    public function getLang():string {
        return $this->lang;
    }

    /**
     * Return the actual key API TMDB use.
     * @return string
     */
    public function getApiKey():string {
        return $this->apiKey;
    }

    /**
     * Set new api key API TMDB
     * @param string $apiKey
     * @return Config
     * @throws Exception
     */
    public function setApiKey(string $apiKey):Config{
        $this->apiKey = trim($apiKey);
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }
}
