<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\Author\CreateProjectRequest;
use App\Service\AuthorService;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Model\ErrorResponse;
use App\Model\IdResponse;

class AuthorController extends AbstractController
{
    public function __construct(private AuthorService $authorService)
    {
    }

    /**
     * @OA\Tag(name="Author API")
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе"
     * )
     */
    #[Security(name: 'Bearer')]
    #[Route(path: '/api/v1/author/project', methods: ['GET'])]
    public function projects(): Response
    {
        return $this->json($this->authorService->getProjects());
    }

    /**
     * @OA\Tag(name="Author API")
     *
     * @OA\RequestBody(@Model(type=CreateProjectRequest::class))
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе",
     *     @Model(type=IdResponse::class)
     * )
     * @OA\Response(
     *     response="400",
     *     description="Возвращает при неуспешном запросе",
     *     @Model(type=ErrorResponse::class)
     * )
     *
     *
     * @param CreateProjectRequest $request
     * @return Response
     */
    #[Route(path: '/api/v1/author/project', methods: ['POST'])]
    public function createProject(#[RequestBody] CreateProjectRequest $request): Response
    {
        return $this->json($this->authorService->createProject($request));
    }

    /**
     * @OA\Tag(name="Author API")
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе"
     * )
     * @OA\Response(
     *     response=404,
     *     description="Возвращает при отсутствии записи",
     *     @Model(type=ErrorResponse::class)
     * )
     *
     * @param int $id
     * @return Response
     */
    #[Route(path: '/api/v1/author/project/{id}', methods: ['DELETE'])]
    public function deleteProject(int $id): Response
    {
        $this->authorService->deleteProject($id);

        return $this->json(['Запись с id: ' . $id . ' удалена'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
