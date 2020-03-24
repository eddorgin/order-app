<?php


namespace App\Domain;

/**
 * Interface Repository
 * @package App\Domain
 */
interface Repository
{
    public function save($entity): bool;

    public function findById($id);

    public function findEntities();

    public function findEntityBy($criteria);
}