<?php

namespace App\Controller;

use App\Entity\Projects;
use App\Form\ProjectsType;
use App\Model\ProjectsListResponse;
use App\Service\ProjectsService;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{
    public function __construct(private ProjectsService $projectsService)
    {
    }

    /**
     * Создание проектов.
     *
     * @OA\Tag(name="Projects")
     *
     * @OA\Parameter(name="form", in="query", description="Projects Type", @Model(type=ProjectsType::class))
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе",
     *     @Model(type=ProjectsListResponse::class)
     *     )
     * ),
     * @OA\Response(
     *     response=422,
     *     description="Возвращает при неуспешном запросе",
     *     @Model(type=ProjectsListResponse::class)
     *     )
     * ),
     * @OA\Response(
     *     response=404,
     *     description="Возвращает при отсутствии записи",
     *     @Model(type=ProjectsListResponse::class)
     *     )
     * )
     *
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    #[Route(path: '/api/v1/newProjects', methods: ['POST'])]
    public function new(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $project = new Projects();

        $req = $request->request->count();
        if (0 === $req) {
            $project->setName($request->query->get('name'));
            $project->setDescription($request->query->get('description'));
            $project->setStartDate(new DateTime($request->query->get('startDate')));
            $project->setEndDate(new DateTime($request->query->get('endDate')));
        } else {
            $project->setName($request->request->get('name'));
            $project->setDescription($request->request->get('description'));
            $project->setStartDate(new DateTime($request->request->get('startDate')));
            $project->setEndDate(new DateTime($request->request->get('endDate')));
        }

        $entityManager->persist($project);
        $entityManager->flush();

        return $this->json('Создана новая запись с id: '.$project->getId())->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * Список проектов.
     *
     * @OA\Tag(name="Projects")
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе",
     *     @Model(type=ProjectsListResponse::class)
     * )
     */
    #[Route(path: '/api/v1/listProjects', methods: ['GET'])]
    public function list(): Response
    {
        $project = $this->json($this->projectsService->getProjects());
        $project->setEncodingOptions(JSON_UNESCAPED_UNICODE);

        return $project;
    }

    /**
     * Просмотр проекта.
     *
     * @OA\Tag(name="Projects")
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе",
     *     @Model(type=ProjectsListResponse::class)
     * )
     * @OA\Response(
     *     response=422,
     *     description="Возвращает при неуспешном запросе",
     *     @Model(type=ProjectsListResponse::class)
     *     )
     * ),
     * @OA\Response(
     *     response=404,
     *     description="Возвращает при отсутствии записи",
     *     @Model(type=ProjectsListResponse::class)
     *     )
     * )
     * @param int $id
     * @return Response
     */
    #[Route(path: '/api/v1/showProjects/{id}', methods: ['GET'])]
    public function show(int $id): Response
    {
        $project = $this->json($this->projectsService->getProject($id));
        $project->setEncodingOptions(JSON_UNESCAPED_UNICODE);

        return $project;
    }
}
