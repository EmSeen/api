<?php

namespace App\DataFixtures;

use App\Entity\Organizations;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrganizationsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $manager->persist((new Organizations())->setName('Первое')->setDesigner('Азат'));
         $manager->persist((new Organizations())->setName('Второе')->setDesigner('Булат'));
         $manager->persist((new Organizations())->setName('Третье')->setDesigner('Рамиль'));

        $manager->flush();
    }
}
