<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 * @UniqueEntity("title")
 */
class Property
{
    const HEAT = [
        0 => 'Électrique',
        1 => 'Gaz'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 5,
     *      max = 250
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 10,
     *      max = 400
     * )
     */
    private $surface;

    /**
     * @ORM\Column(type="integer")
     */
    private $rooms;

    /**
     * @ORM\Column(type="integer")
     */
    private $bedrooms;

    /**
     * @ORM\Column(type="integer")
     */
    private $floor;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $heat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/[0-9]{5}$/")
     */
    private $postal_code;

    /**
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $sold = false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Option", inversedBy="properties")
     */
    private $options;
    
    public function __construct() {
        $this->created_at = new \DateTime();
        $this->options = new ArrayCollection();
        //$this->sold = false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }
    
    public function getSlug()
    {
        return (new Slugify())->slugify($this->getTitle());
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    public function getSurface()
    {
        return $this->surface;
    }

    public function setSurface(int $surface)
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRooms()
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms)
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBedrooms()
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms)
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getFloor()
    {
        return $this->floor;
    }

    public function setFloor(int $floor)
    {
        $this->floor = $floor;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }
     
    
    public function setPrice(int $price)
    {
        $this->price = $price;

        return $this;
    }
    
    public function getFormatPrice()
    {
        return number_format($this->getPrice(), 0, '', ' ');
    }
    
    public function getHeat()
    {
        return $this->heat;
    }

    public function setHeat(int $heat)
    {
        $this->heat = $heat;

        return $this;
    }

    public function getHeatType ()
    {
        return self::HEAT[$this->heat];

    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity(string $city)
    {
        $this->city = $city;

        return $this;
    }

    public function getAdress()
    {
        return $this->adress;
    }

    public function setAdress(string $adress)
    {
        $this->adress = $adress;

        return $this;
    }

    public function getPostalCode()
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code)
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getSold(): bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold)
    {
        $this->sold = $sold;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|Option[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $option->addProperty($this);
        }

        return $this;
    }

    public function removeOption(Option $option): self
    {
        if ($this->options->contains($option)) {
            $this->options->removeElement($option);
            $option->removeProperty($this);
        }

        return $this;
    }
}
