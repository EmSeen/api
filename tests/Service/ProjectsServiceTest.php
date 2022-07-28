<?php

namespace App\Tests\Service;

use App\Exception\ProjectNotFoundException;
use App\Repository\ProjectsRepository;
use App\Service\ProjectsService;
use App\Tests\AbstractTestCase;

class ProjectsServiceTest extends AbstractTestCase
{
    public function testGetProjectNotFound(): void
    {
        $projectsRepository = $this->createMock(ProjectsRepository::class);
        $projectsRepository->expects($this->once())
            ->method('find')
            ->with(11)
            ->willThrowException(new ProjectNotFoundException());

        $this->expectException(ProjectNotFoundException::class);

        (new ProjectsService($projectsRepository))->getProject('11');
    }

//    public function testGetProjectsById()
//    {
//        $projectsRepository = $this->createMock(ProjectsRepository::class);
//        $projectsRepository->expects($this->once())
//            ->method('findProjectsById')
//            ->with(11)
//            ->willReturn($this->createProjectsEntity());
//
//        //Создание реального кдасса
//        $service = new ProjectsService($projectsRepository);
//        $expected = new ProjectsListResponse([$this->createProjectsItemModel()]);
//
//        //Сравнение с фактическим результатом
//        $this->assertEquals($expected, $service->getProject(11));
//    }
//
//    private function createProjectsEntity() : Projects
//    {
//        //Создние ожидаемого результата
//        return (new Projects())
//            ->setId(11)
//            ->setName('Test')
//            ->setDescription('test')
//            ->setStartDate(new DateTime('2022-12-12'))
//            ->setEndDate(new DateTime('2022-12-12'));
//    }
//
//    private function createProjectsItemModel() : ProjectsListItems
//    {
//        //Создние ожидаемого результата
//        return (new ProjectsListItems())
//            ->setId(11)
//            ->setName('Test')
//            ->setDescription('test')
//            ->setStartDate(new DateTime('2022-12-12'))
//            ->setEndDate(new DateTime('2022-12-12'));
//    }

}
