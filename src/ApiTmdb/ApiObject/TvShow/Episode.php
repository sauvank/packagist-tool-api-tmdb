<?php


namespace ApiTmdb\ApiObject\TvShow;


use ApiTmdb\ApiObject\Crew;
use ApiTmdb\ApiObject\GuestStars;
use ApiTmdb\Image;

class Episode
{
    private string $airDate;
    private string $name;
    private string $overview;
    private int $id;
    private string $productionCode;
    private string $episodeNumber;
    private int $seasonNumber;
    private ?Image $stillPath;
    private float $voteAverage;
    private int $voteCount;
    private array $crews = [];
    private array $guestStars = [];

    /**
     * Creation of an 'Episode' object from an array containing the episode information
     * Episode constructor.
     * @param array $episode
     * @throws \Exception
     */
    public function __construct(array $episode)
    {
        $this->airDate          = $episode['air_date'];
        $this->name             = $episode['name'];
        $this->overview         = $episode['overview'];
        $this->id               = $episode['id'];
        $this->productionCode   = $episode['production_code'];
        $this->episodeNumber    = $episode['episode_number'];
        $this->seasonNumber     = $episode['season_number'];
        $this->stillPath        = is_null($episode['still_path'])? null : new Image($episode['still_path'], 'still');
        $this->voteAverage      = $episode['vote_average'];
        $this->voteCount        = $episode['vote_count'];

        isset($episode['crew']) ? $this->setCrews($episode['crew']) : null;
        isset($episode['guest_stars']) ? $this->setGuestStars($episode['guest_stars']) : null;
    }

    /**
     * @return string
     */
    public function getAirDate():string
    {
        return $this->airDate;
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
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getProductionCode():string
    {
        return $this->productionCode;
    }

    /**
     * @return string
     */
    public function getEpisodeNumber():string
    {
        return $this->episodeNumber;
    }

    /**
     * @return int
     */
    public function getSeasonNumber():int
    {
        return $this->seasonNumber;
    }

    /**
     * @return Image or null
     */
    public function getStillPath():?Image
    {
        return $this->stillPath;
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
     * @return Crew
     */
    public function getCrew(): array
    {
        return $this->crews;
    }

    /**
     * @return GuestStars
     */
    public function getGuestStars(): array
    {
        return $this->guestStars;
    }

    protected function setCrews(array $crews){
        foreach ($crews as $crew){
            $this->crews[] = new Crew($crew);
        }
    }
    protected function setGuestStars(array $guestStars){
        foreach ($guestStars as $gs){
            $this->guestStars[] = new GuestStars($gs);
        }
    }
}
