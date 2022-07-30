<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\SingUpRequest;
use App\Service\SignUpService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\ErrorResponse;

class AuthController extends AbstractController
{
    public function __construct(private SignUpService $signUpService)
    {
    }

    /**
     * Регистрация
     *
     * @OA\Tag(name="Регистрация")
     *
     * @OA\RequestBody(@Model(type=SingUpRequest::class))
     *
     * @OA\Response(
     *     response=200,
     *     description="Возвращает при провале",
     *     @OA\JsonContent(
     *     @OA\Property(property="token", type="string"),
     *     @OA\Property(property="refresh_token", type="string"))
     * ),
     * @OA\Response(
     *     response=409,
     *     description="Возвращает при провале",
     *     @Model(type=ErrorResponse::class)
     * ),
     * @OA\Response(
     *     response=400,
     *     description="Возвращает при успехе",
     *     @Model(type=ErrorResponse::class)
     * )
     * @param SingUpRequest $singUpRequest
     * @return Response
     */
    #[Route(path: '/api/v1/auth/signUp', methods: ['POST'])]
    public function action(#[RequestBody] SingUpRequest $singUpRequest): Response
    {
        return $this->signUpService->singUp($singUpRequest);
    }
}
