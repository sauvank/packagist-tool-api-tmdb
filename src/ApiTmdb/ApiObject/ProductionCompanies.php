<?php


namespace ApiTmdb\ApiObject;


use ApiTmdb\Image;

class ProductionCompanies
{
    private int $id;
    private ?string $logoPath;
    private string $name;
    private string $originCountry;

    public function __construct($productionCompanies)
    {
        $this->id            = $productionCompanies['id'];
        $this->logoPath      = $productionCompanies['logo_path'];
        $this->name          = $productionCompanies['name'];
        $this->originCountry = $productionCompanies['origin_country'];
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
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getOriginCountry():string
    {
        return $this->originCountry;
    }
}
