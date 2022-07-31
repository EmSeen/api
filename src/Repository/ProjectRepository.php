<?php

namespace App\Repository;

use App\Entity\Project;
use App\Exception\ProjectNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends ServiceEntityRepository<Project>
 *
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function projectsList()
    {
        $query = $this->_em->createQuery('SELECT p FROM App\Entity\Project p');

        return $query->getResult();
    }

    public function findProjectById(int $id)
    {
        $query = $this->_em->createQuery('SELECT p FROM App\Entity\Project p WHERE :id = p.id ');
        $query->setParameter('id', $id);

        return $query->getResult();
    }

    public function existById(int $id): bool
    {
        return null !== $this->find($id);
    }

    /**
     * @return Project[]
     */
    public function findUserProjects(UserInterface $user): array
    {
        return $this->findBy(['user' => $user]);
    }

    public function getUserProjectsById(int $id, UserInterface $user): Project
    {
        $book = $this->findOneBy(['id' => $id, 'user' => $user]);
        if (null === $book) {
            throw new ProjectNotFoundException();
        }

        return $book;
    }

}
