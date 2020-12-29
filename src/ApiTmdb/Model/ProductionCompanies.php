<?php
namespace ApiTmdb\Model;

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
     * @return string|null
     */
    public function getLogoPath():?string
    {
        return $this->logoPath;
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
