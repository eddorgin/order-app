<?php


namespace App\Infrastructure\Domain;


use App\Domain\Order\Entity\Order;
use App\Infrastructure\DoctrineEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class OrderRepository
 * @package App\Infrastructure\Domain
 */
class OrderRepository extends DoctrineEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }
}