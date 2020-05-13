<?php


namespace ApiTmdb;


class MovieCollection
{
    protected $collection;
    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    public function getId(): int {
        return $this->collection['id'];
    }

    public function getName(): string {
        return $this->collection['name'];
    }

    public function getUrlPosterPath(): ?string {
        return $this->collection['poster_path'] ?? null;
    }

    public function getUrlBackdropPath(): ?string {
        return $this->collection['backdrop_path'] ?? null;
    }
}
