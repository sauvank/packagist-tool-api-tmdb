<?php


namespace ApiTmdb\Model;

use ApiTmdb\Model\TvShow\TvShow;
use Exception;
class Search
{
    protected int $page;
    protected int $totalResults;
    protected int $totalPages;
    protected array $results;

    /**
     * Search constructor.
     * @param array $search
     * @param $getByIdFnc, function contain methode for get result detail. exemple for tvshow :
     * function (int $id){
            return $this->getTvShowById($id);
        }
     */
    public function __construct(array $search,$getByIdFnc)
    {
        $this->page         = $search['page'];
        $this->totalResults = $search['total_results'];
        $this->totalPages   = $search['total_pages'];
        $this->setResults($search['results'], $getByIdFnc);
    }

    /**
     * @return int
     */
    public function getPage():int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getTotalResults():int
    {
        return $this->totalResults;
    }

    /**
     * @return int
     */
    public function getTotalPages():int
    {
        return $this->totalPages;
    }

    /**
     * @return array
     */
    public function getResults():array
    {
        return $this->results;
    }


    /**
     * @param int $index
     * @return tvShow|Movie
     * @throws Exception
     */
    public function getResult(int $index)
    {
        if(!isset($this->results[$index])){
            throw new Exception("index $index not exist in array", 321);
        }
        return $this->results[$index];
    }

    private function setResults($results, $getByIdFnc){
        $callback = [];

        foreach ($results as $result){
            $callback[] =  $getByIdFnc($result['id']);
        }

        $this->results = $callback;
    }

}
