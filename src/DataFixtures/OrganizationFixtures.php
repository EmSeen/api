<?php

namespace App\DataFixtures;

use App\Entity\Organization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrganizationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist((new Organization())->setName('Первое')->setDesigner('Азат')->setEmployees('test'));
        $manager->persist((new Organization())->setName('Второе')->setDesigner('Булат')->setEmployees('test'));
        $manager->persist((new Organization())->setName('Третье')->setDesigner('Рамиль')->setEmployees('test'));

        $manager->flush();
    }
}
