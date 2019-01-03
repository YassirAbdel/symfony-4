<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
class PropertySearch {
    
    /**
     * @var int|null
     */
    private $maxPrice;
    
    /**
     * @Assert\Range(min=10, max=400)
     * @var int|null
     */
    private $minSurface;
    
    /**
     * @var ArrayCollection
     */
    private $options;
    
    /**
     * 
     * @return int|null
     */
    public function getMaxPrice() 
    {
        return $this->maxPrice;
    }
    
    function __construct() {
        $this->options = new ArrayCollection();
    }

    /**
     * @param int|null $maxPrice
     * @return \App\Entity\PropertySearch
     */
    public function setMaxPrice(int $maxPrice) : PropertySearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }
    
    /**
     * @return int|null
     */
    public function getMinSurface()
    {
        return $this->minSurface;
    }
    
    /**
     * @param int|null $minSurface
     * @return \App\Entity\PropertySearch
     */
    
    public function setMinSurface(int $minSurface) : PropertySearch
    {
        $this->minSurface = $minSurface;
        return $this;
    }
    
    /**
     * @return ArrayCollection
     */
    public function getOptions() 
    {
        return  $this->options;
    }
    
    /**
     * @param ArrayCollection $options
     */
    function setOptions(ArrayCollection $options): void
    {
        $this->options = $options;
    }
    
}

