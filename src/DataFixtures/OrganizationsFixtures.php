<?php

namespace App\DataFixtures;

use App\Entity\Organizations;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrganizationsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist((new Organizations())->setName('Первое')->setDesigner('Азат')->setEmployees('test'));
        $manager->persist((new Organizations())->setName('Второе')->setDesigner('Булат')->setEmployees('test'));
        $manager->persist((new Organizations())->setName('Третье')->setDesigner('Рамиль')->setEmployees('test'));

        $manager->flush();
    }
}
