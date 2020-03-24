<?php


namespace App\Infrastructure\Domain;


use App\Domain\Client\Entity\Client;
use App\Infrastructure\DoctrineEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class ClientRepository
 * @package App\Infrastructure\Domain
 */
class ClientRepository extends DoctrineEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }
}