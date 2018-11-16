<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Offer
 *
 * @ORM\Table(name="offer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OfferRepository")
 */
class Offer
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
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255, nullable=true)
     */
    private $reference;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entryDate", type="datetime", nullable=true)
     */
    private $entryDate;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="offer", cascade={"persist"})
     *
     */
    private $images;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction", type="string", length=255, nullable=true)
     */
    private $transaction;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;


    /**
     * @var boolean
     *
     * @ORM\Column(name="old", type="boolean")
     */
    private $old = 0;

    /**
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\Column(name="descriptionEn", type="text")
     */
    private $descriptionEn;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=255, nullable=true)
     */
    private $zipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer", length=255, nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="charge", type="string", length=255, nullable=true)
     */
    private $charge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="showPrice", type="boolean")
     */
    private $showPrice = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hall", type="boolean")
     */
    private $hall = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="kitchen", type="boolean")
     */
    private $kitchen = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="equiped", type="boolean")
     */
    private $equiped = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="open", type="boolean")
     */
    private $open = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="living", type="boolean")
     */
    private $living = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="doubleLiving", type="boolean")
     */
    private $doubleLiving = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="office", type="boolean")
     */
    private $office = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrShower", type="integer", nullable=true)
     */
    private $nbrShower = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrBathroom", type="integer", nullable=true)
     */
    private $nbrBathroom = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="separatedBathroom", type="boolean")
     */
    private $separatedBathroom = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cupboard", type="boolean")
     */
    private $cupboard = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="basement", type="boolean")
     */
    private $basement = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrBedroom", type="integer", nullable=true)
     */
    private $nbrBedroom = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="surface", type="integer", nullable=true)
     */
    private $surface = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="surfaceTerrain", type="integer", nullable=true)
     */
    private $surfaceTerrain = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="terrasse", type="integer", nullable=true)
     */
    private $terrasse = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="balcon", type="integer", nullable=true)
     */
    private $balcon = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="garden", type="integer", nullable=true)
     */
    private $garden = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="veranda", type="integer", nullable=true)
     */
    private $veranda = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="loggia", type="integer", nullable=true)
     */
    private $loggia = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="swimmingPool", type="boolean")
     */
    private $swimmingPool = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="attic", type="integer", nullable=true)
     */
    private $attic = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="buanderie", type="boolean")
     */
    private $buanderie = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="renovated", type="boolean")
     */
    private $renovated = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="meuble", type="boolean")
     */
    private $meuble = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pet", type="boolean")
     */
    private $pet = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="caveVin", type="boolean")
     */
    private $caveVin = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrFloor", type="integer", nullable=true)
     */
    private $nbrFloor = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="floor", type="string", length=255, nullable=true)
     */
    private $floor;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lastFloor", type="boolean")
     */
    private $lastFloor = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="externalParking", type="integer", nullable=true)
     */
    private $externalParking = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="internalParking", type="integer", nullable=true)
     */
    private $internalParking = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="garage", type="integer", nullable=true)
     */
    private $garage = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lift", type="boolean")
     */
    private $lift = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="antenna", type="boolean")
     */
    private $antenna = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="voletsRoul", type="boolean")
     */
    private $voletsRoul = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="voletsElec", type="boolean")
     */
    private $voletsElec = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="handicape", type="boolean")
     */
    private $handicape = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="porteBlindee", type="boolean")
     */
    private $porteBlindee = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="parlophone", type="boolean")
     */
    private $parlophone = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="videophone", type="boolean")
     */
    private $videophone = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="digicode", type="boolean")
     */
    private $digicode = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="alarme", type="boolean")
     */
    private $alarme = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="energy", type="string", length=255, nullable=true)
     */
    private $energy;

    /**
     * @var string
     *
     * @ORM\Column(name="energyValue", type="string", length=255, nullable=true)
     */
    private $energyValue;

    /**
     * @var string
     *
     * @ORM\Column(name="ges", type="string", length=255, nullable=true)
     */
    private $ges;

    /**
     * @var string
     *
     * @ORM\Column(name="gesValue", type="string", length=255, nullable=true)
     */
    private $gesValue;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dpeInrss", type="boolean")
     */
    private $dpeInProgress = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dpeNotApplicable", type="boolean")
     */
    private $dpeNotApplicable = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dpeVirgin", type="boolean")
     */
    private $dpeVirgin = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gaz", type="boolean")
     */
    private $gaz = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="elec", type="boolean")
     */
    private $elec = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fuel", type="boolean")
     */
    private $fuel = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="collectif", type="boolean")
     */
    private $collectif = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="charbon", type="boolean")
     */
    private $charbon = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="granules", type="boolean")
     */
    private $granules = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="clim", type="boolean")
     */
    private $clim = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cheminee", type="boolean")
     */
    private $cheminee = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="insertHeat", type="boolean")
     */
    private $insertHeat = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="central", type="boolean")
     */
    private $central = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="radiateur", type="boolean")
     */
    private $radiateur = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="collectiveWater", type="boolean")
     */
    private $collectiveWater = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gazWater", type="boolean")
     */
    private $gazWater = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="elecWater", type="boolean")
     */
    private $elecWater = 0;

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
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Offer
     */
    public function addImage(\AppBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Image $image
     */
    public function removeImage(\AppBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Offer
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Offer
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }

    /**
     * @param mixed $descriptionEn
     * @return Offer
     */
    public function setDescriptionEn($descriptionEn)
    {
        $this->descriptionEn = $descriptionEn;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Offer
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     * @return Offer
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * @param string $transaction
     * @return Offer
     */
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return Offer
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return Offer
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEntryDate()
    {
        return $this->entryDate;
    }

    /**
     * @param \DateTime $entryDate
     * @return Offer
     */
    public function setEntryDate($entryDate)
    {
        $this->entryDate = $entryDate;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOld()
    {
        return $this->old;
    }

    /**
     * @param bool $old
     * @return Offer
     */
    public function setOld($old)
    {
        $this->old = $old;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     * @return Offer
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Offer
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getCharge()
    {
        return $this->charge;
    }

    /**
     * @param string $charge
     * @return Offer
     */
    public function setCharge($charge)
    {
        $this->charge = $charge;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShowPrice()
    {
        return $this->showPrice;
    }

    /**
     * @param bool $showPrice
     * @return Offer
     */
    public function setShowPrice($showPrice)
    {
        $this->showPrice = $showPrice;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHall()
    {
        return $this->hall;
    }

    /**
     * @param bool $hall
     * @return Offer
     */
    public function setHall($hall)
    {
        $this->hall = $hall;
        return $this;
    }

    /**
     * @return bool
     */
    public function isKitchen()
    {
        return $this->kitchen;
    }

    /**
     * @param bool $kitchen
     * @return Offer
     */
    public function setKitchen($kitchen)
    {
        $this->kitchen = $kitchen;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEquiped()
    {
        return $this->equiped;
    }

    /**
     * @param bool $equiped
     * @return Offer
     */
    public function setEquiped($equiped)
    {
        $this->equiped = $equiped;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOpen()
    {
        return $this->open;
    }

    /**
     * @param bool $open
     * @return Offer
     */
    public function setOpen($open)
    {
        $this->open = $open;
        return $this;
    }

    /**
     * @return bool
     */
    public function isLiving()
    {
        return $this->living;
    }

    /**
     * @param bool $living
     * @return Offer
     */
    public function setLiving($living)
    {
        $this->living = $living;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDoubleLiving()
    {
        return $this->doubleLiving;
    }

    /**
     * @param bool $doubleLiving
     * @return Offer
     */
    public function setDoubleLiving($doubleLiving)
    {
        $this->doubleLiving = $doubleLiving;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOffice()
    {
        return $this->office;
    }

    /**
     * @param bool $office
     * @return Offer
     */
    public function setOffice($office)
    {
        $this->office = $office;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbrShower()
    {
        return $this->nbrShower;
    }

    /**
     * @param int $nbrShower
     * @return Offer
     */
    public function setNbrShower($nbrShower)
    {
        $this->nbrShower = $nbrShower;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbrBathroom()
    {
        return $this->nbrBathroom;
    }

    /**
     * @param int $nbrBathroom
     * @return Offer
     */
    public function setNbrBathroom($nbrBathroom)
    {
        $this->nbrBathroom = $nbrBathroom;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSeparatedBathroom()
    {
        return $this->separatedBathroom;
    }

    /**
     * @param bool $separatedBathroom
     * @return Offer
     */
    public function setSeparatedBathroom($separatedBathroom)
    {
        $this->separatedBathroom = $separatedBathroom;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCupboard()
    {
        return $this->cupboard;
    }

    /**
     * @param bool $cupboard
     * @return Offer
     */
    public function setCupboard($cupboard)
    {
        $this->cupboard = $cupboard;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBasement()
    {
        return $this->basement;
    }

    /**
     * @param bool $basement
     * @return Offer
     */
    public function setBasement($basement)
    {
        $this->basement = $basement;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbrBedroom()
    {
        return $this->nbrBedroom;
    }

    /**
     * @param int $nbrBedroom
     * @return Offer
     */
    public function setNbrBedroom($nbrBedroom)
    {
        $this->nbrBedroom = $nbrBedroom;
        return $this;
    }

    /**
     * @return int
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * @param int $surface
     * @return Offer
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;
        return $this;
    }

    /**
     * @return int
     */
    public function getSurfaceTerrain()
    {
        return $this->surfaceTerrain;
    }

    /**
     * @param int $surfaceTerrain
     * @return Offer
     */
    public function setSurfaceTerrain($surfaceTerrain)
    {
        $this->surfaceTerrain = $surfaceTerrain;
        return $this;
    }

    /**
     * @return int
     */
    public function getTerrasse()
    {
        return $this->terrasse;
    }

    /**
     * @param int $terrasse
     * @return Offer
     */
    public function setTerrase($terrasse)
    {
        $this->terrasse = $terrasse;
        return $this;
    }

    /**
     * @return int
     */
    public function getBalcon()
    {
        return $this->balcon;
    }

    /**
     * @param int $balcon
     * @return Offer
     */
    public function setBalcon($balcon)
    {
        $this->balcon = $balcon;
        return $this;
    }

    /**
     * @return int
     */
    public function getGarden()
    {
        return $this->garden;
    }

    /**
     * @param int $garden
     * @return Offer
     */
    public function setGarden($garden)
    {
        $this->garden = $garden;
        return $this;
    }

    /**
     * @return int
     */
    public function getVeranda()
    {
        return $this->veranda;
    }

    /**
     * @param int $veranda
     * @return Offer
     */
    public function setVeranda($veranda)
    {
        $this->veranda = $veranda;
        return $this;
    }

    /**
     * @return int
     */
    public function getLoggia()
    {
        return $this->loggia;
    }

    /**
     * @param int $loggia
     * @return Offer
     */
    public function setLoggia($loggia)
    {
        $this->loggia = $loggia;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSwimmingPool()
    {
        return $this->swimmingPool;
    }

    /**
     * @param bool $swimmingPool
     * @return Offer
     */
    public function setSwimmingPool($swimmingPool)
    {
        $this->swimmingPool = $swimmingPool;
        return $this;
    }

    /**
     * @return int
     */
    public function getAttic()
    {
        return $this->attic;
    }

    /**
     * @param int $attic
     * @return Offer
     */
    public function setAttic($attic)
    {
        $this->attic = $attic;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBuanderie()
    {
        return $this->buanderie;
    }

    /**
     * @param bool $buanderie
     * @return Offer
     */
    public function setBuanderie($buanderie)
    {
        $this->buanderie = $buanderie;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRenovated()
    {
        return $this->renovated;
    }

    /**
     * @param bool $renovated
     * @return Offer
     */
    public function setRenovated($renovated)
    {
        $this->renovated = $renovated;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMeuble()
    {
        return $this->meuble;
    }

    /**
     * @param bool $meuble
     * @return Offer
     */
    public function setMeuble($meuble)
    {
        $this->meuble = $meuble;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPet()
    {
        return $this->pet;
    }

    /**
     * @param bool $pet
     * @return Offer
     */
    public function setPet($pet)
    {
        $this->pet = $pet;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCaveVin()
    {
        return $this->caveVin;
    }

    /**
     * @param bool $caveVin
     * @return Offer
     */
    public function setCaveVin($caveVin)
    {
        $this->caveVin = $caveVin;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbrFloor()
    {
        return $this->nbrFloor;
    }

    /**
     * @param int $nbtFloor
     * @return Offer
     */
    public function setNbrFloor($nbtFloor)
    {
        $this->nbrFloor = $nbtFloor;
        return $this;
    }

    /**
     * @return string
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * @param string $floor
     * @return Offer
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;
        return $this;
    }

    /**
     * @return bool
     */
    public function isLastFloor()
    {
        return $this->lastFloor;
    }

    /**
     * @param bool $lastFloor
     * @return Offer
     */
    public function setLastFloor($lastFloor)
    {
        $this->lastFloor = $lastFloor;
        return $this;
    }

    /**
     * @return int
     */
    public function getExternalParking()
    {
        return $this->externalParking;
    }

    /**
     * @param int $externalParking
     * @return Offer
     */
    public function setExternalParking($externalParking)
    {
        $this->externalParking = $externalParking;
        return $this;
    }

    /**
     * @return int
     */
    public function getInternalParking()
    {
        return $this->internalParking;
    }

    /**
     * @param int $internalParking
     * @return Offer
     */
    public function setInternalParking($internalParking)
    {
        $this->internalParking = $internalParking;
        return $this;
    }

    /**
     * @return int
     */
    public function getGarage()
    {
        return $this->garage;
    }

    /**
     * @param int $garage
     * @return Offer
     */
    public function setGarage($garage)
    {
        $this->garage = $garage;
        return $this;
    }

    /**
     * @return bool
     */
    public function isLift()
    {
        return $this->lift;
    }

    /**
     * @param bool $lift
     * @return Offer
     */
    public function setLift($lift)
    {
        $this->lift = $lift;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAntenna()
    {
        return $this->antenna;
    }

    /**
     * @param bool $antenna
     * @return Offer
     */
    public function setAntenna($antenna)
    {
        $this->antenna = $antenna;
        return $this;
    }

    /**
     * @return bool
     */
    public function isVoletsRoul()
    {
        return $this->voletsRoul;
    }

    /**
     * @param bool $voletsRoul
     * @return Offer
     */
    public function setVoletsRoul($voletsRoul)
    {
        $this->voletsRoul = $voletsRoul;
        return $this;
    }

    /**
     * @return bool
     */
    public function isVoletsElec()
    {
        return $this->voletsElec;
    }

    /**
     * @param bool $voletsElec
     * @return Offer
     */
    public function setVoletsElec($voletsElec)
    {
        $this->voletsElec = $voletsElec;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHandicape()
    {
        return $this->handicape;
    }

    /**
     * @param bool $handicape
     * @return Offer
     */
    public function setHandicape($handicape)
    {
        $this->handicape = $handicape;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPorteBlindee()
    {
        return $this->porteBlindee;
    }

    /**
     * @param bool $porteBlindee
     * @return Offer
     */
    public function setPorteBlindee($porteBlindee)
    {
        $this->porteBlindee = $porteBlindee;
        return $this;
    }

    /**
     * @return bool
     */
    public function isParlophone()
    {
        return $this->parlophone;
    }

    /**
     * @param bool $parlophone
     * @return Offer
     */
    public function setParlophone($parlophone)
    {
        $this->parlophone = $parlophone;
        return $this;
    }

    /**
     * @return bool
     */
    public function isVideophone()
    {
        return $this->videophone;
    }

    /**
     * @param bool $videophone
     * @return Offer
     */
    public function setVideophone($videophone)
    {
        $this->videophone = $videophone;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDigicode()
    {
        return $this->digicode;
    }

    /**
     * @param bool $digicode
     * @return Offer
     */
    public function setDigicode($digicode)
    {
        $this->digicode = $digicode;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAlarme()
    {
        return $this->alarme;
    }

    /**
     * @param bool $alarme
     * @return Offer
     */
    public function setAlarme($alarme)
    {
        $this->alarme = $alarme;
        return $this;
    }

    /**
     * @return string
     */
    public function getEnergy()
    {
        return $this->energy;
    }

    /**
     * @param string $energy
     * @return Offer
     */
    public function setEnergy($energy)
    {
        $this->energy = $energy;
        return $this;
    }

    /**
     * @return string
     */
    public function getEnergyValue()
    {
        return $this->energyValue;
    }

    /**
     * @param string $energyValue
     * @return Offer
     */
    public function setEnergyValue($energyValue)
    {
        $this->energyValue = $energyValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getGes()
    {
        return $this->ges;
    }

    /**
     * @param string $ges
     * @return Offer
     */
    public function setGes($ges)
    {
        $this->ges = $ges;
        return $this;
    }

    /**
     * @return string
     */
    public function getGesValue()
    {
        return $this->gesValue;
    }

    /**
     * @param string $gesValue
     * @return Offer
     */
    public function setGesValue($gesValue)
    {
        $this->gesValue = $gesValue;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDpeInProgress()
    {
        return $this->dpeInProgress;
    }

    /**
     * @param bool $dpeInProgress
     * @return Offer
     */
    public function setDpeInProgress($dpeInProgress)
    {
        $this->dpeInProgress = $dpeInProgress;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDpeNotApplicable()
    {
        return $this->dpeNotApplicable;
    }

    /**
     * @param bool $dpeNotApplicable
     * @return Offer
     */
    public function setDpeNotApplicable($dpeNotApplicable)
    {
        $this->dpeNotApplicable = $dpeNotApplicable;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDpeVirgin()
    {
        return $this->dpeVirgin;
    }

    /**
     * @param bool $dpeVirgin
     * @return Offer
     */
    public function setDpeVirgin($dpeVirgin)
    {
        $this->dpeVirgin = $dpeVirgin;
        return $this;
    }

    /**
     * @return bool
     */
    public function isGaz()
    {
        return $this->gaz;
    }

    /**
     * @param bool $gaz
     * @return Offer
     */
    public function setGaz($gaz)
    {
        $this->gaz = $gaz;
        return $this;
    }

    /**
     * @return bool
     */
    public function isElec()
    {
        return $this->elec;
    }

    /**
     * @param bool $elec
     * @return Offer
     */
    public function setElec($elec)
    {
        $this->elec = $elec;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFuel()
    {
        return $this->fuel;
    }

    /**
     * @param bool $fuel
     * @return Offer
     */
    public function setFuel($fuel)
    {
        $this->fuel = $fuel;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCollectif()
    {
        return $this->collectif;
    }

    /**
     * @param bool $collectif
     * @return Offer
     */
    public function setCollectif($collectif)
    {
        $this->collectif = $collectif;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCharbon()
    {
        return $this->charbon;
    }

    /**
     * @param bool $charbon
     * @return Offer
     */
    public function setCharbon($charbon)
    {
        $this->charbon = $charbon;
        return $this;
    }

    /**
     * @return bool
     */
    public function isGranules()
    {
        return $this->granules;
    }

    /**
     * @param bool $granules
     * @return Offer
     */
    public function setGranules($granules)
    {
        $this->granules = $granules;
        return $this;
    }

    /**
     * @return bool
     */
    public function isClim()
    {
        return $this->clim;
    }

    /**
     * @param bool $clim
     * @return Offer
     */
    public function setClim($clim)
    {
        $this->clim = $clim;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCheminee()
    {
        return $this->cheminee;
    }

    /**
     * @param bool $cheminee
     * @return Offer
     */
    public function setCheminee($cheminee)
    {
        $this->cheminee = $cheminee;
        return $this;
    }

    /**
     * @return bool
     */
    public function isInsertHeat()
    {
        return $this->insertHeat;
    }

    /**
     * @param bool $insertHeat
     * @return Offer
     */
    public function setInsertHeat($insertHeat)
    {
        $this->insertHeat = $insertHeat;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCentral()
    {
        return $this->central;
    }

    /**
     * @param bool $central
     * @return Offer
     */
    public function setCentral($central)
    {
        $this->central = $central;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRadiateur()
    {
        return $this->radiateur;
    }

    /**
     * @param bool $radiateur
     * @return Offer
     */
    public function setRadiateur($radiateur)
    {
        $this->radiateur = $radiateur;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCollectiveWater()
    {
        return $this->collectiveWater;
    }

    /**
     * @param bool $collectiveWater
     * @return Offer
     */
    public function setCollectiveWater($collectiveWater)
    {
        $this->collectiveWater = $collectiveWater;
        return $this;
    }

    /**
     * @return bool
     */
    public function isGazWater()
    {
        return $this->gazWater;
    }

    /**
     * @param bool $gazWater
     * @return Offer
     */
    public function setGazWater($gazWater)
    {
        $this->gazWater = $gazWater;
        return $this;
    }

    /**
     * @return bool
     */
    public function isElecWater()
    {
        return $this->elecWater;
    }

    /**
     * @param bool $elecWater
     * @return Offer
     */
    public function setElecWater($elecWater)
    {
        $this->elecWater = $elecWater;
        return $this;
    }



}
