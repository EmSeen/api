<?php

namespace App\Repository;

use App\Entity\Project;
use App\Exception\ProjectNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
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

    /**
     * Список всех проектов, всех пользователей
     * @return Project[]
     */
    public function projectsList(): array
    {
        return $this->findAll();
    }

//    /**
//     * Список всех проектов, всех пользователей
//     */
//    public function projectsList()
//    {
//        return $this->_em->createQuery('SELECT p FROM App\Entity\Project p')->getResult();
//    }

    /**
     * Выборка проекта по id
     * @param int $id
     * @return Project[]
     */
    public function projectById(int $id): array
    {
        return $this->findBy(['id' => $id]);
    }

//    /**
//     * Выборка проекта по id
//     * @param int $id
//     * @return mixed
//     */
//    public function projectById(int $id): mixed
//    {
//
//        $query = $this->_em->createQuery('SELECT p FROM App\Entity\Project p WHERE :id = p.id ');
//        $query->setParameter('id', $id);
//        dump($query->getResult());
//        exit('123');
//        return $query->getResult();
//    }

    /**
     * Список проектов для юзера
     * @param UserInterface $user
     * @return Project[]
     */
    public function userProjects(UserInterface $user): array
    {
        return $this->findBy(['user' => $user]);
    }

    /**
     * Выборка проекта по id для юзера
     * @param int $id
     * @param UserInterface $user
     * @return mixed
     */
    public function getUserProjectsById(int $id, UserInterface $user): mixed
    {
        $query = $this->_em->createQuery('SELECT p FROM App\Entity\Project p WHERE :id = p.id and :user = p.user');
        $query->setParameter('id', $id);
        $query->setParameter('user', $user);

        return $query->getResult();
    }

    /**
     * Удаление проета по id для юзера
     * @param int $id
     * @param UserInterface $user
     * @return Project
     */
    public function delUserProjectsById(int $id, UserInterface $user): Project
    {
        $book = $this->findOneBy(['id' => $id, 'user' => $user]);
        if (null === $book) {
            throw new ProjectNotFoundException();
        }

        return $book;
    }

    /**
     * Проверка существует ли такой проект по id
     * @param int $id
     * @return bool
     */
    public function existById(int $id): bool
    {
        return null !== $this->find($id);
    }

    /**
     * Проверка существует ли такой проект по id для юзера
     * @param int $id
     * @param UserInterface $user
     * @return bool
     */
    public function existsByUser(int $id, UserInterface $user): bool
    {
        return null !== $this->findOneBy(['id' => $id, 'user' => $user]);
    }
}



