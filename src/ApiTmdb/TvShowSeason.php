<?php
namespace ApiTmdb;
class TvShowSeason{
    private array $seasons;
    private array $season;
    public function __construct(array $seasons)
    {
        return $this->seasons = $seasons;
    }

    public function getData(){
        return $this->seasons;
    }

    public function getSeason(int $seasonNumber): TvShowSeason {
        return new TvShowSeason($this->seasons[$seasonNumber - 1]);
    }

    public function getName(): string {
        return $this->seasons['name'];
    }

    public function getAirDate(): string {
        return $this->seasons['air_date'];
    }

    public function getEpisodeCount(): string {
        return $this->seasons['episode_count'];
    }

    public function getId(): string {
        return $this->seasons['id'];
    }

    public function getOverview(): string {
        return $this->seasons['overview'];
    }

    public function getPosterPath(): string {
        return $this->seasons['poster_path'];
    }

    public function getSeasonNumber(): string {
        return $this->seasons['season_number'];
    }
}
