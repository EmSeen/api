<?php

namespace App\Repository;

use App\Entity\Organizations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Organizations>
 *
 * @method Organizations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Organizations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Organizations[]    findAll()
 * @method Organizations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrganizationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Organizations::class);
    }

    /**
     * @return Organizations[]
     */
    public function findAllSortedByName(): array
    {
        return $this->findBy([], ['name' => Criteria::ASC]);
    }
}