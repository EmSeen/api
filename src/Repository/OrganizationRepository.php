<?php

namespace App\Repository;

use App\Entity\Organization;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Organizations>
 *
 * @method Organization|null find($id, $lockMode = null, $lockVersion = null)
 * @method Organization|null findOneBy(array $criteria, array $orderBy = null)
 * @method Organization[]    findAll()
 * @method Organization[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrganizationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Organization::class);
    }

    /**
     * @return Organization[]
     */
    public function findAllSortedByName(): array
    {
        return $this->findBy([], ['name' => Criteria::ASC]);
    }

    public function organizationsList()
    {
        $query = $this->_em->createQuery('SELECT o FROM App\Entity\Organizations o');

        return $query->getResult();
    }

    public function findOrganizationById(int $id)
    {
        $query = $this->_em->createQuery('SELECT o FROM App\Entity\Organizations o WHERE :id = o.id ');
        $query->setParameter('id', $id);

        return $query->getResult();
    }

    public function existById(int $id): bool
    {
        return null !== $this->find($id);
    }
}
