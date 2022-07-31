<?php

namespace App\DataFixtures;

use App\Entity\Project;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist((new Project())->setName('Первое')->setDescription('Описание1')->setStartDate(new DateTime('2022-12-12'))->setEndDate(new DateTime('2022-12-12')));
        $manager->persist((new Project())->setName('Второе')->setDescription('Описание12')->setStartDate(new DateTime('2022-12-12'))->setEndDate(new DateTime('2022-12-12')));
        $manager->persist((new Project())->setName('Третье')->setDescription('Описание14')->setStartDate(new DateTime('2022-12-12'))->setEndDate(new DateTime('2022-12-12')));

        $manager->flush();
    }
}
