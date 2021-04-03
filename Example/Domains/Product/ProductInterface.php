<?php


namespace Example\Domains\Product;


interface ProductInterface
{

    public function getVatRate(): float;

    public function getVatCost(): float;

    public function getPrice($withVat = true): float;
}