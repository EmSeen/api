<?php


namespace App\Controller;


use App\Service\OrganizationsService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\OrganizationsListResponse;
use OpenApi\Annotations as OA;

class OrganizationsController extends AbstractController
{
    public function __construct(private OrganizationsService $organizationsService)
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns book categories",
     *     @Model(type=OrganizationsListResponse::class)
     * )
     */
    #[Route(path: '/api/v1/organizations', methods: ['GET'])]
    public function organizations(): Response
    {
        $response = $this->json($this->organizationsService->getOrganizations());
        $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        return $response;
    }

}
