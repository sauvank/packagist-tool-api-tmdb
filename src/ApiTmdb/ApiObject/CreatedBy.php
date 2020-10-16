<?php

namespace ApiTmdb\ApiObject;

use ApiTmdb\Image;

class CreatedBy
{
    protected int $id;
    protected string $creditId;
    protected string $name;
    protected ?int $gender;
    protected ?string $profilePath;

    public function __construct(array $createBy)
    {
        $this->id = $createBy['id'];
        $this->creditId = $createBy['credit_id'];
        $this->name = $createBy['name'];
        $this->gender = isset($createBy['gender']) ? $createBy['gender'] :  null;
        $this->profilePath = $createBy['profile_path'];
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
     * @return int
     */
    public function getGender():int
    {
        return $this->gender;
    }

    /**
     * @param string $w , w300, w780, w1280, original
     * @return string|null
     * @throws \Exception
     */
    public function getProfilePath($w = 'original'):?string
    {
        $img = New Image($this->profilePath, 'profile', $w);
        return $img->getUrl();
    }

}
