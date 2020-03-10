<?php
namespace ApiTmdb;
use Exception;
class CommonMovieTvShow extends ApiTmdb {
    protected array $result;
    protected bool $isSearchById;
    protected string $urlType;
    protected string $urlSearch;
    protected string $urlGenres;
    protected ?array $genres = null;
    protected string $typeOfSearch;

    /**
     * All function common to request for TvShow And movie
     * CommonMovieTvShow constructor.
     * @param string $apiKey
     * @param string $lang
     * @param string $typeOfSearch, typeOfSearch of request : tv or movie0
     * @throws Exception
     */
    public function __construct(string $apiKey, string $lang, string $typeOfSearch)
    {
        parent::__construct($apiKey, $lang);
        $this->typeOfSearch = $typeOfSearch;
        $this->urlType = $this->baseUrl . $typeOfSearch . '/';
        $this->urlSearch = $this->baseUrl . 'search/'. $typeOfSearch;
        $this->urlGenres = $this->baseUrl . 'genre/'.$typeOfSearch.'/list';
    }

    /***************************
     * Common Getter and Setter
    /***************************/

    /**
     * @return bool
     */
    public function getIsAdult(): bool {
        return $this->result['adult'];
    }

    /**
     * Return the path of the background image.
     * @param bool $fullUrl, for get the full url of the backdrop image.
     * @param string $size, get backdrop with size ('original', 'w300', 'w780' , 'w1280')
     * @return string
     * @throws Exception
     */
    public function getBackdropPath(bool $fullUrl = true, string $size = "original"): ?string {
        $sizeOptions = ['original', 'w300', 'w780' , 'w1280'];

        if(array_search($size, $sizeOptions) === -1){
            throw new Exception("value '$size' is not available for params 'size' , accepted value : " . implode(',', $sizeOptions));
        }
        $path = $this->result['backdrop_path'];
        return $fullUrl ? $this->urlImage . $size . '/' .$path : $path;
    }

    public function getTitle(): string {
        $key = $this->typeOfSearch === 'movie' ? 'title' : 'name';
        return  $this->result[$key];
    }

    public function getCollection(): ?string{
        return $this->result['belongs_to_collection'];
    }

    public function getProductionCompanies(): array {
        return $this->result['production_companies'];
    }

    public function getBudget(): int{
        return $this->result['budget'];
    }

    public function getGenres(): array {
        return $this->result['genres'];
    }

    public function getHomepage(): string {
        return $this->result['homepage'];
    }

    public function getId(): int {
        return $this->result['id'];
    }

    public function getImdbId(): string {
        return $this->result['imdb_id'];
    }

    public function getOriginalLanguage(): string {
        return $this->result['original_language'];
    }

    public function getOriginalTitle(): string {
        $key = $this->typeOfSearch === 'movie' ? 'original_title' : 'original_name';
        return $this->result[$key];
    }

    public function getOverview(): string {
        return $this->result['overview'];
    }

    public function getPopularity(): string {
        return $this->result['popularity'];
    }

    public function getPosterPath(bool $fullUrl = true, string $size = 'original'): ?string {
        $sizeOptions = ['original', 'w300', 'w780' , 'w1280'];

        if(array_search($size, $sizeOptions) === -1){
            throw new Exception("value '$size' is not available for params 'size' , accepted value : " . implode(',', $sizeOptions));
        }
        $path = $this->result['poster_path'];
        return $fullUrl ? $this->urlImage . $size . '/' .$path : $path;
    }

    public function getRevenue(): int {
        return $this->result['revenue'];
    }

    public function getRuntime(): int {
        return $this->result['runtime'];
    }

    public function getStatus(): string {
        return $this->result['status'];
    }

    public function getTagLine(): string {
        return $this->result['tagline'];
    }

    public function getVideo(): string {
        return $this->result['video'];
    }

    public function getVoteAverage(): float {
        return $this->result['vote_average'];
    }

    public function getVoteCount(): int {
        return $this->result['vote_count'];
    }

    public function getUrlPageTMDB(): string {
        return 'https://www.themoviedb.org/'. $this->typeOfSearch . '/' . $this->getId();
    }
    /***************************
     * Utils Functions
    /***************************/

    /**
     * Return the number result found.
     * @return int
     */
    public function getTotalResult(){
        return $this->isSearchById ? $this->totalResultById() : $this->totalResultByName();
    }

    /**
     * Return all data returned by api
     * @return mixed
     */
    public function getResult(): array {
        return $this->result;
    }

    /**
     * Only if get movie by name, return detail movie from index result.
     * @param int $index
     * @return Movie or TvShow , new instance of Movie or TvShow.
     * @throws Exception
     */
    public function getResultsByIndex(int $index) {
        $classReturn  = $this->typeOfSearch === 'movie' ? Movie::class : TvShow::class;
        $m = new $classReturn($this->getApiKey(), $this->getLang(), $this->typeOfSearch);
        return $m->getById($this->result['results'][$index]['id']);
    }

    /**
     * return all genres for movie.
     * @return array
     */
    public function getGenresMovie(): array {
        if($this->genres){
            return $this->genres;
        }

        $url = $this->urlGenres . '?' . $this->endUrl();
        return $this->callApi($url)['genres'];
    }

    public function countResultPage(): int{
        return count($this->result['results']);
    }

    /**
     * Return a array contain name of genres from array idsGenres
     * @param array $idsGenres
     * @return array
     */
    public function idsGenresToName(array $idsGenres): array {
        $genres = $this->getGenresMovie();
        return array_map(function ($id) use ($genres){
            $key = array_search($id, array_column($genres, 'id'));
            return $genres[$key]['name'];
        },$idsGenres );
    }

    private function totalResultById(){
        return isset($this->result['id']) ? 1 : 0;
    }

    private function totalResultByName(){
        return $this->result['total_results'];
    }

    protected function dataApiFromId(int $id): array {
        $url = $this->urlType . $id . '?' . $this->endUrl();
        return $this->callApi($url);
    }
}
