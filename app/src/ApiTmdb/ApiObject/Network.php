<?php

namespace ApiTmdb\ApiObject;

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
     * @return string|null
     */
    public function getLogoPath():?string
    {
        return $this->logoPath;
    }

    /**
     * @return string
     */
    public function getOriginCountry():string
    {
        return $this->originCountry;
    }
}
