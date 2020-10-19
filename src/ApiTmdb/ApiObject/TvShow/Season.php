<?php

namespace ApiTmdb\ApiObject\TvShow;

use ApiTmdb\Image;
use Exception;

class Season
{
    private ?string $airDate;
    private int $episodeCount;
    private int $id;
    private string $name;
    private string $overview;
    private ?Image $posterPath;
    private int $seasonNumber;
    private array $episodes = [];

    public function __construct($season)
    {
        $this->id = $season['id'];
        $this->episodeCount = isset($season['episode_count']) ?  $season['episode_count'] : count($season['episodes']);
        $this->airDate = $season['air_date'];
        $this->name = $season['name'];
        $this->overview = $season['overview'];
        $this->posterPath = is_null($season['poster_path']) ? null : new Image($season['poster_path'], 'poster');
        $this->seasonNumber = $season['season_number'];

        isset($season['episodes']) ? $this->setEpisodes($season['episodes']) : null;
    }

    /**
     * @return string
     */
    public function getAirDate():?string
    {
        return $this->airDate;
    }

    /**
     * @return string
     */
    public function getEpisodeCount():string
    {
        return $this->episodeCount;
    }

    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
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
    public function getOverview():string
    {
        return $this->overview;
    }

    /**
     * @return Image|null
     */
    public function getPosterPath(): ?Image
    {
        return $this->posterPath;
    }

    /**
     * @return int
     */
    public function getSeasonNumber():int
    {
        return $this->seasonNumber;
    }

    /**
     * @return array
     */
    public function getEpisodes():array {
        return $this->episodes;
    }

    /**
     * @param int $episodeNumber
     * @return Episode|null
     * @throws Exception
     */
    public function getEpisode(int $episodeNumber):?Episode {
        $episode = array_filter($this->episodes, function (Episode $episode) use($episodeNumber){
            return $episode->getEpisodeNumber() === strval($episodeNumber);
        });

        if(is_null($episode)){
            throw new Exception('No data found for this episode number', 133);
        }

        return array_shift($episode);
    }

    protected function setEpisodes(array $episodes){
        foreach ($episodes as $episode){
            $this->episodes[] = new Episode($episode);
        }
    }
}
