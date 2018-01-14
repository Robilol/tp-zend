<?php

declare(strict_types=1);

namespace Meetup\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Meetup\Repository\CompanyRepository")
 * @ORM\Table(name="companies")
 */
class Company
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
    private $name;

    /**
     * @ORM\Column(type="string", length=2000, nullable=false)
     */
    private $address;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $city = '';

    /**
     * Company constructor.
     * @param $name
     * @param $address
     * @param string $city
     */
    public function __construct($name, $address, $city)
    {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }
}
