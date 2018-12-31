<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

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
     * 
     * @return int|null
     */
    public function getMaxPrice() 
    {
        return $this->maxPrice;
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
}

