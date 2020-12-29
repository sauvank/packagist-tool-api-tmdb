<?php


namespace ApiTmdb\Services;


class Service
{
    protected RouterService $routerService;
    protected ImageService $imageService;
    public function __construct(string $apiKey, string $lang = 'EN-en')
    {
        $this->routerService = new RouterService($apiKey, $lang);

        $configImages = $this->routerService->getConfiguration();
        $this->imageService = new ImageService($configImages);
    }

    /**
     * @return RouterService
     */
    public function getRouterService(): RouterService
    {
        return $this->routerService;
    }

    /**
     * @return ImageService
     */
    public function getImageService(): ImageService
    {
        return $this->imageService;
    }
}