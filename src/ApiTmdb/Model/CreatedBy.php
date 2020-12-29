<?php

namespace ApiTmdb\Model;

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
     * @return string|null
     */
    public function getProfilePath():?string
    {
        return $this->profilePath;
    }

}
