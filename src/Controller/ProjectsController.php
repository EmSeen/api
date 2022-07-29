<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\ErrorResponse;
use App\Model\ProjectRequest;
use App\Model\ProjectsListResponse;
use App\Service\ProjectsService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{
    public function __construct(private ProjectsService $projectsService)
    {
    }

    /**
     * Создание проекта.
     *
     * @OA\Tag(name="Projects")
     *
     * @OA\RequestBody(@Model(type=ProjectRequest::class))
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе",
     *     @Model(type=ProjectRequest::class)
     *     )
     * ),
     * @OA\Response(
     *     response=400,
     *     description="Возвращает при неуспешном запросе",
     *     @Model(type=ErrorResponse::class)
     *     )
     * )
     *
     * @param ProjectRequest $projectRequest
     * @return Response
     */
    #[Route(path: '/api/v1/newProject', methods: ['POST'])]
    public function new(#[RequestBody] ProjectRequest $projectRequest): Response
    {
        $this->projectsService->newProject($projectRequest);
        return $this->json('Создана запись ' . $projectRequest)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
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
     *
     * @return Response
     */
    #[Route(path: '/api/v1/listProjects', methods: ['GET'])]
    public function list(): Response
    {
        return $this->json($this->projectsService->getProjects())->setEncodingOptions(JSON_UNESCAPED_UNICODE);
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
     *
     * @param int $id
     * @return Response
     */
    #[Route(path: '/api/v1/showProject/{id}', methods: ['GET'])]
    public function show(int $id): Response
    {
        return $this->json($this->projectsService->getProject($id))->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
