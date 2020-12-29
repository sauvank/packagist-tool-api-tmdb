<?php
namespace ApiTmdb\ApiObject;

class CommonDetail
{
    protected ?string $backdropPath = null;
    protected ?string $homepage = null;
    protected int $id;
    protected string $originalLanguage;
    protected string $overview;
    protected float $popularity;
    protected ?string $posterPath;
    protected string $status;
    protected float $voteAverage;
    protected int $voteCount;
    protected Genres $genres;
    protected array $productionCompagnies = [];

    public function __construct(array $detail)
    {
        $this->backdropPath         = $detail['backdrop_path'];
        $this->posterPath           = $detail['poster_path'];
        $this->homepage             = $detail['homepage'];
        $this->id                   = $detail['id'];
        $this->genres               = new Genres($detail['genres']);
        $this->status               = $detail['status'];
        $this->setProductionCompanies($detail['production_companies']);
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
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * Get backdrop path url
     * @return string|null
     */
    public function getBackdropPath():?string{
        return $this->backdropPath;
    }

    /**
     * @return string
     */
    public function getOriginalLanguage():string
    {
        return $this->originalLanguage;
    }


    public function getGenres():Genres{
        return $this->genres;
    }

    /**
     * @return string|null
     */
    public function getHomepage():?string
    {
        return $this->homepage;
    }

    /**
     * @return string
     */
    public function getPosterPath():string
    {
        return $this->posterPath;
    }


    /**
     * @return string
     */
    public function getStatus():string
    {
        return $this->status;
    }


    /**
     * @return int
     */
    public function getVoteCount():int
    {
        return $this->voteCount;
    }

    /**
     * @return float
     */
    public function getVoteAverage():float
    {
        return $this->voteAverage;
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
}