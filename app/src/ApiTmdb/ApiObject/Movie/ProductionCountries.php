<?php


namespace ApiTmdb\ApiObject\Movie;


class ProductionCountries
{
    private string $name;


    public function __construct(array $pc)
    {
        $this->name = $pc['name'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}