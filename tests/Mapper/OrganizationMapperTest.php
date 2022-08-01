<?php

namespace App\Tests\Mapper;

use App\Entity\Organization;
use App\Mapper\OrganizationMapper;
use App\Model\OrganizationListItems;
use App\Tests\AbstractTestCase;

class OrganizationMapperTest extends AbstractTestCase
{
    public function testMap()
    {
        $organization = (new Organization())
            ->setName('test')
            ->setDesigner('test')
            ->setEmployees('test')
        ;

        $this->setEntityId($organization, 1);

        $expected = (new OrganizationListItems())
            ->setId(1)
            ->setName('test')
            ->setDesigner('test')
            ->setEmployees('test')
        ;

        $this->assertEquals($expected, OrganizationMapper::map($organization, new OrganizationListItems()));
    }
}
