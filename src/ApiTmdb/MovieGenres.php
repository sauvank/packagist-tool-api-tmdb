<?php

namespace ApiTmdb;

use stdClass;

class MovieGenres
{
    protected $genres;

    public function __construct(array $genres)
    {
        $this->genres = $genres;
    }

    public function getAll(): array {
        return $this->genres;
    }

    public function getByIndex(int $index):?array {
        return $this->genres[$index] ?? null;
    }

    public function orderByName(): MovieGenres{

        if(!isset($this->genres[0]['id'])){
            sort($this->genres);
            return $this;
        }

        usort($this->genres, function($a, $b) {
            return strnatcasecmp($a['name'], $b['name']);
        });

        return $this;
    }

    public function onlyName(): MovieGenres{
        $names = [];
        foreach ($this->genres as $key => $value){
            $names[] = $value['name'];
        }

        $this->genres = $names;
        return $this;
    }

}
