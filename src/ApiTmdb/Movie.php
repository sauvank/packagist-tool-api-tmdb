<?php

namespace ApiTmdb;
use Exception;

class Movie extends CommonMovieTvShow {

    public function __construct(string $apiKey, string $lang = "EN-en")
    {
        parent::__construct($apiKey, $lang, 'movie');
    }

    /**
     * Get movie by Id.
     * @param int $id
     * @return array|mixed
     */
    public function getById(int $id): Movie{
        $this->isSearchById = true;
        $this->result = $this->dataApiFromId($id);
        return $this;
    }

    /**
     * Get movie by name.
     * @param string $name
     * @return array|mixed
     */
    public function getByName(string $name): Movie{
        $this->isSearchById = false;
        $url = $this->urlSearch . '?' . $this->endUrl() . '&query='. urlencode(trim($name));
        $this->callApi($url);
        $this->result = $this->callApi($url);

        foreach ($this->result['results'] as $key => $val){
            $this->result['results'][$key]['genres_name'] = $this->idsGenresToName($val['genre_ids']);
        }
        return $this;
    }

    public function getProductionCountries(): array {
        return $this->result['production_countries'];
    }

    public function getReleaseDate(): string {
        return $this->result['release_date'] ?? '0000-00-00';
    }

}
