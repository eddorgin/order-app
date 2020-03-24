<?php


namespace App\Domain\Tariff;


use App\Domain\Repository;

/**
 * Class TariffService
 * @package App\Domain\Tariff
 */
class TariffService
{
    /**
     * @var Repository
     */
    private $repository;

    /**
     * TariffService constructor.
     * @param Repository $tariffRepository
     */
    public function __construct(Repository $tariffRepository)
    {
        $this->repository = $tariffRepository;
    }

    /**
     * @return mixed
     */
    public function getAllTariffs()
    {
        $tariffs = $this->repository->findEntities();
        return $tariffs;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTariffById($id)
    {
        return $this->repository->findById($id);
    }
}