<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture

{
    /**
     *
     * @var UserPasswordEncoder 
     */
    private $encoder;

    // on injecte la class Encoder des le contructeur qui implémente l'interface UserPasswordEncoder 
    public function __construct(UserPasswordEncoderInterface $encoder) 
    {
        // on initialise la propriété $encoder
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('demo');
        $user->setPassword($this->encoder->encodePassword($user, 'demo'));
        $manager->persist($user);
        $manager->flush();
    }
}
