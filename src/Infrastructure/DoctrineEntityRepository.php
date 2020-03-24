<?php


namespace App\Infrastructure;


use App\Domain\Repository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException as ORMExceptionAlias;

/**
 * Class DoctrineEntityRepository
 * @package App\Infrastructure
 */
abstract class DoctrineEntityRepository extends ServiceEntityRepository implements Repository
{
    /**
     * @param $entity
     * @return bool
     * @throws ORMExceptionAlias
     * @throws OptimisticLockException
     */
    public function save($entity): bool
    {
        $this->_em->persist($entity);
        $this->_em->flush();
        return true;
    }

    /**
     * @param $id
     * @return object|null
     */
    public function findById($id)
    {
        return $this->find($id);
    }

    /**
     * @return array
     */
    public function findEntities()
    {
        return $this->findAll();
    }

    public function findEntityBy($criteria)
    {
        return $this->findBy($criteria);
    }
}