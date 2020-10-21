<?php

namespace ApiTmdb\ApiObject;

use Exception;
use phpDocumentor\Reflection\Types\Array_;

class Genres
{
    private array $genres = [];

    public function __construct($genres)
    {
//        if(!isset($genres['genres'])){
//            throw new Exception('Key "genres" is not define', 131);
//        }
        $genres = isset($genres['genres']) ? $genres['genres'] : $genres;
        foreach ($genres as $key => $genre){
            $this->genres[] = new Genre($genre['id'], $genre['name']);
        }
    }

    /**
     * @param int $id
     * @return Genre
     * @throws Exception
     */
    public function getById(int $id):Genre {
        return $this->getByKey('id', $id);
    }

    /**
     * @param string $name
     * @return Genre
     * @throws Exception
     */
    public function getByName(string $name):Genre{
        return $this->getByKey('name', $name);
    }

    /**
     * @return array
     */
    public function getAll():array {
        return $this->genres;
    }

    public function get(int $index):?Genre{
        return isset($this->genres[$index]) ? $this->genres[$index] : null;
    }

    /**
     * @param string $key
     * @param $value
     * @return Genre
     * @throws Exception
     */
    private function getByKey(string $key, $value):Genre {

        $items = array_filter($this->genres, function($item) use ($key, $value){
            $fn = 'get'.ucfirst($key);
            return $item->$fn() == $value;
        });

        if(!$items){
            throw new Exception("$key $value not exist", 132);
        }

        return array_shift($items);
    }
}
