<?php


namespace App\Domain\Order;


use App\Domain\Client\Entity\Client;
use App\Domain\Order\Entity\Order;
use App\Domain\Tariff\Entity\Tariff;
use App\Domain\Tariff\TariffService;

/**
 * Class OrderFactory
 * @package App\Domain\Order
 */
class OrderFactory
{
    /**
     * @var TariffService
     */
    private $tariffService;

    /**
     * OrderFactory constructor.
     * @param TariffService $tariffService
     */
    public function __construct(TariffService $tariffService)
    {
        $this->tariffService = $tariffService;
    }

    /**
     * @param $parameters
     * @return Order
     * @throws \Exception
     */
    public function create($parameters)
    {
        $order = new Order();
        $order->setDeliveryAddress($parameters[OrderService::ADDRESS]);
        /**
         * @var Tariff $tariff
         */
        $tariff = $this->tariffService->getTariffById($parameters[OrderService::TARIFF_ID]);
        $order->setTariff($tariff);
        $order->setDeliveryDay((new \DateTime($parameters[OrderService::DELIVERY_DAY])));
        $order->setPrice($tariff->getPrice());

        return $order;
    }
}