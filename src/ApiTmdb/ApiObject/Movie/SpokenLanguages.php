<?php


namespace ApiTmdb\ApiObject\Movie;


class SpokenLanguages
{
    private string $englishName;
    private string $iso6391;
    private string $name;

    public function __construct(array $sl)
    {
        $this->englishName = $sl['english_name'];
        $this->name = $sl['name'];
    }

    /**
     * @return mixed|string
     */
    public function getEnglishName(): string
    {
        return $this->englishName;
    }

    /**
     * @return mixed|string
     */
    public function getName(): string
    {
        return $this->name;
    }

}