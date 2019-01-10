<?php

namespace WCS\CoavBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Flight
 *
 * @ORM\Table(name="flight")
 * @ORM\Entity(repositoryClass="WCS\CoavBundle\Repository\FlightRepository")
 */
class Flight
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
     * @ORM\Column(name="nbFreeSeats", type="smallint")
     * @Assert\Range(
     *     min=1,
     *     minMessage="The flight must have at least {{ limit }} seat.",
     *     invalidMessage="The number is not a valid number."
     * )
     */
    private $nbFreeSeats;

    /**
     * @var float
     * @ORM\Column(name="seatPrice", type="float")
     * @Assert\Type(
     *     type = "integer",
     *     message = "The price is not a valid {{ type }}."
     * )
     */
    private $seatPrice;

    /**
     * @var \DateTime
     * @ORM\Column(name="takeOffTime", type="datetime")
     * @Assert\NotNull(
     *     message = "You must enter a take off date and time"
     * )
     */
    private $takeOffTime;

    /**
     * @var \DateTime
     * @ORM\Column(name="landingTime", type="datetime")
     * @Assert\NotNull(
     *     message = "You must enter a take off date and time"
     * )
     */
    private $landingTime;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="wasDone", type="boolean")
     */
    private $wasDone;

    /**
     * @ORM\ManyToOne(targetEntity=Airport::class, inversedBy="departFlights")
     */
    private $departAirport;

    /**
     * @ORM\ManyToOne(targetEntity=Airport::class, inversedBy="arrivalFlights")
     */
    private $arrivalAirport;


    /**
    * @ORM\ManyToOne(targetEntity="WCS\CoavBundle\Entity\User", inversedBy="flights")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="WCS\CoavBundle\Entity\PlaneModel", inversedBy="flights")
     */
    private $planeModel;


    /**
     * @ORM\OneToMany(targetEntity="WCS\CoavBundle\Entity\Reservation", mappedBy="flight")
     */
    private $reservations;


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
     * Set nbFreeSeats
     *
     * @param integer $nbFreeSeats
     *
     * @return Flight
     */
    public function setNbFreeSeats($nbFreeSeats)
    {
        $this->nbFreeSeats = $nbFreeSeats;

        return $this;
    }

    /**
     * Get nbFreeSeats
     *
     * @return int
     */
    public function getNbFreeSeats()
    {
        return $this->nbFreeSeats;
    }

    /**
     * Set seatPrice
     *
     * @param float $seatPrice
     *
     * @return Flight
     */
    public function setSeatPrice($seatPrice)
    {
        $this->seatPrice = $seatPrice;

        return $this;
    }

    /**
     * Get seatPrice
     *
     * @return float
     */
    public function getSeatPrice()
    {
        return $this->seatPrice;
    }

    /**
     * Set takeOffTime
     *
     * @param \DateTime $takeOffTime
     *
     * @return Flight
     */
    public function setTakeOffTime($takeOffTime)
    {
        $this->takeOffTime = $takeOffTime;

        return $this;
    }

    /**
     * Get takeOffTime
     *
     * @return \DateTime
     */
    public function getTakeOffTime()
    {
        return $this->takeOffTime;
    }

    /**
     * Set landingTime
     *
     * @param \DateTime $landingTime
     *
     * @return Flight
     */
    public function setLandingTime($landingTime)
    {
        $this->landingTime = $landingTime;

        return $this;
    }

    /**
     * Get landingTime
     *
     * @return \DateTime
     */
    public function getLandingTime()
    {
        return $this->landingTime;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Flight
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set wasDone
     *
     * @param boolean $wasDone
     *
     * @return Flight
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
     * Set user
     *
     * @param \WCS\CoavBundle\Entity\User $user
     *
     * @return Flight
     */
    public function setUser(\WCS\CoavBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \WCS\CoavBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set planeModel
     *
     * @param \WCS\CoavBundle\Entity\PlaneModel $planeModel
     *
     * @return Flight
     */
    public function setPlaneModel(\WCS\CoavBundle\Entity\PlaneModel $planeModel = null)
    {
        $this->planeModel = $planeModel;

        return $this;
    }

    /**
     * Get planeModel
     *
     * @return \WCS\CoavBundle\Entity\PlaneModel
     */
    public function getPlaneModel()
    {
        return $this->planeModel;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->terrains = new ArrayCollection();
    }

    /**
     * Add reservation
     *
     * @param \WCS\CoavBundle\Entity\Reservation $reservation
     *
     * @return Flight
     */
    public function addReservation(\WCS\CoavBundle\Entity\Reservation $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \WCS\CoavBundle\Entity\Reservation $reservation
     */
    public function removeReservation(\WCS\CoavBundle\Entity\Reservation $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations()
    {
        return $this->reservations;
    }


    /**
     * Add terrain
     *
     * @param \WCS\CoavBundle\Entity\Airport $terrain
     *
     * @return Flight
     */
    public function addTerrain(Airport $terrain)
    {
        $this->terrains[] = $terrain;

        return $this;
    }

    /**
     * Remove terrain
     *
     * @param \WCS\CoavBundle\Entity\Airport $terrain
     */
    public function removeTerrain(\WCS\CoavBundle\Entity\Airport $terrain)
    {
        $this->terrains->removeElement($terrain);
    }

    /**
     * Get terrains
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTerrains()
    {
        return $this->terrains;
    }

    /**
     * Set departTerrain
     *
     * @param \WCS\CoavBundle\Entity\Airport $departTerrain
     *
     * @return Flight
     */
    public function setDepartTerrain(\WCS\CoavBundle\Entity\Airport $departTerrain = null)
    {
        $this->departTerrain = $departTerrain;

        return $this;
    }

    /**
     * Get departTerrain
     *
     * @return \WCS\CoavBundle\Entity\Airport
     */
    public function getDepartTerrain()
    {
        return $this->departTerrain;
    }

    /**
     * Set arrivalTerrain
     *
     * @param \WCS\CoavBundle\Entity\Airport $arrivalTerrain
     *
     * @return Flight
     */
    public function setArrivalTerrain(\WCS\CoavBundle\Entity\Airport $arrivalTerrain = null)
    {
        $this->arrivalTerrain = $arrivalTerrain;

        return $this;
    }

    /**
     * Get arrivalTerrain
     *
     * @return \WCS\CoavBundle\Entity\Airport
     */
    public function getArrivalTerrain()
    {
        return $this->arrivalTerrain;
    }
}
