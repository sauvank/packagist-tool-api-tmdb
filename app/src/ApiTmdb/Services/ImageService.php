<?php
namespace ApiTmdb\Services;
use ApiTmdb\Cache;
use Exception;

class ImageService
{
    private array $configImage;
    private ?string $url = null;
    /**
     * Image constructor.
     * @param string $path
     * @param string $type, backdrop, still
     * @param string $w, w300, w780, w1280, original
     * @throws Exception
     */
    public function __construct(string $path, string $type, string $w = 'original')
    {
//        parent::__construct();
        $cache = new CacheService();
        $config = $cache->get('sauvank_api_tmdb_configuration');

        if(!$config || !isset($config['images'])){
//            throw new Exception('Cache configuration is empty', 101);
        }
        $this->configImage = $config['images'];

        $this->checkParamSize($type, $w);

        $this->url = $this->configImage['secure_base_url']  . $w . $path;
    }

    public function getUrl():?string{
        return $this->url;
    }

    /**
     * @param string $type
     * @param string $w, w300, w780, w1280, original
     * @throws Exception
     */
    private function checkParamSize(string $type, string $w):void{

        if(!isset($this->configImage[$type.'_sizes'])){
            throw new Exception('unknown config image '. $type.'_sizes', 110);
        }

        $sizes = $this->configImage[$type.'_sizes'];

        if(!in_array("$w", $sizes)){
            throw new Exception("size image $w not allowed, sizes valid : " . implode(',', $sizes), 111);
        }
    }
}
