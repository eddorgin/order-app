<?php


namespace App\Domain\Order;

use App\Domain\Client\Entity\Client;
use App\Domain\Repository;
use App\Domain\Tariff\Entity\Tariff;
use App\Domain\Tariff\TariffService;

/**
 * Class OrderService
 * @package App\Domain\Order
 */
class OrderService
{
    const ADDRESS = 'address';
    const DELIVERY_DAY = 'delivery_day';
    const NAME = 'name';
    const PHONE = 'phone';
    const TARIFF_ID = 'tariff_id';

    /**
     * @var TariffService
     */
    private $tariffService;

    /**
     * @var Repository
     */
    private $orderRepository;

    /**
     * @var OrderFactory
     */
    private $orderFactory;
    /**
     * @var Repository
     */
    private $clientRepository;

    /**
     * OrderService constructor.
     * @param Repository $orderRepository
     * @param OrderFactory $orderFactory
     * @param TariffService $tariffService
     */
    public function __construct(
        Repository $orderRepository,
        Repository $clientRepository,
        OrderFactory $orderFactory,
        TariffService $tariffService
    )
    {
        $this->tariffService = $tariffService;
        $this->orderRepository = $orderRepository;
        $this->orderFactory = $orderFactory;
        $this->clientRepository = $clientRepository;
    }

    /**
     * @param array $parameters
     * @return bool
     */
    public function validateData(array $parameters)
    {
        if (
            !$parameters[self::ADDRESS] ||
            !$parameters[self::NAME] ||
            !$parameters[self::DELIVERY_DAY] ||
            !$parameters[self::PHONE] ||
            !$parameters[self::TARIFF_ID]
        )
        {
            throw new \DomainException("Переданы не все обязательные параметры");
        }

        /**
         * @var Tariff $tariff
         */
        $tariff = $this->tariffService->getTariffById($parameters[self::TARIFF_ID]);

        if (!$tariff)
        {
            throw new \DomainException("Тариф с id {$parameters[self::TARIFF_ID]} передан неверно");
        }

        if (!in_array($parameters[self::DELIVERY_DAY], $tariff->deliveryDays))
        {
            throw new \DomainException("Неверно указана дата доставки");
        }

        return true;
    }

    /**
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function save($data)
    {
        if ($this->validateData($data))
        {
            $order = $this->orderFactory->create($data);
            $client = new Client();
            $client->setName($data[OrderService::NAME]);
            $client->setPhone($data[OrderService::PHONE]);

            $entity = $this->clientRepository->findEntityBy(['phone' => $client->getPhone()]);

            if (!$entity)
            {
                $this->clientRepository->save($client);
            }
            else
            {
                $client = $entity[0];
            }

            $order->setClient($client);
            $this->orderRepository->save($order);

            return true;
        }

        return false;
    }
}