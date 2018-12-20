<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    
    public function getRoles () 
    {
        return ['ROLE_ADMIN'];
    }
    
    public function getSalt() 
    {
        return null;
    }
    
    public function eraseCredentials() 
    {
    }
    
    // tranforme l'objet en chaîne
    public function serialize() 
    {
        // les infos conserves d'un user
        serialize([
           $this->id,
           $this->username,
           $this->password
        ]);
    }  
    
    
    // prendre cette chaîne et la transformer en objet
    public function unserialize($serialized)
    {
        // les infos pour fabriquer un ser
        list (
            $this->id,
            $this->username,
            $this->password
            // on passe en parametre les infos qui ont été serializées et ne pas instancier les class  
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }
    
}
