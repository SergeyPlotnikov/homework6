<?php

namespace App\Services;

class Currency
{
    private $id;
    private $name;
    private $shortName;
    private $actualCourse;
    private $actualCourseDate;
    private $active;

    public function __construct(int $id, string $name, string $shortName, float $actualCourse,
                                \DateTime $actualCourseDate, bool $active)
    {
        $this->id = $id;
        $this->name = $name;
        $this->shortName = $shortName;
        $this->actualCourse = $actualCourse;
        $this->actualCourseDate = $actualCourseDate;
        $this->active = $active;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * @return float
     */
    public function getActualCourse(): float
    {
        return $this->actualCourse;
    }

    /**
     * @return \DateTime
     */
    public function getActualCourseDate(): \DateTime
    {
        return $this->actualCourseDate;
    }

    /**
     * @return boolean
     */
    public function isActive(): bool
    {
        return $this->active;
    }


}