<?php
namespace ApiTmdb\Model;

class Genre
{
    private int $id;
    private string $name;

    public function __construct(int $id, string $name)
    {
        $this->name = $name;
        $this->id = $id;
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
    public function getName():string
    {
        return $this->name;
    }

}
