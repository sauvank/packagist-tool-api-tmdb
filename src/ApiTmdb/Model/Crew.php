<?php
namespace ApiTmdb\Model;

class Crew
{
    private int $id;
    private string $creditId;
    private string $name;
    private string $department;
    private string $job;
    private int $gender;
    private ?string $profilePath;

    public function __construct(array $crewData)
    {
        $this->id           = $crewData['id'];
        $this->creditId     = $crewData['credit_id'];
        $this->name         = $crewData['name'];
        $this->department   = $crewData['department'];
        $this->job          = $crewData['job'];
        $this->gender       = $crewData['gender'];
        $this->profilePath  = $crewData['profile_path'];
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
    public function getDepartment():string
    {
        return $this->department;
    }

    /**
     * @return string
     */
    public function getJob():string
    {
        return $this->job;
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
