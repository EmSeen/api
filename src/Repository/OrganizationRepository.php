<?php

namespace App\Repository;

use App\Entity\Organization;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
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
     * Список всех организаций
     * @return mixed
     */
    public function organizationsList(): mixed
    {
        $query = $this->_em->createQuery('SELECT o FROM App\Entity\Organization o');

        return $query->getResult();
    }

    /**
     * Выборка организаций по id
     * @param int $id
     * @return mixed
     */
    public function findOrganizationById(int $id): mixed
    {
        $query = $this->_em->createQuery('SELECT o FROM App\Entity\Organization o WHERE :id = o.id ');
        $query->setParameter('id', $id);

        return $query->getResult();
    }

    /**
     * Проверка существует ли такая организация по id
     * @param int $id
     * @return bool
     */
    public function existById(int $id): bool
    {
        return null !== $this->find($id);
    }
}
