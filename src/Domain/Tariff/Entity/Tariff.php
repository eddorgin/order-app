<?php


namespace App\Domain\Tariff\Entity;

/**
 * Class Tariff
 * @package App\Domain\Tariff\Entity
 */
class Tariff
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var float
     */
    public $price;

    /**
     * @var array
     */
    public $deliveryDays;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return array
     */
    public function getDeliveryDays(): array
    {
        return $this->deliveryDays;
    }

    /**
     * @param array $deliveryDays
     */
    public function setDeliveryDays(array $deliveryDays): void
    {
        $this->deliveryDays = $deliveryDays;
    }
}