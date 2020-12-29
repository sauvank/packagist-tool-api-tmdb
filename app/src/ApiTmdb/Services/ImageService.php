<?php
namespace ApiTmdb\Services;

use Exception;

class ImageService
{
    private array $configImage;
    private ?string $url = null;

    /**
     * Image constructor.
     * @param array $configImages
     */
    public function __construct(array $configImages)
    {
        $this->configImage = $configImages;
    }

    public function getUrl(string $path, string $type, string $w = 'original'):?string{
        $this->checkParamSize($type, $w);
        return $this->configImage['secure_base_url']  . $w . $path;;
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
