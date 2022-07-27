<?php

namespace App\Tests\Service;

use App\Entity\Organizations;
use App\Model\OrganizationsListItems;
use App\Model\OrganizationsListResponse;
use App\Repository\OrganizationsRepository;
use App\Service\OrganizationsService;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;

class OrganizationsServiceTest extends TestCase
{

    public function testGetOrganizations()
    {
        //Создание зависимостей в виде мока, задание им повидения
        $repository = $this->createMock(OrganizationsRepository::class);
        $repository->expects($this->once())
            ->method('findBy')
            ->with([], ['name' => Criteria::ASC])
            ->willReturn([(new Organizations())->setId(7)->setName('Test')->setDesigner('test')]);

        //Создание реального кдасса
        $service = new OrganizationsService($repository);
        //Создние ожидаемого результата
        $expected = new OrganizationsListResponse([new OrganizationsListItems('7', 'Test', 'test')]);

        //Сравнение с фактическим результатом
        $this->assertEquals($expected, $service->getOrganizations());
    }
}
