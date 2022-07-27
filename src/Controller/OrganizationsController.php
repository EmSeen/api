<?php


namespace App\Controller;


use App\Entity\Organizations;
use App\Form\OrganizationsType;
use App\Service\OrganizationsService;
use App\Model\OrganizationsListResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use Doctrine\Persistence\ManagerRegistry;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrganizationsController extends AbstractController
{
    public function __construct(private OrganizationsService $organizationsService)
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при успехе",
     *     @Model(type=OrganizationsListResponse::class)
     * )
     * @OA\Tag(name="getOrganizations")
     */
    #[Route(path: '/api/v1/getOrganizations', methods: ['GET'])]
    public function getOrganizations(): Response
    {
        $response = $this->json($this->organizationsService->getOrganizations());
        $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        return $response;
    }

    /**

     * @OA\Parameter(name="form", in="query", description="Page number", @Model(type=OrganizationsType::class))

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
     *     @Model(type=OrganizationsListResponse::class)
     *     )
     * )
     * @OA\Tag(name="postOrganizations")
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @return Response
     */
    #[Route(path: '/api/v1/postOrganizations', methods: ['POST'])]
    public function postOrganizations(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $project = new Organizations();

        $form = $this->createForm(OrganizationsType::class, $project);
        $form->submit($request->request->all());

        $project->setName($request->query->get('name', 'name2'));
        $project->setDesigner($request->query->get('description', 'description2'));

        $entityManager->persist($project);
        $entityManager->flush();

        return $this->json('Создана новая запись с id: ' . $project->getId());
    }

}
