<?php

namespace WCS\CoavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="WCS\CoavBundle\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(name="nbReservedSeats", type="smallint")
     * @Assert\Range(
     *     min=1,
     *     minMessage="Specify how many seats you need.", invalidMessage="The number is not a valid number."
     * )
     */
    private $nbReservedSeats;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publicationDate", type="datetime")
     */
    private $publicationDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="wasDone", type="boolean")
     */
    private $wasDone;

    /**
     * @ORM\ManyToOne(targetEntity="WCS\CoavBundle\Entity\Flight", inversedBy="reservations")
     */
    private $flight;

    /**
     * @ORM\ManyToOne(targetEntity="WCS\CoavBundle\Entity\User", inversedBy="reservations")
     */
    private $user;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nbReservedSeats
     *
     * @param integer $nbReservedSeats
     *
     * @return Reservation
     */
    public function setNbReservedSeats($nbReservedSeats)
    {
        $this->nbReservedSeats = $nbReservedSeats;

        return $this;
    }

    /**
     * Get nbReservedSeats
     *
     * @return int
     */
    public function getNbReservedSeats()
    {
        return $this->nbReservedSeats;
    }

    /**
     * Set publicationDate
     *
     * @param \DateTime $publicationDate
     *
     * @return Reservation
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate
     *
     * @return \DateTime
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Set wasDone
     *
     * @param boolean $wasDone
     *
     * @return Reservation
     */
    public function setWasDone($wasDone)
    {
        $this->wasDone = $wasDone;

        return $this;
    }

    /**
     * Get wasDone
     *
     * @return bool
     */
    public function getWasDone()
    {
        return $this->wasDone;
    }

    /**
     * Set flight
     *
     * @param string $flight
     *
     * @return Reservation
     */
    public function setFlight($flight)
    {
        $this->flight = $flight;

        return $this;
    }

    /**
     * Get flight
     *
     * @return string
     */
    public function getFlight()
    {
        return $this->flight;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}
