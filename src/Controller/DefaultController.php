<?php

namespace App\Controller;

use App\Entity\Projects;
use App\Repository\ProjectsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    public function __construct(private ProjectsRepository $projectsRepository, private EntityManagerInterface $em)
    {

    }
    #[Route('/newProject')]
    public function newProject(): Response
    {
        $project = new Projects();
        $project->setName('vbvb');
        $project->setDescription('vbvb');

        $this->em->persist($project);
        $this->em->flush();

        return new Response();
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
