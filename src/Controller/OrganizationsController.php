<?php

namespace App\Controller;

use App\Entity\Organizations;
use App\Form\OrganizationsType;
use App\Model\OrganizationsListResponse;
use App\Model\ErrorResponse;
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
     * @OA\Parameter(name="form", in="query", description="Page number", @Model(type=OrganizationsType::class))
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе",
     *     @Model(type=OrganizationsListResponse::class)
     *     )
     * ),
     * @OA\Response(
     *     response=422,
     *     description="Возвращает при неуспешном запросе",
     *     @Model(type=OrganizationsListResponse::class)
     *     )
     * ),
     * @OA\Response(
     *     response=404,
     *     description="Возвращает при отсутствии записи",
     *     @Model(type=ErrorResponse::class)
     *     )
     * )
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @return Response
     */
    #[Route(path: '/api/v1/newOrganizations', methods: ['POST'])]
    public function new(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $organizations = new Organizations();

//        $form = $this->createForm(OrganizationsType::class, $organizations);
//        $form->submit($request->request->all());

        $req = $request->request->count();
        if (0 === $req) {
            $organizations->setName($request->query->get('name'));
            $organizations->setDesigner($request->query->get('designer'));
        } else {
            $organizations->setName($request->request->get('name'));
            $organizations->setDesigner($request->request->get('designer'));
        }

        $entityManager->persist($organizations);
        $entityManager->flush();

        return $this->json('Создана новая запись с id: '.$organizations->getId());
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
     * @OA\Response(
     *     response=404,
     *     description="Возвращает при отсутствии записи",
     *     @Model(type=ErrorResponse::class)
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
