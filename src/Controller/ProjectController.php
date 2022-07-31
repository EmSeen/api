<?php

namespace App\Controller;

use App\Model\ErrorResponse;
use App\Model\ProjectListResponse;
use App\Service\ProjectService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    public function __construct(private ProjectService $projectService)
    {
    }
    
    /**
     * Список проектов.
     *
     * @OA\Tag(name="Project")
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе",
     *     @Model(type=ProjectListResponse::class)
     * )
     */
    #[Route(path: '/api/v1/listProjects', methods: ['GET'])]
    public function list(): Response
    {
        return $this->json($this->projectService->getProjects())->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * Просмотр проекта.
     *
     * @OA\Tag(name="Project")
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе",
     *     @Model(type=ProjectListResponse::class)
     * ),
     * @OA\Response(
     *     response=404,
     *     description="Возвращает при отсутствии записи",
     *     @Model(type=ErrorResponse::class)
     *     )
     * )
     * @param int $id
     * @return Response
     */
    #[Route(path: '/api/v1/showProject/{id}', methods: ['GET'])]
    public function show(int $id): Response
    {
        return $this->json($this->projectService->getProject($id))->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
