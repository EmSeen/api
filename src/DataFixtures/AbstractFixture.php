<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AbstractFixture extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $hasher,
                                private EntityManagerInterface $em)
    {
    }

    #[Pure] protected function randomEmail($length = 10): string
    {
        $string = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
        return $string . '@mail.ru';
    }

    protected function createTestUser(string $email, string $password, string $username = 'test', array $roles = ['ROLE_USER']): User
    {
        $user = (new User())
            ->setRoles($roles)
            ->setLastName($username)
            ->setFirstName($username)
            ->setEmail($email);

        $user->setPassword($this->hasher->hashPassword($user, $password));

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function load(ObjectManager $manager)
    {
    }
}
