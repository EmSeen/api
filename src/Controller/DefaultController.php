<?php

namespace App\Controller;

use App\Repository\ProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    public function __construct(private ProjectsRepository $projectsRepository)
    {

    }


    #[Route('/')]
    public function root(): Response
    {
        $project = $this->projectsRepository->findAll();
        return $this->json(
            $project
        );
    }

}
