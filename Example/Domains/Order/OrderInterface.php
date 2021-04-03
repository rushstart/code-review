<?php


namespace Example\Domains\Order;


interface OrderInterface
{
    public function getId(): int;

    /**
     * @param float $rate from 0 to 100 as percent
     */
    public function setDiscount(float $rate);

    /**
     * @return float
     */
    public function getTotalVat(): float;

    /**
     * @param bool $withVat
     * @return float
     */
    public function getTotalPrice($withVat = true): float;
}