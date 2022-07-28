<?php

namespace App\Repository;

use App\Entity\Projects;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Projects>
 *
 * @method Projects|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projects|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projects[]    findAll()
 * @method Projects[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Projects::class);
    }

    public function projectsList()
    {
        $query = $this->_em->createQuery('SELECT p FROM App\Entity\Projects p');

        return $query->getResult();
    }

    public function findProjectsById(int $id)
    {
        $query = $this->_em->createQuery('SELECT p FROM App\Entity\Projects p WHERE :id = p.id ');
        $query->setParameter('id', $id);

        return $query->getResult();
    }
}
