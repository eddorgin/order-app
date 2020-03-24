<?php


namespace App\Infrastructure\Domain;


use App\Domain\Tariff\Entity\Tariff;
use App\Infrastructure\DoctrineEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class TariffRepository
 * @package App\Infrastructure\Domain
 */
class TariffRepository extends DoctrineEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tariff::class);
    }
}