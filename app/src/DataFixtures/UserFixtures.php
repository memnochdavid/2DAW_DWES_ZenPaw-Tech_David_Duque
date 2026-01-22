<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $users = [
            ['name' => 'David', 'email' => 'david@zenpaw.tech', 'password' => '1234'],
            ['name' => 'Pepe', 'email' => 'pepe@zenpaw.tech', 'password' => '1234'],
            ['name' => 'Admin', 'email' => 'admin@zenpaw.tech', 'password' => 'admin'],
        ];

        foreach ($users as $userData) {
            $user = new User();
            $user->setName($userData['name']);
            $user->setEmail($userData['email']);

            // Hash the password
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $userData['password']
            );
            $user->setPassword($hashedPassword);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
