<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\ErrorResponse;
use App\Model\OrganizationListResponse;
use App\Model\OrganizationRequest;
use App\Service\OrganizationService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrganizationController extends AbstractController
{
    public function __construct(private OrganizationService $organizationsService)
    {
    }

    /**
     * Создание организаций.
     *
     * @OA\Tag(name="Organizations")
     *
     * @OA\RequestBody(@Model(type=OrganizationRequest::class))
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе",
     *     @Model(type=OrganizationRequest::class)
     *     )
     * ),
     * @OA\Response(
     *     response=422,
     *     description="Возвращает при неуспешном запросе",
     *     @Model(type=ErrorResponse::class)
     *     )
     * )
     *
     * @param OrganizationRequest $organizationsRequest
     * @return Response
     */
    #[Route(path: '/api/v1/newOrganization', methods: ['POST'])]
    public function new(#[RequestBody] OrganizationRequest $organizationsRequest): Response
    {
        $this->organizationsService->newOrganization($organizationsRequest);

        return $this->json('Создана запись '.$organizationsRequest)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * Список организаций.
     *
     * @OA\Tag(name="Organizations")
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе",
     *     @Model(type=OrganizationListResponse::class)
     * )
     */
    #[Route(path: '/api/v1/listOrganizations', methods: ['GET'])]
    public function list(): Response
    {
        $response = $this->json($this->organizationsService->getOrganizations());
        $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);

        return $response;
    }

    /**
     * Просмотр организации.
     *
     * @OA\Tag(name="Organizations")
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе",
     *     @Model(type=OrganizationListResponse::class)
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
    #[Route(path: '/api/v1/showOrganization/{id}', methods: ['GET'])]
    public function show(int $id): Response
    {
        return $this->json($this->organizationsService->getOrganization($id))->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
