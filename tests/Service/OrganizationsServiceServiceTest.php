<?php

namespace App\Tests\Service;

use App\Entity\Organizations;
use App\Model\OrganizationsListItems;
use App\Model\OrganizationsListResponse;
use App\Repository\OrganizationsRepository;
use App\Service\OrganizationsService;
use App\Tests\AbstractServiceTest;

class OrganizationsServiceServiceTest extends AbstractServiceTest
{

    public function testGetOrganizations()
    {
        $org = (new Organizations())->setName('Test')->setDesigner('test');
        $this->setEntityId($org, 7);

        //Создание зависимостей в виде мока, задание им повидения
        $repository = $this->createMock(OrganizationsRepository::class);
        $repository->expects($this->once())
            ->method('findAllSortedByName')
            ->willReturn([$org]);

        //Создание реального кдасса
        $service = new OrganizationsService($repository);
        //Создние ожидаемого результата
        $expected = new OrganizationsListResponse([new OrganizationsListItems('7', 'Test', 'test')]);

        //Сравнение с фактическим результатом
        $this->assertEquals($expected, $service->getOrganizations());
    }

}
