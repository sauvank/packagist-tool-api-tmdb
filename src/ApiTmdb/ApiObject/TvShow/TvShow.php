<?php

namespace ApiTmdb\ApiObject\TvShow;

use ApiTmdb\ApiObject\CreatedBy;
use ApiTmdb\ApiObject\Genre;
use ApiTmdb\ApiObject\Genres;
use ApiTmdb\ApiObject\Network;
use ApiTmdb\ApiObject\ProductionCompanies;
use ApiTmdb\ApiTmdb;
use ApiTmdb\Cache;
use ApiTmdb\Config;
use ApiTmdb\Image;
use ApiTmdb\Route;
use ApiTmdb\Url;
use Exception;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Getter and setter of all params get from API TMDB for TVSHOW
 * Class TvShow
 * @package ApiTmdb\ApiObject\TvShow
 */
class TvShow
{
    private ?string $backdropPath = null;
    private array $createdBy = [];
    private array $networks = [];
    private array $episodeRunTime = [];
    private ?string $firstAirDate = null;
    private ?string $homepage = null;
    private int $id;
    private bool $inProduction;
    private array $languages = [];
    private Episode $lastEpisodeToAir;
    private string $name;
    private ?Episode $nextEpisodeToAir;
    private int $numberOfEpisodes;
    private int $numberOfSeasons;
    private array $originCountry = [];
    private string $originalLanguage;
    private string $originalName;
    private string $overview;
    private string $lastAirDate;
    private float $popularity;
    private string $posterPath;
    private string $status;
    private string $type;
    private float $voteAverage;
    private int $voteCount;
    private Genres $genres;
    private array $productionCompagnies = [];
    private array $seasons = [];

    public function __construct(array $tvShow)
    {
        $this->backdropPath         = $tvShow['backdrop_path'];
        $this->posterPath           = $tvShow['poster_path'];
        $this->episodeRunTime       = $tvShow['episode_run_time'];
        $this->firstAirDate         = $tvShow['first_air_date'];
        $this->lastAirDate          = $tvShow['last_air_date'];
        $this->homepage             = $tvShow['homepage'];
        $this->id                   = $tvShow['id'];
        $this->inProduction         = $tvShow['in_production'];
        $this->languages            = $tvShow['languages'];
        $this->lastEpisodeToAir     = new Episode($tvShow['last_episode_to_air']);
        $this->name                 = $tvShow['name'];
        $this->nextEpisodeToAir     = is_null($tvShow['next_episode_to_air']) ? null : new Episode($tvShow['next_episode_to_air']);

        $this->genres = new Genres($tvShow['genres']);

        $this->setCreatedBy($tvShow['created_by']);
        $this->setNetworks($tvShow['networks']);
        $this->setProductionCompanies($tvShow['production_companies']);
        $this->setSeasons($tvShow['seasons']);

    }

    /**
     * Get backdrop path url
     * @param string $w, size of the image :  w300, w780, w1280, original
     * @return string|null
     * @throws \Exception
     */
    public function getBackdropPath(string $w = 'original'):?string{
        $img = New Image($this->backdropPath, 'backdrop', $w);
        return $img->getUrl();
    }

    /**
     * @return array
     */
    public function getCreateBy():array {
        return $this->createdBy;
    }

    /**
     * @return array
     */
    public function getEpisodeRunTime():array {
        return $this->episodeRunTime;
    }

    /**
     * @return string|null
     */
    public function getFirstAirDate():string {
        return $this->firstAirDate;
    }

    /**
     * @return string|null
     */
    public function getHomepage():?string
    {
        return $this->homepage;
    }

    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function getInProduction():bool
    {
        return $this->inProduction;
    }

    /**
     * @return array
     */
    public function getLanguage(): array
    {
        return $this->languages;
    }

    /**
     * @return string
     */
    public function getLastAirDate():string
    {
        return $this->lastAirDate;
    }

    /**
     * @return Episode
     */
    public function getLastEpisodeToAir(): Episode
    {
        return $this->lastEpisodeToAir;
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
    public function getNextEpisodeToAir():string
    {
        return $this->nextEpisodeToAir;
    }

    /**
     * @return int
     */
    public function getNumberOfEpisodes():int
    {
        return $this->numberOfEpisodes;
    }

    /**
     * @return int
     */
    public function getNumberOfSeasons():int
    {
        return $this->numberOfSeasons;
    }

    /**
     * @return array
     */
    public function getOriginCountry(): array
    {
        return $this->originCountry;
    }

    /**
     * @return string
     */
    public function getOriginalLanguage():string
    {
        return $this->originalLanguage;
    }

    /**
     * @return string
     */
    public function getOriginalName():string
    {
        return $this->originalName;
    }

    /**
     * @return string
     */
    public function getOverview():string
    {
        return $this->overview;
    }

    /**
     * @return int
     */
    public function getPopularity():int
    {
        return $this->popularity;
    }

    /**
     * @param string $w, w300, w780, w1280, original
     * @return string
     * @throws Exception
     */
    public function getPosterPath($w = 'original'):string
    {
        $img = New Image($this->posterPath, 'poster', $w);
        return $img->getUrl();
    }

    /**
     * @return string
     */
    public function getStatus():string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getType():string
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function getVoteAverage():float
    {
        return $this->voteAverage;
    }

    /**
     * @return int
     */
    public function getVoteCount():int
    {
        return $this->voteCount;
    }

    /**
     * Return all season
     * @return array
     */
    public function getSeasons():array {
        return $this->seasons;
    }

    /**
     * Return 1 season by the number
     * @param int $seasonNumber
     * @return array
     * @throws Exception
     */
    public function getSeason(int $seasonNumber):?Season{
        $result = array_filter($this->seasons, function(Season $season) use ($seasonNumber){
            return $season->getSeasonNumber() === $seasonNumber;
        });

        if(is_null($result) || !$result){
            throw new Exception('Season info not found.', 134);
        }
        return  array_shift($result);
    }

    public function getGenres():Genres{
        return $this->genres;
    }
    /**
     * @param array $createBy
     */
    protected function setCreatedBy(array $createBy):void {
        foreach ($createBy as $value){
            $this->createdBy[] = new CreatedBy($value);
        }
    }

    /**
     * @param array $networks, array contain networks data for create object Network
     */
    protected function setNetworks(array $networks):void {
        foreach ($networks as $value){
            $this->networks[] = new Network($value);
        }
    }

    /**
     * @param array $pc, array contain production_companies data for create object ProductionCompanies
     */
    protected function setProductionCompanies(array $pc):void {
        foreach ($pc as $value){
            $this->productionCompagnies[] = new ProductionCompanies($value);
        }
    }

    /**
     * @param array $seasons, array contain seasons data for create object Season
     */
    protected function setSeasons(array $seasons):void {
        foreach ($seasons as $value){
            $this->seasons[] = new Season($value);
        }
    }
}
