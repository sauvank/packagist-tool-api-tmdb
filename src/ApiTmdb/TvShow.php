<?php
namespace ApiTmdb;

class TvShow extends CommonMovieTvShow {
    public function __construct(string $apiKey, string $lang = "EN-en")
    {
        parent::__construct($apiKey, $lang, 'tv');
    }

    /**
     * Get movie by Id.
     * @param int $id
     * @return array|mixed
     */
    public function getById(int $id): TvShow{
        $this->isSearchById = true;
        $this->result = $this->dataApiFromId($id);
        $this->result['seasons_class'] = new TvShowSeason($this->result['seasons']);
        return $this;
    }

    /**
     * Get movie by name.
     * @param string $name
     * @return array|mixed
     */
    public function getByName(string $name): TvShow{
        $this->isSearchById = false;
        $url = $this->urlSearch . '?' . $this->endUrl() . '&query='. urlencode(trim($name));
        $this->callApi($url);
        $this->result = $this->callApi($url);

        foreach ($this->result['results'] as $key => $val){
            $this->result['results'][$key]['genres_name'] = $this->idsGenresToName($val['genre_ids']);
        }
        return $this;
    }

    public function  getEpisodeRunTime(): int {
        return $this->result['episode_run_time'];
    }

    public function  getFirstAirDate(): string {
        return $this->result['first_air_date'];
    }

    public function  getLastAirDate(): string {
        return $this->result['last_air_date'];
    }

    public function  getLastEpisodeToAir(): array {
        return $this->result['last_episode_to_air'];
    }

    public function  getNetworks(): array {
        return $this->result['networks'];
    }

    public function getNumberOfEpisodes(): int{
        return $this->result['number_of_episodes'];
    }

    public function getNumberOfSeason(): int{
        return $this->result['number_of_seasons'];
    }

    public function getOriginCountry(): array {
        return $this->result['origin_country'];
    }

    public function  getNextEpisodeToAir(): ?array {
        return $this->result['next_episode_to_air'];
    }

    public function  getIsInProduction(): bool {
        return $this->result['in_production'];
    }

    /**
     * Get All seasons data from tv show. Only available if is find by Id
     * @return array
     */
    public function getSeasons() :array {
        return $this->result['seasons_class']->getData();
    }

    /**
     * Get season data from tv show. Only available if is find by Id
     * @return array
     */
    public function getSeason($seasonNumber) :TvShowSeason {
        return $this->result['seasons_class']->getSeason($seasonNumber);
    }

    public function getType() :array {
        return $this->result['type'];
    }

}
