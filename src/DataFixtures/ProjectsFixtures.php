<?php

namespace App\DataFixtures;

use App\Entity\Projects;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist((new Projects())->setName('Первое')->setDescription('Описание1')->setStartDate(new DateTime())->setEndDate(new DateTime()));
        $manager->persist((new Projects())->setName('Второе')->setDescription('Описание12')->setStartDate(new DateTime())->setEndDate(new DateTime()));
        $manager->persist((new Projects())->setName('Третье')->setDescription('Описание14')->setStartDate(new DateTime())->setEndDate(new DateTime()));

        $manager->flush();
    }
}
