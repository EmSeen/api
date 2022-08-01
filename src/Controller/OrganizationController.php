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
    public function __construct(private OrganizationService $organizationService)
    {
    }

    /**
     * Создание организаций.
     *
     * @OA\Tag(name="Organization")
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
     * @param OrganizationRequest $organizationRequest
     * @return Response
     */
    #[Route(path: '/api/v1/createOrganization', methods: ['POST'])]
    public function createOrganization(#[RequestBody] OrganizationRequest $organizationRequest): Response
    {
        $this->organizationService->newOrganization($organizationRequest);

        return $this->json('Создана запись '.$organizationRequest)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * Список организаций.
     *
     * @OA\Tag(name="Organization")
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе",
     *     @Model(type=OrganizationListResponse::class)
     * )
     */
    #[Route(path: '/api/v1/listOrganizations', methods: ['GET'])]
    public function listOrganizations(): Response
    {
        $response = $this->json($this->organizationService->getOrganizations());
        $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);

        return $response;
    }

    /**
     * Просмотр организации.
     *
     * @OA\Tag(name="Organization")
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
    public function showOrganization(int $id): Response
    {
        return $this->json($this->organizationService->getOrganization($id))->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
