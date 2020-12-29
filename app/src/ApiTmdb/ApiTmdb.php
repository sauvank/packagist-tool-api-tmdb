<?php

namespace ApiTmdb;
use ApiTmdb\ApiObject\Movie\Movie;
use ApiTmdb\Services\ImageService;
use ApiTmdb\Services\RouterService;

class ApiTmdb extends RouterService
{
    private ImageService $imageService;

    public function __construct(string $apiKey, $lang = 'EN-en')
    {
        parent::__construct($apiKey, $lang);
        $this->imageService = new ImageService($this->getConfiguration());

    }

    public function imageSrv():ImageService{
        return $this->imageService;
    }
//    public function pathImageToUrl(string $path, string $typeImage, string $w = 'original'){
//        $image = new ImageService();
//        return $image->getUrl($path, $typeImage, $w);
//    }
}