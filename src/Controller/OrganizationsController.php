<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Entity\Organizations;
use App\Form\OrganizationsType;
use App\Model\OrganizationsListResponse;
use App\Model\ErrorResponse;
use App\Model\OrganizationsRequest;
use App\Service\OrganizationsService;
use Doctrine\Persistence\ManagerRegistry;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrganizationsController extends AbstractController
{
    public function __construct(private OrganizationsService $organizationsService)
    {
    }

    /**
     * Создание организаций.
     *
     * @OA\Tag(name="Organizations")
     *
     * @OA\RequestBody(@Model(type=OrganizationsRequest::class))
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе",
     *     @Model(type=OrganizationsRequest::class)
     *     )
     * ),
     * @OA\Response(
     *     response=422,
     *     description="Возвращает при неуспешном запросе",
     *     @Model(type=ErrorResponse::class)
     *     )
     * )
     * @param OrganizationsRequest $organizationsRequest
     * @return Response
     */
    #[Route(path: '/api/v1/newOrganization', methods: ['POST'])]
    public function new(#[RequestBody] OrganizationsRequest $organizationsRequest): Response
    {
        $this->organizationsService->newOrganization($organizationsRequest);
        return $this->json('Создана запись ' . $organizationsRequest)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * Список организаций.
     *
     * @OA\Tag(name="Organizations")
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе",
     *     @Model(type=OrganizationsListResponse::class)
     * )
     */
    #[Route(path: '/api/v1/listOrganizations', methods: ['GET'])]
    public function list(): Response
    {
        $response = $this->json($this->organizationsService->getOrganizations());
        $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);

        return $response;
    }
}
