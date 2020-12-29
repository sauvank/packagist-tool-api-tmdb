<?php

namespace ApiTmdb\ApiObject;

class GuestStars
{
    private int $id;
    private string $creditId;
    private string $name;
    private string $character;
    private int $order;
    private int $gender;
    private ?string $profilePath;

    public function __construct(array $guestStars)
    {
        $this->id           = $guestStars['id'];
        $this->creditId     = $guestStars['credit_id'];
        $this->name         = $guestStars['name'];
        $this->character    = $guestStars['character'];
        $this->order        = $guestStars['order'];
        $this->gender       = $guestStars['gender'];
        $this->profilePath  = $guestStars['profile_path'];
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
    public function getCreditId():string
    {
        return $this->creditId;
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
    public function getCharacter():string
    {
        return $this->character;
    }

    /**
     * @return int
     */
    public function getOrder():int
    {
        return $this->order;
    }

    /**
     * @return int
     */
    public function getGender():int
    {
        return $this->gender;
    }

    /**
     * @return string|null
     * @throws \Exception
     */
    public function getProfilePath():?string
    {
        return $this->profilePath;
    }

}
