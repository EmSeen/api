<?php

namespace App\Controller;

use App\Service\RoleService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use App\Model\ErrorResponse;

class AdminController extends AbstractController
{
    public function __construct(private RoleService $roleService)
    {
    }

    /**
     * @OA\Tag(name="Admin API")
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
     * @param int $userId
     * @return Response
     */
    #[Route(path: '/api/v1/admin/grantAuthor/{userId}', methods: ['POST'])]
    public function grantAuthor(int $userId): Response
    {
        $this->roleService->grantAuthor($userId);

        return $this->json('Роль у пользователя с id:' . $userId . ' изменена на ROLE_AUTHOR')->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
