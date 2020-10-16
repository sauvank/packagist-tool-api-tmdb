<?php


namespace ApiTmdb;


use ApiTmdb\ApiObject\Genres;
use ApiTmdb\ApiObject\TvShow\Season;
use ApiTmdb\ApiObject\TvShow\TvShow;

use Exception;

class Route extends Config
{
    private Cache $cache;
    public function __construct()
    {
        parent::__construct();
        $this->cache = new  Cache();
    }

    public function getMovieById(int $id):array {
        $url = $this->generateUrl(['movie', $id]);
        $result = $this->callApi($url);
        return $result;
    }

    public function getTvShowById(int $id):TvShow {
        $url = $this->generateUrl(['tv', $id]);
        $result = $this->callApi($url);
        return new TvShow($result);
    }

    public function getSeasonDetails(int $seasonId, int $seasonNumber):Season{
        $url = $this->generateUrl(['tv',$seasonId,'season',$seasonNumber]);
        $result = $this->callApi($url);
        return new Season($result);
    }

    /**
     * Get data configuration image.
     * @return array|mixed
     * @throws Exception
     */
    public function getConfiguration():array {
        $url = $this->generateUrl(['configuration']);
        $result =  $this->callApi($url);
        $this->cache->set('sauvank_api_tmdb_configuration', $result);
        return $result;
    }

    public function getGenresMovie():Genres{
        $url = $this->generateUrl(['genre/movie/list']);
        $genres =  $this->callApi($url);

        $keyCache = 'sauvank_api_tmdb_genre_movie';
        $cache = $this->cache->get($keyCache);
        if($cache){
            return $cache;
        }

        $this->cache->set($keyCache, new Genres($genres));
        return new Genres($genres);
    }

    public function getGenresTvShow():Genres{
        $url = $this->generateUrl(['genre/tv/list']);
        $genres =  $this->callApi($url);

        $keyCache = 'sauvank_api_tmdb_genre_tvshow';
        $cache = $this->cache->get($keyCache);
        if($cache){
            return $cache;
        }

        $this->cache->set($keyCache, new Genres($genres));
        return new Genres($genres);
    }

    /**
     * Generate the end url for call API TMDB
     */
    protected function endUrl():string {
        return "api_key=". $this->getApiKey().'&language='.$this->getLang();
    }

    /**
     * Concact array value with '/'
     * @param array $params
     * @return string
     */
    protected function generateUrl(array $params):string {
        $str =  implode('/', $params) . '?';
        return $this->getBaseUrl() .'/' . $str . $this->endUrl();
    }

    /**
     * Call Api tmdb from url, return array.
     * @param string $url
     * @return mixed
     * @throws Exception
     */
    protected function callApi(string $url):array {

        $cache = $this->cache->get($url);
        if($cache){
            return $cache;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        $result=curl_exec($ch);
        curl_close($ch);

        if(!$result){
            throw new Exception('The result is NULL', 100);
        }

        $rep = json_decode($result, true);

        if(isset($rep['success']) && !$rep['success']){
            throw new Exception($rep['status_message'], $rep['status_code']);
        }

        $this->cache->set($url,$rep);
        return $rep;
    }
}
