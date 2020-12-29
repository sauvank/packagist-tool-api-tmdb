<?php
namespace ApiTmdb\Services;
use Exception;

class RouterService{

    private \Memcached $cacheService;
    private static string $baseUrl = "https://api.themoviedb.org/3";
    private static string $apiKey;
    private static string $lang;
    public function __construct(string $apiKey, string $lang = 'EN-en')
    {
        $cache = new CacheService();
        $this->cacheService  =$cache->getCache();
        self::$apiKey = $apiKey;
        self::$lang = $lang;
    }

    public function getConfiguration() {
        $url = $this->generateUrl(['configuration']);
        return $this->callApi($url);
    }


    /**
     * Generate the end url for call API TMDB
     * @param string $appendTo, data to append in the end url
     * @return string
     */
    protected function endUrl(string $appendTo = ''):string {
        return "api_key=". self::$apiKey.'&language='.self::$lang .'&'. $appendTo;
    }

    /**
     * Concact array value with '/'
     * @param array $params
     * @param string $appendToEnd
     * @return string
     */
    protected function generateUrl(array $params, array $appendToEnd = []):string {
        $str =  implode('/', $params) . '?';

        $strAppendToEnd = implode('&', array_map(
            function ($v, $k) {
                $v = is_bool($v) ? json_encode($v) : urlencode($v);
                return sprintf("%s=%s", $k, $v);

            },
            $appendToEnd,
            array_keys($appendToEnd)
        ));

        return self::$baseUrl .'/' . $str . $this->endUrl($strAppendToEnd);
    }

    /**
     * Call Api tmdb from url, return array.
     * @param string $url
     * @param bool $useCache
     * @return mixed
     * @throws Exception
     */
    protected function callApi(string $url, bool $useCache = true):array {
        $cache = $this->cacheService->get($url);
        if($cache && $useCache){
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

        if(isset($rep['errors'])){
            foreach ($rep['errors'] as $error){
                throw new Exception('Error API URL : ' . $error);
            }
        }

        $this->cacheService->set($url,$rep);
        return $rep;
    }
}