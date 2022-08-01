<?php

namespace App\Tests\Mapper;

use App\Entity\Project;
use App\Mapper\ProjectMapper;
use App\Model\ProjectDetails;
use App\Tests\AbstractTestCase;
use DateTime;

class ProjectMapperTest extends AbstractTestCase
{
    public function testMap(): void
    {
        $project = (new Project())
            ->setName('test')
            ->setDescription('testtest')
            ->setStartDate(new DateTime('2022-12-12'))
            ->setEndDate(new DateTime('2022-12-12'))
        ;

        $this->setEntityId($project, 1);

        $expected = (new ProjectDetails())
            ->setId(1)
            ->setName('test')
            ->setDescription('testtest')
            ->setStartDate(new DateTime('2022-12-12'))
            ->setEndDate(new DateTime('2022-12-12'))
        ;

        $this->assertEquals($expected, ProjectMapper::map($project, new ProjectDetails()));
    }
}
