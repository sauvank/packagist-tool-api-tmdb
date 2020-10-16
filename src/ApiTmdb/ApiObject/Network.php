<?php

namespace ApiTmdb\ApiObject;

use ApiTmdb\Image;

class Network
{
    private string $name;
    private int $id;
    private ?string $logoPath;
    private string $originCountry;

    public function __construct(array $network)
    {
        $this->id               = $network['id'];
        $this->name             = $network['name'];
        $this->logoPath         = $network['logo_path'];
        $this->originCountry    = $network['origin_country'];
    }

    /**
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @param string $w, w300, w780, w1280, original
     * @return string|null
     * @throws \Exception
     */
    public function getLogoPath($w = 'original'):?string
    {
        $img = New Image($this->logoPath, 'logo', $w);
        return $img->getUrl();
    }

    /**
     * @return string
     */
    public function getOriginCountry():string
    {
        return $this->originCountry;
    }
}
