<?php


namespace Example\Domains\Product;


interface ProductLineInterface
{
    /**
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface;

    /**
     * @return float
     */
    public function getQty(): float;

    public function getVatRate(): float;

    public function getVatCost(): float;

    public function getPrice($withVat = true): float;
}