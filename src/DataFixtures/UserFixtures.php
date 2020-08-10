<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface  $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('admin@philosofy.com');
        $user->setPassword($this->encoder->encodePassword($user, 'password'));
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(new \DateTime());
        $user->setFirstname('admin');
        $user->setLastname('admin');
        $user->setRole('ROLE_ADMIN');
        $user->setUsername('admin');

        $manager->persist($user);
        $manager->flush();
    }
}