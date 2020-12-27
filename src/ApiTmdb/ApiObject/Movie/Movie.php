<?php
namespace ApiTmdb\ApiObject\Movie;

use ApiTmdb\ApiObject\CommonDetail;
use ApiTmdb\ApiObject\Genres;
use phpDocumentor\Reflection\Types\Integer;

class Movie extends CommonDetail
{

    private bool $adult;
    //todo create class
    private ?BelongToCollection $belongsToCollection;
    private ?array $productionCountries;
    private ?array  $spokenLanguages;

    private int $budget;
    private string $originalTitle;
    private string $releaseDate;
    private int $revenue;
    private ?int $runtime;
    private ?string $tagline;
    private string $title;
    private bool $video;

    public function __construct(array $movie)
    {
        parent::__construct($movie);
        $this->adult            = $movie['adult'];
        $this->budget           = $movie['budget'];
        $this->originalTitle    = $movie['original_title'];
        $this->releaseDate      = $movie['release_date'];
        $this->revenue          = $movie['revenue'];
        $this->runtime          = $movie['runtime'];
        $this->tagline          = $movie['tagline'];
        $this->title            = $movie['title'];
        $this->video            = $movie['video'];
        $this->belongsToCollection = isset($movie['belongs_to_collection']) ? new BelongToCollection($movie['belongs_to_collection']) : null;
        $this->productionCountries = isset($movie['production_countries']) ? $this->setProductionCountries($movie['production_countries']) : null;
        $this->spokenLanguages = isset($movie['spoken_languages']) ? $this->setProductionCountries($movie['spoken_languages']) : null;
    }

    /**
     * @return bool
     */
    public function isAdult(): bool
    {
        return $this->adult;
    }

    /**
     * @return int
     */
    public function getBudget(): int
    {
        return $this->budget;
    }

    /**
     * @return string
     */
    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    /**
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
     * @return int
     */
    public function getRevenue(): int
    {
        return $this->revenue;
    }

    /**
     * @return int|null
     */
    public function getRuntime(): ?int
    {
        return $this->runtime;
    }

    /**
     * @return string|null
     */
    public function getTagline(): ?string
    {
        return $this->tagline;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return bool
     */
    public function isVideo(): bool
    {
        return $this->video;
    }

    /**
     * @return BelongToCollection|null
     */
    public function getBelongsToCollection(): ?BelongToCollection
    {
        return $this->belongsToCollection;
    }

    private function setProductionCountries(array $productionCountries):array{
        $output = [];
        foreach ($productionCountries as $pc){
            $output[] = new ProductionCountries($pc);
        }

        return $output;
    }

    /**
     * @return array|null
     */
    public function getProductionCountries(): ?array
    {
        return $this->productionCountries;
    }

    private function setSpokenLanguages(array $spokenLanguage):array{
        $output = [];
        foreach ($spokenLanguage as $sl){
            $output[] = new SpokenLanguages($sl);
        }

        return $output;
    }

    /**
     * @return array|null
     */
    public function getSpokenLanguages(): ?array
    {
        return $this->spokenLanguages;
    }

}
