<?php

declare(strict_types=1);

namespace Meetup\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Meetup\Repository\MeetupRepository")
 * @ORM\Table(name="meetups")
 */
class Meetup
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2000, nullable=false)
     */
    private $description = '';

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $stime = '';

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $etime = '';

    /**
     * Meetup constructor.
     * @param $title
     * @param string $description
     * @param string $stime
     * @param string $etime
     * @param $creator
     * @param $company
     */
    public function __construct($title, $description, $stime, $etime)
    {
        $this->title = $title;
        $this->description = $description;
        $this->stime = $stime;
        $this->etime = $etime;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getStime()
    {
        return $this->stime;
    }

    /**
     * @param mixed $stime
     */
    public function setStime($stime)
    {
        $this->stime = $stime;
    }

    /**
     * @return mixed
     */
    public function getEtime()
    {
        return $this->etime;
    }

    /**
     * @param mixed $etime
     */
    public function setEtime($etime)
    {
        $this->etime = $etime;
    }
}
