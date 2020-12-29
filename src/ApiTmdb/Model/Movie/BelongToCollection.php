<?php


namespace ApiTmdb\Model\Movie;

class BelongToCollection
{
    private int $id;
    private string $name;
    private ?string $posterPath;
    private ?string $backdropPath;

    public function __construct(array $collection)
    {
        $this->id           = $collection['id'];
        $this->name         = $collection['name'];
        $this->posterPath   = isset($collection['poster_path']) ? $collection['poster_path'] : null;
        $this->backdropPath = isset($collection['backdrop_path']) ? $collection['backdrop_path'] : null;
    }

    /**
     * @return int|mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed|string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed|string
     */
    public function getPosterPath(): ?string
    {
        return $this->posterPath;
    }

    /**
     * @return mixed|string
     */
    public function getBackdropPath(): ?string
    {
        return $this->backdropPath;
    }
}